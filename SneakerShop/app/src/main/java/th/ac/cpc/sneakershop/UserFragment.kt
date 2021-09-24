package th.ac.cpc.sneakershop

import android.Manifest
import android.content.Context
import android.content.Intent
import android.content.pm.PackageManager
import android.net.Uri
import android.os.Bundle
import android.text.Html
import android.util.Log
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import android.widget.Button
import android.widget.ImageView
import android.widget.TextView
import android.widget.Toast
import androidx.core.app.ActivityCompat
import androidx.core.content.ContextCompat
import androidx.fragment.app.Fragment
import com.squareup.picasso.Picasso
import okhttp3.OkHttpClient
import okhttp3.Request
import org.json.JSONException
import org.json.JSONObject
import java.io.IOException

class UserFragment : Fragment() {
    var id: String? = null
    var imgViewFile: ImageView? = null
    var txtfirstname: TextView? = null
    var txtlastname: TextView? = null
    var txtemail: TextView? = null
    var txtusername: TextView? = null
    var txtpassword: TextView? = null
    var txtaddressdetail: TextView? = null
    var txtroad: TextView? = null
    var txtsubdistrict: TextView? = null
    var txtDistrict: TextView? = null
    var txtprovince: TextView? = null
    var txtzipcode: TextView? = null
    var txtphone: TextView? = null
    var btnUpdate: Button? = null
    var btnDelete: Button? = null
    var btnLogout: Button? =null

    override fun onCreateView(
            inflater: LayoutInflater, container: ViewGroup?,
            savedInstanceState: Bundle?
    ): View? {

        // Inflate the layout for this fragment
        val root = inflater.inflate(R.layout.fragment_user, container, false)

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


            //find to widgets on a layout
            imgViewFile = root.findViewById(R.id.imgViewFile)
            txtfirstname = root.findViewById(R.id.txtfirstName)
            txtlastname = root.findViewById(R.id.txtlastName)
            txtemail = root.findViewById(R.id.txtemail)
            txtusername = root.findViewById(R.id.txtusername)
            txtpassword = root.findViewById(R.id.txtpassword)
            txtaddressdetail = root.findViewById(R.id.txtaddressdetail)
            txtroad = root.findViewById(R.id.txtroad)
            txtsubdistrict = root.findViewById(R.id.txtsubdistrictname)
            txtDistrict = root.findViewById(R.id.txtdistrictname)
            txtprovince = root.findViewById(R.id.txtprovincename)
            txtzipcode = root.findViewById(R.id.txtzipcode)
            txtphone = root.findViewById(R.id.txtphone)
            btnUpdate = root.findViewById(R.id.btnUpdate)
            btnDelete = root.findViewById(R.id.btnDelete)
            btnLogout = root.findViewById(R.id.btnLogout)

            viewUser(id)
        }
            return root
    }


    private fun viewUser(id: String?)
    {
        var url: String = getString(R.string.root_url) + getString(R.string.user_url) + id
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
                                getString(R.string.user_image_url) +
                                data.getString("imageFileName")

                        Picasso.get().load(imgUrl).into(imgViewFile)
                        txtfirstname?.text = data.getString("firstname")
                        txtlastname?.text = data.getString("lastname")
                        txtemail?.text = data.getString("email")
                        txtusername?.text = data.getString("username")
                        txtpassword?.text = data.getString("password")
                        txtaddressdetail?.text = data.getString("addressdetail")
                        txtroad?.text = data.getString("road")
                        txtsubdistrict?.text = data.getString("subdistrict")
                        txtDistrict?.text = data.getString("district")
                        txtprovince?.text = data.getString("province")
                        txtzipcode?.text = data.getString("zipcode")
                        txtphone?.text = Html.fromHtml("<u> " + data.getString("phone") + "</u>")


                        txtphone!!.setOnClickListener {
                            val intent = Intent(Intent.ACTION_CALL, Uri.parse("tel:" + txtphone!!.text.toString()))

                            if (ContextCompat.checkSelfPermission(it.context, Manifest.permission.CALL_PHONE)
                                    != PackageManager.PERMISSION_GRANTED) {
                                ActivityCompat.requestPermissions(MainActivity(),
                                        arrayOf(Manifest.permission.CALL_PHONE),1)
                            } else {
                                try {
                                    startActivity(intent)
                                } catch (e: SecurityException) {
                                    e.printStackTrace()
                                }
                            }
                        }
                        btnUpdate!!.setOnClickListener {
                            val bundle = Bundle()
                            bundle.putString("id", id)

                            val fm = UserUpdateFragment()
                            fm.arguments = bundle;

                            val fragmentTransaction = requireActivity().
                            supportFragmentManager.beginTransaction()
                            fragmentTransaction.addToBackStack(null)
                            fragmentTransaction.replace(R.id.nav_host_fragment, fm)
                            fragmentTransaction.commit()
                        }
                        btnDelete!!.setOnClickListener {
                            deleteUser(id)
                            val fragmentTransaction = requireActivity().
                            supportFragmentManager.beginTransaction()
                            fragmentTransaction.replace(R.id.nav_host_fragment, LogoutFragment())
                            fragmentTransaction.addToBackStack(null)
                            fragmentTransaction.commit()
                        }
                        btnLogout!!.setOnClickListener{
                            val sharePrefer = requireContext().getSharedPreferences(
                                    LoginActivity().appPreference,
                                    Context.MODE_PRIVATE
                            )
                            val editor = sharePrefer.edit()
                            editor.clear() // ทำการลบข้อมูลทั้งหมดจาก preferences

                            editor.commit() // ยืนยันการแก้ไข prefesrences

                            //return to login page
                            val intent = Intent(context, LoginActivity::class.java)
                            startActivity(intent)

                        }

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



    private fun deleteUser(id: String?)
    {
        var url: String = getString(R.string.root_url) + getString(R.string.user_url) + id
        Log.d("dlt",url)
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
                        Toast.makeText(context, "ยกเลิกการสมัครสมาชิกเรียบร้อยแล้ว", Toast.LENGTH_LONG).show()
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
