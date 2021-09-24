package th.ac.cpc.sneakershop

import android.content.Context
import android.content.Intent
import android.content.SharedPreferences
import androidx.appcompat.app.AppCompatActivity
import android.os.Bundle
import android.os.StrictMode
import android.widget.Button
import android.widget.EditText
import android.widget.TextView
import android.widget.Toast
import okhttp3.FormBody
import okhttp3.OkHttpClient
import okhttp3.Request
import okhttp3.RequestBody
import org.json.JSONException
import org.json.JSONObject
import java.io.IOException

class LoginActivity : AppCompatActivity() {
    val appPreference:String = "appPrefer"
    val idPreference:String = "idPref"
    val usernamePreference:String = "usernamePref"
    val typePreference:String = "typePref"
//15-17 code เดิม
    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_login)

        //To run network operations on a main thread or as an synchronous task.
        val policy = StrictMode.ThreadPolicy.Builder().permitAll().build()
        StrictMode.setThreadPolicy(policy)

        val textViewRegister = findViewById<TextView>(R.id.textViewRegister)
        textViewRegister.setOnClickListener{
            val intent = Intent(applicationContext, RegisterActivity::class.java)
            startActivity(intent)
            finish()
    }

    //Find to components on a layout
    val editUsername = findViewById<EditText>(R.id.editTextUsername)
    val editPassword = findViewById<EditText>(R.id.editTextPassword)
    val btnLogin = findViewById<Button>(R.id.btnLogin)
    val btnhome = findViewById<Button>(R.id.btnhome)


    btnhome.setOnClickListener{
        val intent = Intent(applicationContext, MainActivity::class.java)
        startActivity(intent)
        finish()
    }
    //Set action when a user clicks a login button
    btnLogin.setOnClickListener {

        val url = getString(R.string.root_url) + getString(R.string.login_url)
        val okHttpClient = OkHttpClient()

        val formBody: RequestBody = FormBody.Builder()
            .add("username", editUsername.text.toString())
            .add("password", editPassword.text.toString())
            .build()
        val request: Request = Request.Builder()
            .url(url)
            .post(formBody)
            .build()
        try {
            val response = okHttpClient.newCall(request).execute()
            if (response.isSuccessful) {
                try {
                    val obj = JSONObject(response.body!!.string())
                    val id = obj["id"].toString()
                    val username = obj["username"].toString()
                    val type = obj["type"].toString()


                    //Create shared preference to store user data
                    val sharedPrefer: SharedPreferences =
                        getSharedPreferences(appPreference, Context.MODE_PRIVATE)
                    val editor: SharedPreferences.Editor = sharedPrefer.edit()

                    editor.putString(idPreference, id)
                    editor.putString(usernamePreference, username)
                    editor.putString(typePreference, type)
                    editor.commit()

                    //return to login page
                    if (type == "0") //0 = general users
                    {
                        val intent = Intent(applicationContext, MainActivity::class.java)
                        startActivity(intent)
                        finish()
                    }
                    else if (type == "1")//1 = admin
                    {
                        val intent = Intent(applicationContext, MainActivity::class.java)
                        startActivity(intent)
                        finish()
                    }

                } catch (e: JSONException) {
                    e.printStackTrace()
                }
            } else {
                response.code
                Toast.makeText(applicationContext, "ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง", Toast.LENGTH_LONG).show()
            }
        } catch (e: IOException) {
            e.printStackTrace()
        }
    }
}

    override fun onResume() {
        val sharedPrefer: SharedPreferences =
            getSharedPreferences(appPreference, Context.MODE_PRIVATE)
        val usertype = sharedPrefer?.getString(typePreference, null)

        //if (sharedPrefer.contains(usernamePreference))
        if (usertype=="0") {
            val i = Intent(this, MainActivity::class.java)
            startActivity(i)
            finish()
        }
        else if(usertype=="1")
        {
            val i = Intent(this, MainActivity::class.java)
            startActivity(i)
            finish()
        }
        super.onResume()
    }
}
