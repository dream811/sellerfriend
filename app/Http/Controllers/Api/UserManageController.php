<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stichoza\GoogleTranslate\GoogleTranslate;
use App\Models\Product;
use App\Models\ProductItem;
use App\Models\ProductImage;
use App\Models\ProductDetail;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserManageController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('api');
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function loginCheck(Request $request)
    {
        $strEmail = $request->input('email');
        $strPwd = $request->input('pwd');
        $user = User::where('email', $strEmail)
            ->where('bIsUsed', 1)
            ->where('bIsDel', 0)
            ->first();
        
        if(!isset($user)){
            return response()->json(["status" => "failed", "data" => array()]);
        }

        if(!Hash::check($strPwd, $user->password)){
            return response()->json(["status" => "invalied", "data" => array()]);
        }else{
            return response()->json(["status" => "success", "data" => $user->api_token]);
        }
    }
}
