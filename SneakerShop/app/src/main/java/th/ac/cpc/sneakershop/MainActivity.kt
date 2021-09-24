package th.ac.cpc.sneakershop

import android.content.Intent
import androidx.appcompat.app.AppCompatActivity
import android.os.Bundle
import android.view.Menu
import android.view.MenuItem
import android.widget.Toast
import androidx.appcompat.widget.Toolbar
import androidx.fragment.app.Fragment
import androidx.navigation.ui.AppBarConfiguration
import com.google.android.material.bottomnavigation.BottomNavigationView

class MainActivity : AppCompatActivity() {

    private lateinit var appBarConfiguration: AppBarConfiguration

    override fun onCreate(savedInstanceState: Bundle?) {

        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_main)
        val toolbar: Toolbar = findViewById(R.id.toolbar)
        setSupportActionBar(toolbar)
        
        //binding bottom menu and fragment
        val navView: BottomNavigationView = findViewById(R.id.nav_view)
        val transaction = supportFragmentManager.beginTransaction()
        transaction.replace(R.id.nav_host_fragment, HomeFragment())
        transaction.commit()
        navView.setOnNavigationItemSelectedListener {
            var fm: Fragment = HomeFragment()
            when (it.itemId) {
                R.id.nav_home -> fm = HomeFragment()
                R.id.nav_user -> fm = UserFragment()
                R.id.nav_history -> fm = HistoryFragment()
                R.id.nav_report -> fm = ReportFragment()
                R.id.nav_hotpro -> fm = TopProductFragment()
            }

            //this.supportActionBar!!.title = "Home"

            val transaction = supportFragmentManager.beginTransaction()
            transaction.replace(R.id.nav_host_fragment, fm)
            transaction.commit()
            return@setOnNavigationItemSelectedListener true
        }

    }
    override fun onCreateOptionsMenu(menu: Menu?): Boolean {
        menuInflater.inflate(R.menu.menu_main,menu);
        //return super.onCreateOptionsMenu(menu)
        return true
    }

    override fun onOptionsItemSelected(item: MenuItem): Boolean {
        val id = item.itemId;
        if (id == R.id.nav_cart){
            Toast.makeText(this,"ตระกร้าสินค้า", Toast.LENGTH_SHORT).show()
            val transaction = supportFragmentManager.beginTransaction()
            transaction.replace(R.id.nav_host_fragment, CartFragment())
            transaction.commit()
        }
        return  super.onOptionsItemSelected(item)
    }


}