package th.ac.cpc.sneakershop

import android.content.Context
import android.content.Intent
import android.os.Bundle
import android.os.StrictMode
import android.util.Log
import androidx.fragment.app.Fragment
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import android.widget.*
import com.squareup.picasso.Picasso
import okhttp3.OkHttpClient
import okhttp3.Request
import org.json.JSONArray
import org.json.JSONException
import org.json.JSONObject
import java.io.IOException
import java.util.ArrayList
import android.widget.AdapterView.OnItemSelectedListener
import okhttp3.FormBody
import okhttp3.RequestBody


class ViewProductFragment : Fragment() {
    var id: String? = null
    val ProductID: String? =null
    var ProductName:String? = null
    var ProductImage: ImageView? = null
    var txtproid: TextView? = null
    var txtproname: TextView? = null
    var txtprice: TextView? = null
    var txtprotype: TextView? = null
    var txtprodetail: TextView? = null
    var txtquantity: TextView? = null
    var spinnerProsize: Spinner? = null
    var ProsizeD :String? = ""
    var IDpro:String? = null
    var btnAddToCart:ImageButton? = null
    var editQuantity:EditText? = null
    var addProduct:Button? = null
    var removeProduct:Button? = null

    private var prosize = ArrayList<Prosize>()


    override fun onCreateView(inflater: LayoutInflater, container: ViewGroup?, savedInstanceState: Bundle?): View? {

        // Inflate the layout for this fragment
        val root = inflater.inflate(R.layout.fragment_view_product, container, false)
        val policy = StrictMode.ThreadPolicy.Builder().permitAll().build()
        StrictMode.setThreadPolicy(policy)
        val bundle = this.arguments
        IDpro= bundle?.get("ProductID").toString()
        bundle?.get("ProductID").toString()
        bundle?.get("ProductName").toString()
        bundle?.get("Price").toString()
        //ProductID= bundle?.get("ProductID").toString()

        val sharedPrefer = requireContext().getSharedPreferences(
            LoginActivity().appPreference, Context.MODE_PRIVATE)
        id = sharedPrefer?.getString(LoginActivity().idPreference, 0.toString())

        ProductImage = root.findViewById(R.id.imgViewFile)
        txtproid = root.findViewById(R.id.txtproid)
        txtproname = root.findViewById(R.id.txtproname)
        txtprice = root.findViewById(R.id.txtprice)
        txtprotype = root.findViewById(R.id.txtprotype)
        txtprodetail = root.findViewById(R.id.txtprodetail)
        txtquantity = root.findViewById(R.id.txtquantity)
        spinnerProsize = root.findViewById(R.id.spinnerProsize)
        btnAddToCart = root.findViewById(R.id.btnAddToCart)
        editQuantity = root.findViewById(R.id.editQuantity)
        addProduct = root.findViewById(R.id.addProduct)
        removeProduct = root.findViewById(R.id.removeProduct)

        var proquantity = txtquantity?.text.toString()
        var proprice = txtprice?.text.toString()
        //listProsize(txtproname?.text.toString())
        // prosize.add(Prosize("เลือกไซส์"))
        addtoCart(bundle?.get("ProductID").toString())
        listProsize(bundle?.get("ProductName").toString())
        viewProduct(bundle?.get("ProductName").toString())


        removeProduct!!.setOnClickListener{
            var lQuantity = Integer.valueOf(editQuantity?.text.toString())
            lQuantity -= 1
            if (lQuantity == 0) lQuantity = 1
            editQuantity?.setText(lQuantity.toString())
        }

        addProduct!!.setOnClickListener{
            var lQuantity = Integer.valueOf(editQuantity?.text.toString())
            lQuantity += 1
            editQuantity?.setText(lQuantity.toString())
        }
        btnAddToCart!!.setOnClickListener{
            if (id == "0") {
                val editor = sharedPrefer.edit()
                editor.clear() // ทำการลบข้อมูลทั้งหมดจาก preferences

                editor.commit() // ยืนยันการแก้ไข prefesrences

                //return to login page
                val intent = Intent(context, LoginActivity::class.java)
                startActivity(intent)
            } else {

                addtoCart(ProductID.toString())
                Toast.makeText(context, "เพิ่มลงตะกร้าเรียบร้อย",
                        Toast.LENGTH_LONG).show()
            }
        }

        val adapterProsize = ArrayAdapter(requireContext(),android.R.layout.simple_spinner_item, prosize)
        spinnerProsize?.adapter = adapterProsize

        spinnerProsize?.onItemSelectedListener = object : AdapterView.OnItemSelectedListener {
            override fun onItemSelected(parent: AdapterView<*>?, view: View, position: Int, id: Long) {
                val prosize = spinnerProsize!!.selectedItem as Prosize
                ProsizeD = prosize.ProductSize
                viewProduct(txtproname?.text.toString())
            }

            override fun onNothingSelected(parent: AdapterView<*>?) {}
        }
        return root
    }

    private fun viewProduct(ProductName: String?) {
        var url: String = getString(R.string.root_url) + getString(R.string.viewview_url) + ProductName + "/?ProductSize="+ProsizeD
        Log.d("tag1",url)
        val okHttpClient = OkHttpClient()
        val request: Request = Request.Builder()
            .url(url)
            .get()
            .build()
        try {
            val response = okHttpClient.newCall(request).execute()
            if (response.isSuccessful) {
                try {
                    val data = JSONObject(response.body!!.string())
                    if (data.length() > 0) {

                        var imgUrl = getString(R.string.root_url) +
                                getString(R.string.product_image_url) +
                                data.getString("ProductImage")

                        Picasso.get().load(imgUrl).into(ProductImage)
                        txtproid?.setText(data.getString("ProductID"))
                        txtproname?.setText(data.getString("ProductName"))
                        txtprice?.setText(data.getString("Price"))
                        txtprotype?.setText( data.getString("ProductTypeName"))
                        txtprodetail?.setText( data.getString("ProductDetail"))
                        txtquantity?.text = data.getString("Quantity")

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

    private fun listProsize(ProductName: String) {

        val urlProvince: String = getString(R.string.root_url) + getString(R.string.prosize_url) + ProductName
        Log.d("tag2",urlProvince)
        val okHttpClient = OkHttpClient()
        val request: Request = Request.Builder().url(urlProvince).get().build()
        try {
            val response = okHttpClient.newCall(request).execute()
            if (response.isSuccessful) {
                try {
                    val res = JSONArray(response.body!!.string())
                    if (res.length() > 0) {
                        for (i in 0 until res.length()) {
                            val item: JSONObject = res.getJSONObject(i)
                            prosize.add(Prosize(
                                item.getString("ProductSize")
                            ))
                        }
                    }
                } catch (e: JSONException) { e.printStackTrace() }
            } else { response.code }
        } catch (e: IOException) { e.printStackTrace() }
    }

    private fun addtoCart(ProductID: String)
    {
        var url: String = getString(R.string.root_url) + getString(R.string.cart_url)
        Log.d("tagcart",url)
        val okHttpClient = OkHttpClient()
        val formBody: RequestBody = FormBody.Builder()
                .add("id", id.toString())
                .add("ProductID", txtproid?.text.toString())
                .add("cart_quantity",editQuantity?.text.toString())
                .add("cart_price",txtprice?.text.toString())
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

    internal class Prosize(var ProductSize: String) {
        override fun toString(): String {
            return ProductSize
        }
    }

}

