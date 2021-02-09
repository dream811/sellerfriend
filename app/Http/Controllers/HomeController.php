<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Come;
use App\Models\Brand;
use App\Models\Category;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $comes = Come::where('bIsDel', 0)
                ->orderBy('strComeCode')
                ->get();
                //dd($comes);
        $brands = Brand::where('bIsDel', 0)
                ->orderBy('strBrandCode')
                ->get();
        $categories_1 = Category::where('bIsDel', 0)
                ->where('nCategoryType', 1)
                ->orderBy('strCategoryName')
                ->get();
        $categories_2 = Category::where('bIsDel', 0)
                ->where('nCategoryType', 2)
                ->orderBy('strCategoryName')
                ->get();

        $categories_3 = Category::where('bIsDel', 0)
                ->where('nCategoryType', 3)
                ->orderBy('strCategoryName')
                ->get();
        $categories_4 = Category::where('bIsDel', 0)
                ->where('nCategoryType', 4)
                ->orderBy('strCategoryName')
                ->get();
        $shareType = "1";
        $basePriceTypes= array('CNY', 'KRW', 'USD', 'JPY');
        $countryShippingCostTypes= array('CNY', 'KRW', 'USD', 'JPY');
        $worldShippingCostTypes= array('KRW');
        $weightTypes= array('Kg');
        $title = "상품스크랩";
        return view('home', compact('title', 'brands', 'comes', 'categories_1', 'categories_2', 'categories_3', 'categories_4', 'shareType', 'basePriceTypes', 'countryShippingCostTypes', 'worldShippingCostTypes', 'weightTypes'));
    }
}
