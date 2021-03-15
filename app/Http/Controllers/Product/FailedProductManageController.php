<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stichoza\GoogleTranslate\GoogleTranslate;
use App\Models\Product;
use App\Models\ProductItem;
use App\Models\ProductImage;
use App\Models\ProductDetail;
use App\Models\Come;
use App\Models\Brand;
use App\Models\Category;
use App\MyLibs\CoupangConnector;
use Yajra\DataTables\DataTables as DataTables;

class FailedProductManageController extends Controller
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
    public function index(Request $request)
    {
        
        $tr = new GoogleTranslate(); // Translates to 'en' from auto-detected language by default

        $title = "상품등록 실패관리";
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


        if ($request->ajax()) {
            $products = Product::where('bIsDel', 0)
                ->where('nUserId', Auth::id())
                ->orderBy('nIdx');

            return DataTables::eloquent($products)
                    ->addIndexColumn()
                    ->addColumn('check', function($row){
                        $check = '<input type="checkbox" name="chkProduct[]" onclick="" value="'.$row->nIdx.'">';
                        return $check;
                    })
                    ->addColumn('action', function($row){
                        $btn = '';
                        return $btn;
                    })
                    ->addColumn('images', function($row){
                        $btn = '<ul class="list-inline" style="width:100px;">';
                        foreach ($row->productImages as $productImage) {
                            $btn .= '<li class="list-inline-item">
                                        <img alt="Avatar" class="table-avatar" src="'.$productImage->strURL.'">
                                    </li>';
                        }
                        $btn .= '</ul>';
                        return $btn;
                    })
                    ->addColumn('productInfo', function($row){
                        $element = '<ul class="list-inline" style="">';
                        $element .= '<li class="list-inline-item">
                                    '.$row->strCategoryCode1.'>'.$row->strCategoryCode2.'>'.$row->strCategoryCode3.'>'.$row->strCategoryCode4.'
                                </li><br>';
                        $element .= '<li class="list-inline-item">
                                    '.$row->strKrSubName.'
                                </li>';

                        $element .= '</ul>';
                        return $element;
                    })
                    ->addColumn('priceInfo', function($row){
                        $element = '<ul class="list-inline" style="width:100px;">';
                        $element .= '<li class="list-inline-item">
                                '.$row->productDetail->nBasePrice.'
                            </li><br>';
                        $element .= '<li class="list-inline-item">
                                '.$row->productDetail->nBasePrice.'
                            </li>';
                                
                        $element .= '</ul>';
                        return $element;
                    })
                    ->addColumn('marginInfo', function($row){
                        $element = '<ul class="list-inline" style="width:100px;">';
                        $element .= '<li class="list-inline-item">
                                '.$row->productDetail->nBasePrice.'
                            </li><br>';
                        $element .= '<li class="list-inline-item">
                                '.$row->productDetail->nBasePrice.'
                            </li>';
                        $element .= '</ul>';
                        return $element;
                    })
                    ->addColumn('marketInfo', function($row){
                        $marketInfo = '
                                <span style="width:20px;" class="badge badge-success">C</span>
                                <span style="width:20px;" class="badge badge-success">11</span>
                                <span style="width:20px;" class="badge badge-success">A</span>
                                <span style="width:20px;" class="badge badge-success">G</span>
                                <br/>
                                <span style="width:20px;" class="badge badge-success">I</span>
                                <span style="width:20px;" class="badge badge-success">S</span>
                                <span style="width:20px;" class="badge badge-success">T</span>
                                <span style="width:20px;" class="badge badge-success">W</span>
                                ';
                        return $marketInfo;
                    })
                    ->addColumn('mainImage', function($row){
                        $btn = '<img alt="Avatar" style="width: 5rem;" class="table-product-image" src="'.asset('assets/images/product/image.jpg').'">';
                        return $btn;
                    })
                    ->rawColumns(['check', 'productInfo', 'mainImage', 'marketInfo', 'priceInfo', 'marginInfo'])
                    ->make(true);
                    
        }
        return view('product.FailedProductManage', compact('title', 'brands', 'comes', 'categories_1', 'categories_2', 'categories_3', 'categories_4'));
    }

    
    /**
     * 마켓 카테고리 탐색
     */
    public function marketCategorySearch($marketCode = 'coupang', $categoryCode = 0, Request $request)
    {
        if($marketCode == 'coupang'){
            $coupang = new CoupangConnector();
            $res =  (object)json_decode($coupang->getCategoryInfoViaCode($categoryCode), false);
            //$marketCode
            if($res->code = "SUCCESS"){
                $categories_1 = $res->data->child;
            }
        }
        
        if ($request->ajax()) {
            if($res->code = "SUCCESS"){
                $categories = $res->data->child;
                return response()->json(["status" => "success", "data" => $categories]);
            }
            return response()->json(["status" => "error", "data" => array()]);
        }
        
        //dd($categories_1);
        return view('product.MarketCategorySearch', compact('marketCode', 'categories_1'));
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function add(Request $request)
    {
        //$product  = Product::where('nIdx', $request->post('id'))->first();
        $product  = Product::where('nIdx', 1)->first();
        $coupang = new CoupangConnector();
        //$coupang->getCategoryInfoViaCode(56174);
        $coupang->getCategoryMetaInfo(0);
        // $coupang->getCategoryListInfo();
        // $coupang->addOutboundShippingCenter();
        // $coupang->addReturnShippingCenter();
        $coupang->addProduct();
        return view('product.MarketIDList');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function saveMarketProduct(Request $request)
    {
        //$product  = Product::where('nIdx', $request->post('id'))->first();
        $product  = Product::where('nIdx', 1)->first();
        $coupang = new CoupangConnector();
        //$coupang->getCategoryInfoViaCode(56174);
        $coupang->getCategoryMetaInfo(56174);
        // $coupang->getCategoryListInfo();
        // $coupang->addOutboundShippingCenter();
        // $coupang->addReturnShippingCenter();
        $coupang->addProduct();
        //return response()->json(["status" => "success", "data" => $marketAccount]);
    }
    
}
