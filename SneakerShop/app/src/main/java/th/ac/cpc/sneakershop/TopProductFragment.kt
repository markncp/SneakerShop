package th.ac.cpc.sneakershop

import android.os.Bundle
import android.os.StrictMode
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import android.widget.*
import androidx.fragment.app.Fragment
import androidx.recyclerview.widget.RecyclerView
import com.squareup.picasso.Picasso
import okhttp3.Call
import okhttp3.Callback
import okhttp3.OkHttpClient
import okhttp3.Request
import org.json.JSONArray
import org.json.JSONException
import org.json.JSONObject
import java.io.IOException


class TopProductFragment : Fragment() {
    var recyclerView: RecyclerView? = null

    override fun onCreateView(
        inflater: LayoutInflater, container: ViewGroup?,
        savedInstanceState: Bundle?
    ): View? {
        // Inflate the layout for this fragment
        val root = inflater.inflate(R.layout.fragment_top_product, container, false)

        //To run network operations on a main thread or as an synchronous task.
        val policy =
            StrictMode.ThreadPolicy.Builder().permitAll().build()
        StrictMode.setThreadPolicy(policy)

        //List data
        recyclerView = root.findViewById(R.id.recyclerView)
        showDataList()
        return root
    }

    private fun showDataList() {
        val data = ArrayList<Data>()
        val url: String = getString(R.string.root_url) + getString(R.string.topproduct_url)
        val okHttpClient = OkHttpClient()
        val request: Request = Request.Builder().url(url).get().build()
        try {
            val response = okHttpClient.newCall(request).execute()
            if (response.isSuccessful) {
                try {
                    val res = JSONArray(response.body!!.string())
                    if (res.length() > 0) {
                        for (i in 0 until res.length()) {
                            val item: JSONObject = res.getJSONObject(i)
                            data.add( Data(
                                item.getString("ProductID"),
                                item.getString("ProductName"),
                                item.getString("Price"),
                                item.getString("Topquantity"),
                                item.getString("ProductImage")
                            )
                            )
                            recyclerView!!.adapter = DataAdapter(data)
                        }
                    } else {
                        Toast.makeText(context, "ไม่สามารถแสดงข้อมูลได้",
                            Toast.LENGTH_LONG).show()
                    }
                } catch (e: JSONException) { e.printStackTrace() }
            } else { response.code }
        } catch (e: IOException) { e.printStackTrace() }
    }


    internal class Data(
        var ProductID: String, var ProductName: String, var Price: String,
        var Topquantity: String, var ProductImage: String
    )

    internal inner class DataAdapter(private val list: List<Data>) :
        RecyclerView.Adapter<DataAdapter.ViewHolder>() {
        override fun onCreateViewHolder(parent: ViewGroup, viewType: Int): ViewHolder {
            val view: View = LayoutInflater.from(parent.context).inflate(
                R.layout.item_topproduct,
                parent, false
            )
            return ViewHolder(view)
        }

        override fun onBindViewHolder(holder: ViewHolder, position: Int) {

            val data = list[position]
            holder.data = data
            var url = getString(R.string.root_url) +
                    getString(R.string.product_image_url) + data.ProductImage
            Picasso.get().load(url).into(holder.ProductImage)
            holder.ProductName.text = data.ProductName
            holder.Price.text = "\u0E3F" + data.Price +"  บาท"
            holder.Topquantity.text = "ขายได้   " + data.Topquantity + "    ชิ้น"


            holder.itemView.setOnClickListener(){
                val bundle = Bundle()
                bundle.putString("ProductID", data.ProductID)
                bundle.putString("ProductName", data.ProductName)

                val fm = ViewProductFragment()
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
            var ProductName: TextView = itemView.findViewById(R.id.txtProductName)
            var Price: TextView = itemView.findViewById(R.id.txtPrice)
            var Topquantity: TextView = itemView.findViewById(R.id.txtPay)
            var ProductImage: ImageView = itemView.findViewById(R.id.imgImageFileName)
        }
    }

}