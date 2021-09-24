package th.ac.cpc.sneakershop

import android.content.Context
import android.content.Intent
import android.os.Bundle
import android.util.Log
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import android.widget.Button
import android.widget.ImageView
import android.widget.TextView
import android.widget.Toast
import androidx.fragment.app.Fragment
import androidx.recyclerview.widget.RecyclerView
import com.squareup.picasso.Picasso
import kotlinx.coroutines.*
import okhttp3.*
import org.json.JSONArray
import org.json.JSONException
import org.json.JSONObject
import java.io.IOException
import java.text.DecimalFormat
import java.text.NumberFormat


class CartFragment : Fragment() {
    var id: String? = null
    var CartID: String? = null
    var btnconfirm: Button? = null
    var txttotalprice: TextView? = null
    var recyclerView: RecyclerView? = null
    var x: Int = 0
    private val client = OkHttpClient()
    private val quan = ArrayList<String>()
    private val price = ArrayList<String>()
    private val proid = ArrayList<String>()
    private val Cartid = ArrayList<String>()

    private val orderdetail = ArrayList<Dataorderdetail>()

    override fun onCreateView(inflater: LayoutInflater, container: ViewGroup?, savedInstanceState: Bundle?): View? {
        val root = inflater.inflate(R.layout.fragment_cart, container, false)
        val sharedPrefer = requireContext().getSharedPreferences(LoginActivity().appPreference, Context.MODE_PRIVATE)
        id = sharedPrefer?.getString(LoginActivity().idPreference, null)



        btnconfirm = root.findViewById(R.id.btnconfirm)
        txttotalprice = root.findViewById(R.id.txttotalprice)
        btnconfirm?.setOnClickListener {
            AddOrderNull()
            for(i in orderdetail) {
                AddOrderDetail(i.Quantity,i.Price,i.ProductID)
            }
           // updateOrder()
            deleteCartpay()
            val fragmentTransition = requireActivity().supportFragmentManager.beginTransaction()
            fragmentTransition.addToBackStack(null)
            fragmentTransition.replace(R.id.nav_host_fragment, HistoryFragment())
            fragmentTransition.commit()

        }
        recyclerView = root.findViewById(R.id.recyclerView)
        showDataList()

        return root
    }


    private fun updateOrder()
    {
        var url: String = getString(R.string.root_url) + getString(R.string.updateOrder_url) + viewOrder().toString()
        val okHttpClient = OkHttpClient()
        val formBody: RequestBody = FormBody.Builder()
                .add("id",id.toString())
                .build()
        val request: Request = Request.Builder()
                .url(url)
                .put(formBody)
                .build()
        try {
            val response = okHttpClient.newCall(request).execute()
            if (response.isSuccessful) {
                try {
                    val data = JSONObject(response.body!!.string())
                    if (data.length() > 0) {
                        Toast.makeText(context, "แก้ไขข้อมูลรสมาชิกเรียบร้อยแล้ว", Toast.LENGTH_LONG).show()
                    }

                } catch (e: JSONException) {
                    e.printStackTrace()
                }
            } else {
                response.code
            }
        } catch (e: IOException) {
            e.printStackTrace()
        }
    }

    private fun viewOrder(): String?
    {
        var id :String?=null
        var url: String = getString(R.string.root_url) + getString(R.string.SelectIDOrder_url)
        val okHttpClient = OkHttpClient()
        val request: Request = Request.Builder()
                .url(url)
                .get()////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                .build()
        try {
            val response = okHttpClient.newCall(request).execute()
            if (response.isSuccessful) {
                try {
                    val data = JSONObject(response.body!!.string())
                    if (data.length() > 0) {

                        id=data.getString("orderID")

                    }

                } catch (e: JSONException) {
                    e.printStackTrace()
                }
            } else {
                response.code
            }
        } catch (e: IOException) {
            e.printStackTrace()
        }
        return id
    }




    private fun AddOrderDetail(Quantity: String,Price: String,ProductID: String)
    {



            var url: String = getString(R.string.root_url) + getString(R.string.AddOrderDetail_url)
            val okHttpClient = OkHttpClient()
            val formBody: RequestBody = FormBody.Builder()

                    .add("Quantity", Quantity)
                    .add("Price", Price)
                    .add("ProductID", ProductID)
                    .add("orderID", viewOrder().toString())
                    .build()

            val request: Request = Request.Builder()
                    .url(url)
                    .post(formBody)
                    .build()
            try {
                val response = okHttpClient.newCall(request).execute()
                if (response.isSuccessful) {
                    try {
                        val data = JSONObject(response.body!!.string())
                        if (data.length() > 0) {
                        }

                    } catch (e: JSONException) {
                        e.printStackTrace()
                    }
                } else {
                    response.code
                }
            } catch (e: IOException) {
                e.printStackTrace()
            }

    }

    private fun AddOrderNull()
    {
        var url: String = getString(R.string.root_url) + getString(R.string.AddOrderNull_url)+id
        val okHttpClient = OkHttpClient()
        val formBody: RequestBody = FormBody.Builder()
                .build()

        val request: Request = Request.Builder()
                .url(url)
                .post(formBody)
                .build()
        try {
            val response = okHttpClient.newCall(request).execute()
            if (response.isSuccessful) {
                try {
                    val data = JSONObject(response.body!!.string())
                    if (data.length() > 0) {
                    }

                } catch (e: JSONException) {
                    e.printStackTrace()
                }
            } else {
                response.code
            }
        } catch (e: IOException) {
            e.printStackTrace()
        }
    }
    internal class Dataorderdetail(
            var Quantity: String,var Price: String,var ProductID: String
    )


    //show a data list
    private fun showDataList() {
        val data = ArrayList<Data>()
        val url: String = getString(R.string.root_url) + getString(R.string.cart_url) + id
        Log.d("cart1",url)
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
                                    item.getString("CartID"),
                                    item.getString("cart_quantity"),
                                    item.getString("cart_price"),
                                    item.getString("ProductName"),
                                    item.getString("ProductImage"),
                                    item.getString("totalprice"),
                                    item.getString("ProductID")

                                )
                            )
                            orderdetail.add(Dataorderdetail(item.getString("cart_quantity"),item.getString("cart_price"), item.getString("ProductID")))
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
        var CartID: String, var cart_quantity: String, var cart_price: String,
        var ProductName: String, var ProductImage: String , var totalprice: String, var ProductID: String
    )

    internal inner class DataAdapter(private val list: List<Data>) :
        RecyclerView.Adapter<DataAdapter.ViewHolder>() {
        override fun onCreateViewHolder(parent: ViewGroup, viewType: Int): ViewHolder {
            val view: View = LayoutInflater.from(parent.context).inflate(
                R.layout.item_cart,
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


            holder.txtProductName.text = data.ProductName
            holder.txtPrice.text = data.cart_price +"  บาท"
            holder.txtQuantity.text = "จำนวน  "+ data.cart_quantity + "  ชิ้น"
            holder.txtpricecart.text = "ราคา "+ data.totalprice + "  บาท"
            x += Integer.valueOf(data.cart_price) * Integer.valueOf(data.cart_quantity)
            txttotalprice?.text = x.toString()

            quan.add(data.cart_quantity)
            price.add(data.cart_price)
            proid.add(data.ProductID)
            Cartid.add(data.CartID)


            holder.deletecart.setOnClickListener(){
                deleteCart(data.CartID)
                val fm = CartFragment()
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
            var txtProductName: TextView = itemView.findViewById(R.id.txtProductName)
            var txtPrice: TextView = itemView.findViewById(R.id.txtPrice)
            var txtQuantity: TextView = itemView.findViewById(R.id.txtQuantity)
            var ProductImage: ImageView = itemView.findViewById(R.id.imgImageFileName)
            var deletecart: ImageView = itemView.findViewById(R.id.imgDelete)
            var txtpricecart: TextView = itemView.findViewById(R.id.txtpricecart)
        }

    }

    private fun deleteCart(CartID: String?)
    {
        var url: String = getString(R.string.root_url) + getString(R.string.cart_url) + CartID
        Log.d("dltcart",url)
        val okHttpClient = OkHttpClient()
        val request: Request = Request.Builder()
            .url(url)
            .delete()
            .build()
        try {
            val response = okHttpClient.newCall(request).execute()
            if (response.isSuccessful) {
                try {
                    val data = JSONObject(response.body!!.string())
                    if (data.length() > 0) {
                        Toast.makeText(context, "ลบสินค้าออกจากตระกร้าเรียบร้อย", Toast.LENGTH_LONG).show()
                    }


                } catch (e: JSONException) {
                    e.printStackTrace()
                }
            } else {
                response.code
            }
        } catch (e: IOException) {
            e.printStackTrace()
        }
    }


    private fun deleteCartpay()
    {

        for (i in 0 until Cartid.size) {


            var url: String = getString(R.string.root_url) + getString(R.string.cart_url) + Cartid[i]
            Log.d("dltcart", url)
            val okHttpClient = OkHttpClient()
            val request: Request = Request.Builder()
                    .url(url)
                    .delete()
                    .build()
            try {
                val response = okHttpClient.newCall(request).execute()
                if (response.isSuccessful) {
                    try {
                        val data = JSONObject(response.body!!.string())
                        if (data.length() > 0) {
                            Toast.makeText(context, "ลบสินค้าออกจากตระกร้าเรียบร้อย", Toast.LENGTH_LONG).show()
                        }

                    } catch (e: JSONException) {
                        e.printStackTrace()
                    }
                } else {
                    response.code
                }
            } catch (e: IOException) {
                e.printStackTrace()
            }
        }
    }

    private fun addorder(ProductID: String,cart_quantity: String,cart_price: String){
        var url: String = getString(R.string.root_url) + getString(R.string.order_url)
        Log.d("addorder",url)
        val okHttpClient = OkHttpClient()
        val formBody: RequestBody = FormBody.Builder()
            .add("id", id.toString())
            .add("ProductID",ProductID)
            .add("Price",cart_price)
            .add("Quantity",cart_quantity)
            .build()
        val request: Request = Request.Builder()
            .url(url)
            .post(formBody)
            .build()
        try {
            val response = okHttpClient.newCall(request).execute()
            if (response.isSuccessful) {
                Log.d("txt","ff3")
                try {
                    val data = JSONObject(response.body!!.string())
                    if (data.length() > 0) {
                    }

                } catch (e: JSONException) {
                    e.printStackTrace()
                }
            } else {
                response.code
            }
        } catch (e: IOException) {
            e.printStackTrace()
        }
    }



}