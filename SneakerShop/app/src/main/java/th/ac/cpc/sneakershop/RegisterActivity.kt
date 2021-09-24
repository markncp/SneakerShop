package th.ac.cpc.sneakershop

import android.app.DatePickerDialog
import android.app.DatePickerDialog.OnDateSetListener
import android.content.Intent
import android.os.AsyncTask
import android.os.Bundle
import android.os.StrictMode
import android.util.Log
import android.view.View
import android.widget.*
import android.widget.AdapterView.OnItemSelectedListener
import androidx.appcompat.app.AppCompatActivity
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
/*
class RegisterActivity : AppCompatActivity() {
    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_register)
    }
}
*/

class RegisterActivity : AppCompatActivity() {
    var editTextFirstName: EditText? = null
    var editTextLastName: EditText? = null
    var editTextEmail: EditText? = null
    var editTextUsername: EditText? = null
    var editTextPassword: EditText? = null
    var editTextMobilePhone: EditText? = null
    var editTextAddress: EditText? = null
    var editTextRoad: EditText? = null
    var editTextProvince: EditText? = null
    var editTextSubdistrict: EditText? = null
    var editTextDistrict: EditText? = null
    var editTextZipcode: EditText? = null
    var btnUpdate: Button? = null



    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_register)

        //To run network operations on a main thread or as an synchronous task.
        val policy = StrictMode.ThreadPolicy.Builder().permitAll().build()
        StrictMode.setThreadPolicy(policy)

        //find to widgets on a layout
        editTextFirstName = findViewById(R.id.editTextFirstName)
        editTextLastName = findViewById(R.id.editTextLastName)
        editTextEmail = findViewById(R.id.editTextEmail)
        editTextUsername = findViewById(R.id.editTextUsername)
        editTextPassword = findViewById(R.id.editTextPassword)
        editTextMobilePhone = findViewById(R.id.editTextMobilePhone)
        editTextAddress = findViewById(R.id.editTextAddress)
        editTextRoad = findViewById(R.id.editTextRoad)
        editTextProvince = findViewById(R.id.editTextProvince)
        editTextSubdistrict = findViewById(R.id.editTextSubdistrict)
        editTextDistrict = findViewById(R.id.editTextDistrict)
        editTextZipcode = findViewById(R.id.editTextZipcode)
        btnUpdate = findViewById(R.id.btnUpdate)



        btnUpdate!!.setOnClickListener {
            register()

        }
    }

    private fun register()
    {
        var url: String = getString(R.string.root_url) + getString(R.string.user_url)
        val okHttpClient = OkHttpClient()
        val formBody: RequestBody = FormBody.Builder()
                .add("firstname", editTextFirstName?.text.toString())
                .add("lastname", editTextLastName?.text.toString())
                .add("email", editTextEmail?.text.toString())
                .add("username", editTextUsername?.text.toString())
                .add("password", editTextPassword?.text.toString())
                .add("phone", editTextMobilePhone?.text.toString())
                .add("addressdetail", editTextAddress?.text.toString())
                .add("road", editTextRoad?.text.toString())
                .add("province", editTextProvince?.text.toString())
                .add("subdistrict", editTextSubdistrict?.text.toString())
                .add("district", editTextDistrict?.text.toString())
                .add("zipcode", editTextZipcode?.text.toString())
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
                        Toast.makeText(this, "สมัครสมาชิกเรียบร้อยแล้ว", Toast.LENGTH_LONG).show()
                        val intent = Intent(applicationContext, LoginActivity::class.java)
                        startActivity(intent)
                        finish()
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
