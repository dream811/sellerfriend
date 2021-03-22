<?php

namespace App\Http\Controllers\Admin\Product;

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
use App\Models\User;
use App\MyLibs\CoupangConnector;
use Yajra\DataTables\DataTables;

class CategoryManageController extends Controller
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
        $title = "사용자관리";
        if ($request->ajax()) {
            $users = User::where('bIsDel', 0)
                ->orderBy('name');

            return DataTables::of($users)
                    ->addIndexColumn()
                    
                    // ->rawColumns(['check', 'productInfo', 'mainImage', 'marketInfo', 'priceInfo', 'marginInfo'])
                    ->make(true);
                    
        }
        return view('admin.user.UserManage', compact('title'));
    }

    
}
