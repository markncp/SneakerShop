<?php

namespace App\Http\Controllers\API;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Brand;
use Illuminate\Http\Request;
use DB;

class BrandController extends Controller
{
    public function index()
    {
     
        $sql = "SELECT *FROM producttype" ;      
        return response()->json( DB::select($sql) );
    }
}