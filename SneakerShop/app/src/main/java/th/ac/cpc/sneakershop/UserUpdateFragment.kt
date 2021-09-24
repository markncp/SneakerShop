package th.ac.cpc.sneakershop

import android.app.DatePickerDialog
import android.os.Bundle
import android.os.StrictMode
import android.util.Log
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import android.widget.*
import androidx.fragment.app.Fragment
import okhttp3.FormBody
import okhttp3.OkHttpClient
import okhttp3.Request
import okhttp3.RequestBody
import org.json.JSONArray
import org.json.JSONException
import org.json.JSONObject
import java.io.IOException
import java.text.SimpleDateFormat
import java.util.*

class UserUpdateFragment : Fragment() {
    var editTextFirstName: EditText? = null
    var editTextLastName: EditText? = null
    var editTextEmail: EditText? = null
    var editTextUsername: EditText? = null
    var editTextPassword: EditText? = null
    var editTextAddressdetail: EditText? = null
    var editTextRoad: EditText? = null
    var editTextSubdistrict: EditText? = null
    var editTextDistrict: EditText? = null
    var editTextProvince: EditText? = null
    var editTextZipcode: EditText? = null
    var editTextMobilePhone: EditText? = null
    var btnUpdate: Button? = null


    override fun onCreateView(
            inflater: LayoutInflater, container: ViewGroup?,
            savedInstanceState: Bundle?
    ): View? {
        // Inflate the layout for this fragment
        val root = inflater.inflate(R.layout.fragment_user_update, container, false)

        //To run network operations on a main thread or as an synchronous task.
        val policy = StrictMode.ThreadPolicy.Builder().permitAll().build()
        StrictMode.setThreadPolicy(policy)

        val bundle = this.arguments

        //find to widgets on a layout
        editTextFirstName = root.findViewById(R.id.editTextFirstName)
        editTextLastName = root.findViewById(R.id.editTextLastName)
        editTextEmail = root.findViewById(R.id.editTextEmail)
        editTextUsername = root.findViewById(R.id.editTextUsername)
        editTextPassword = root.findViewById(R.id.editTextPassword)
        editTextAddressdetail = root.findViewById(R.id.editTextAddress)
        editTextRoad = root.findViewById(R.id.editTextRoad)
        editTextSubdistrict = root.findViewById(R.id.editTextSubdistrict)
        editTextDistrict = root.findViewById(R.id.editTextDistrict)
        editTextProvince = root.findViewById(R.id.editTextProvince)
        editTextZipcode = root.findViewById(R.id.editTextZipcode)
        editTextMobilePhone = root.findViewById(R.id.editTextMobilePhone)
        btnUpdate = root.findViewById(R.id.btnUpdate)




        btnUpdate!!.setOnClickListener {
            updateUser(bundle?.get("id").toString())
            val fragmentTransaction = requireActivity().
            supportFragmentManager.beginTransaction()
            fragmentTransaction.addToBackStack(null)
            fragmentTransaction.replace(R.id.nav_host_fragment, UserFragment())
            fragmentTransaction.commit()
        }

        viewUser(bundle?.get("id").toString())

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

                        editTextFirstName?.setText(data.getString("firstname"))
                        editTextLastName?.setText(data.getString("lastname"))
                        editTextEmail?.setText( data.getString("email"))
                        editTextUsername?.setText(data.getString("username"))
                        editTextPassword?.setText(data.getString("password"))
                        editTextAddressdetail?.setText( data.getString("addressdetail"))
                        editTextRoad?.setText(data.getString("road"))
                        editTextSubdistrict?.setText(data.getString("subdistrict"))
                        editTextDistrict?.setText(data.getString("district"))
                        editTextProvince?.setText(data.getString("province"))
                        editTextZipcode?.setText(data.getString("zipcode"))
                        editTextMobilePhone?.setText(data.getString("phone"))

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

    private fun updateUser(id: String?)
    {
        var url: String = getString(R.string.root_url) + getString(R.string.user_url) + id
        val okHttpClient = OkHttpClient()
        val formBody: RequestBody = FormBody.Builder()
                .add("firstname", editTextFirstName?.text.toString())
                .add("lastname", editTextLastName?.text.toString())
                .add("email", editTextEmail?.text.toString())
                .add("username", editTextUsername?.text.toString())
                .add("password", editTextPassword?.text.toString())
                .add("addressdetail", editTextAddressdetail?.text.toString())
                .add("road", editTextRoad?.text.toString())
                .add("subdistrict", editTextSubdistrict?.text.toString())
                .add("district", editTextDistrict?.text.toString())
                .add("province", editTextProvince?.text.toString())
                .add("zipcode", editTextZipcode?.text.toString())
                .add("phone", editTextMobilePhone?.text.toString())
                .add("type", "0")
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

}