<?php

namespace App\Http\Controllers\Admin\User;

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
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class UserManageController extends Controller
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
        $users = User::where('bIsDel', 0)
                ->where('bIsAdmin', 0)
                ->orderBy('name');
        if ($request->ajax()) {
            

            return DataTables::of($users)
                    ->addIndexColumn()
                    
                    ->addColumn('action', function($row){
                        $btn = '<button type="button" data-id="'.$row->id.'" style="font-size:10px !important;" class="btn btn-xs btn-primary btnEdit">수정</button>';
                        $btn .= '<button type="button" data-id="'.$row->id.'" style="font-size:10px !important;" class="ml-1 btn btn-xs btn-danger btnDelete">삭제</button>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
                    
        }
        return view('admin.user.UserManage', compact('users', 'title'));
    }

    //수정하려는 유저 선택(post)
    public function edit($userId = 0)
    {
        $title = "수정";
        if($userId == 0){
            $title = "추가";
        }

        $user = User::where('bIsDel', 0)
                    ->where('id', $userId)
                    ->firstOrNew();
        
        return view('admin.user.UserDetail', compact('title', 'userId', 'user'));
    }
    public function save(Request $request)
    {
        $path=$request->post('beforeImage');
        //dd($request);
        if ($request->file('fileImage')) {
            if($path != ""){
                Storage::delete('public/'.$path);
            }

            $imageFile = $request->file('fileImage');
            $new_name = rand() . '.' . $imageFile->getClientOriginalExtension();
            $old_name = $imageFile->getClientOriginalName();
            $path = $request->file('fileImage')->storeAs('uploads/profile_images', $new_name, 'public');
        }
        $user = User::updateOrCreate(
            ['id' => $request->post('userId')],
            [
                'name' => $request->post('txtName'),
                'strID' => $request->post('txtID'),
                'email' => $request->post('txtEmail'),
                'phone_number' => $request->post('txtPhone'),
                'password' => Hash::make($request->post('txtPWD1')),
                'image' => $path,
                'bIsAdmin' => $request->post('txtRole') == "ADMIN" ? 1 : 0,
                'role' => $request->post('selRole'),
                'money' => $request->post('txtMoney'),
                'business_name' => $request->post('txtBusinessName'),
                'business_number' => $request->post('txtBusinessNumber'),
                'business_phone' => $request->post('txtBusinessPhone'),
                'business_type' => $request->post('txtBusinessType'),
                'business_kind' => $request->post('txtBusinessKind'),
                'business_zip' => $request->post('txtBusinessZip'),
                'business_address1' => $request->post('txtBusinessAddress1'),
                'business_address2' => $request->post('txtBusinessAddress2'),
                'bIsUsed' => $request->post('rdoIsUsed'),
                'bIsDel' => 0,
            ]
        );
        //$user->image = asset('storage/'. $user->image);
        return response()->json(["status" => "success", "data" => $user]);
    }

    public function checkIDEmail(Request $request)
    {
        $email = 1;
        $id = 1;
        if($request->get('userId') == 0){
            if (User::where('strID', $request->get('txtID'))->count()) {
                $id=0;
            }
            if (User::where('email', $request->get('txtEmail'))->count()) {
                $email=0;
            }
        }else{
            $user = User::where('id', '!=', $request->get('userId'));
            if ($user->where('strID', $request->get('txtID'))->count()) {
                $id=0;
            }
            if ($user->where('email', $request->get('txtEmail'))->count()) {
                $email=0;
            }
        }
        return response()->json(["status" => "success", "data" => compact('id', 'email')]);
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
    /**
     * Display the specified resource.
     *
     */
    public function accountShow($marketId = 0, $accountId = 0)
    {
        //
        // $marketAccount  = MarketAccount::where('nIdx', $accountId)->first();
        return response()->json(["status" => "success", "data" => $marketAccount]);
    }

    public function accountUpdate($marketId=0, $accountId=0, Request $request)
    {
        // $marketAccount = MarketAccount::find($accountId);
        // $marketAccount->strAccountId = $request->post('txtAccountId');
        // $marketAccount->strAccountPwd = $request->post('txtAccountPwd');
        // $marketAccount->strAPIAccessKey = $request->post('txtAPIAccessKey');
        // $marketAccount->update();
        return response()->json(["status" => "success", "data" => $marketAccount]);

        // $tr = new GoogleTranslate(); // Translates to 'en' from auto-detected language by default

        // $title = "오픈마켓계정관리";
       
        // $marketAccounts = MarketAccount::where('bIsDel', 0)
        //         ->where('nMarketIdx', $id)
        //         ->where('nUserId', Auth::id())
        //         ->orderBy('nIdx')->paginate(15);
              //dd($markets);
        // return view('operation.OpenMarketAccountManage', compact('title', 'markets'))
        //    ->with('i', (request()->input('page', 1) - 1) * 15);
        //return response()->json(["status" => "success", "data" => $marketAccount]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $accountId
     * @return \Illuminate\Http\Response
     */
    public function accountDelete($marketId, $accountId)
    {
        //
        //$marketAccount = MarketAccount::where('nIdx', $accountId)->delete();
        return response()->json(["status" => "success", "data" => $marketAccount]);
    }
}
