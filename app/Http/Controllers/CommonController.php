<?php

namespace App\Http\Controllers;

use App\Models\CustomerService;
use App\Models\CustomerServiceHistory;
use App\Models\Designation;
use App\Models\Leadconfig;
use App\Models\LeadOrganization;
use App\Models\Location;
use App\Models\Organization;
use App\Models\Product;
use App\Models\ProductForm;
use App\Models\ProductSubCategory;
use App\Models\Profession;
use App\Models\SmsHistory;
use App\Models\Tenure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Encore\Admin\Auth\Database\Administrator;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class CommonController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function getSubCategory(Request $request)
    {
        $category=$request->get('q');
        $data = ProductSubCategory::select('id',DB::raw("name as text"))->where('category_id',$category)->where('status',1)->get();
        return $data;
    }

    public function home(){
        $products = Product::select(['id','name','price','photo','special_price'])->where('status',1)->get();
//        dd($products);
        return Inertia::render('HomeComponent', compact('products'));
    }
}
