package th.ac.cpc.sneakershop

import android.content.Context
import android.content.Intent
import android.os.Bundle
import android.util.Log
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import android.widget.TextView
import android.widget.Toast
import androidx.fragment.app.Fragment
import androidx.recyclerview.widget.RecyclerView
import kotlinx.coroutines.*
import okhttp3.*
import org.json.JSONArray
import org.json.JSONException
import org.json.JSONObject
import java.io.IOException
import java.text.DecimalFormat
import java.text.NumberFormat


class HistoryFragment : Fragment() {
    var id: String? = null
    var recyclerView: RecyclerView? = null
    private val client = OkHttpClient()
    private val data = ArrayList<Data>()

    override fun onCreateView(
            inflater: LayoutInflater, container: ViewGroup?,
            savedInstanceState: Bundle?
    ): View? {
        // Inflate the layout for this fragment
        val root = inflater.inflate(R.layout.fragment_history, container, false)

        //To run network operations on a main thread or as an synchronous task.

        //get shared preference
        val sharedPrefer = requireContext().getSharedPreferences(
                LoginActivity().appPreference, Context.MODE_PRIVATE)
        id = sharedPrefer?.getString(LoginActivity().idPreference, 0.toString())

        if (id == "0") {
            val editor = sharedPrefer.edit()
            editor.clear() // ทำการลบข้อมูลทั้งหมดจาก preferences

            editor.commit() // ยืนยันการแก้ไข prefesrences

            //return to login page
            val intent = Intent(context, LoginActivity::class.java)
            startActivity(intent)
        } else {


            //List data
            recyclerView = root.findViewById(R.id.recyclerView)
            showDataList()
        }
        return root
    }


    //show a data list
    private fun showDataList() {
        val data = ArrayList<Data>()
        val url: String = getString(R.string.root_url) + getString(R.string.order_url) +
                "?id=" +  id.toString()
        val okHttpClient = OkHttpClient()
        val request: Request = Request.Builder().url(url).get().build()
        try {
            val response = okHttpClient.newCall(request).execute()
            if (response.isSuccessful) {
                try {
                    val res = JSONArray(response.body!!.string())
                    if (res.length() > 0) {
                        val formatter: NumberFormat = DecimalFormat("#,###")
                        val status = arrayOf(
                                "คลิกเพื่อชำระเงิน", "กำลังตรวจสอบการชำระเงิน", "ชำระเงินเรียบร้อย", "กำลังดำเนินการส่งสินค้า", "ส่งสินค้าเรียบร้อย")
                        for (i in 0 until res.length()) {
                            val item: JSONObject = res.getJSONObject(i)
                            data.add( Data(
                                    item.getString("orderID"),
                                    item.getString("orderDate"),
                                    item.getString("totalPrice"),
                                    status[item.getInt("statusID")]
                            )
                            )
                        }
                        recyclerView!!.adapter = DataAdapter(data)
                    } else {
                        Toast.makeText(context, "ไม่สามารถแสดงข้อมูลได้", Toast.LENGTH_LONG).show()
                    }
                } catch (e: JSONException) { e.printStackTrace() }
            } else { response.code }
        } catch (e: IOException) { e.printStackTrace() }
    }

    internal class Data(
            var orderID: String, var orderDate: String,
            var totalPrice: String, var orderStatus: String
    )

    internal inner class DataAdapter(private val list: List<Data>) :
            RecyclerView.Adapter<DataAdapter.ViewHolder>() {
        override fun onCreateViewHolder(parent: ViewGroup, viewType: Int): ViewHolder {
            val view: View = LayoutInflater.from(parent.context).inflate(
                    R.layout.item_orderhistory,
                    parent, false
            )
            return ViewHolder(view)
        }

        override fun onBindViewHolder(holder: ViewHolder, position: Int) {
            val data = list[position]
            holder.data = data
            holder.txtOrderID.text = data.orderID
            holder.txtOrderDate.text = data.orderDate
            holder.txtTotalPrice.text = data.totalPrice
            holder.txtOrderStatus.text = data.orderStatus

            holder.itemView.setOnClickListener{
                val bundle = Bundle()
                bundle.putString("orderID", data.orderID)
                bundle.putString("totalPrice", data.totalPrice)
                val fm = PaymentFragment()
                fm.arguments = bundle;
                val fragmentTransition = requireActivity().supportFragmentManager.beginTransaction()
                fragmentTransition.addToBackStack(null)
                fragmentTransition.replace(R.id.nav_host_fragment, fm)
                fragmentTransition.commit()
            }

        }

        override fun getItemCount(): Int {
            return list.size
        }

        internal inner class ViewHolder(itemView: View) :
                RecyclerView.ViewHolder(itemView) {
            var data: Data? = null
            var txtOrderID: TextView = itemView.findViewById(R.id.txtOrderID)
            var txtOrderDate: TextView = itemView.findViewById(R.id.txtOrderDate)
            var txtTotalPrice: TextView = itemView.findViewById(R.id.txtTotalPrice)
            var txtOrderStatus: TextView = itemView.findViewById(R.id.txtOrderStatus)

        }

    }
}