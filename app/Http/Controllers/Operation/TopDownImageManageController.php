<?php

namespace App\Http\Controllers\Operation;

use App\Http\Controllers\Controller;
use App\Models\DocumentImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stichoza\GoogleTranslate\GoogleTranslate;
use App\Models\Market;
use App\Models\MarketAccount;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Console\Input\Input;
use Yajra\DataTables\DataTables;

class TopDownImageManageController extends Controller
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

        $title = "상하단 이미지관리";
        if ($request->ajax()) {
            $images = DocumentImage::where('bIsDel', 0)
               ->where('nUserId', Auth::id());

            return DataTables::of($images)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '<button type="button" data-id="'.$row->nIdx.'" style="font-size:10px !important;" class="mr-1 btn btn-xs btn-primary btnEdit">수정</button>';
                    $btn .= '<button type="button" data-id="'.$row->nIdx.'" style="font-size:10px !important;" class="btn btn-xs btn-danger btnDelete">삭제</button>';
                    return $btn;
                })
                ->addColumn('image', function($row){
                    $element = '<img alt="Avatar" style="width: 5rem;" class="table-product-image" src="'. $row->strImageURL.'">';
                    return $element;
                })
                ->rawColumns(['image', 'action'])
                ->make(true);
        }
        $images = DocumentImage::where('bIsDel', 0)
               ->where('nUserId', Auth::id());

        return view('operation.TopDownImageList', compact('title', 'images'));
    }

    

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function store(Request $request)
    {
        $imageFile = $request->file('fileImage');
        $new_name = rand() . '.' . $imageFile->getClientOriginalExtension();
        $old_name = $imageFile->getClientOriginalName();
        $path = $request->file('fileImage')->storeAs('uploads/users/'.Auth::id().'document_images', $new_name, 'public');
        $docImage = new DocumentImage([
            'nUserId' => Auth::id(),
            'strImageType' => $request->post('selImageType'),
            'strImageURL'=> asset('storage/'.$path),
            'strImageName'=> $request->post('txtImageName'),
            'strFileName'=> $old_name,
            'bIsDel'=> 0
        ]);
		$docImage->save();    
        return response()->json(["status" => "success", "data" => $docImage]);
    }
    /**
     * Display the specified resource.
     *
     */
    public function edit($imageId = 0)
    {
        //
        $documentImage  = DocumentImage::where('nIdx', $imageId)->first();
        return response()->json(["status" => "success", "data" => $documentImage]);
    }

    public function update(Request $request)
    {
        $image = DocumentImage::find($request->post('hidImageId'));
        //if exist new file, delete old file
        $imageFile = $request->file('fileImage');
        if($imageFile != null){
            Storage::delete('public/'.$image->strImageURL);
            $new_name = rand() . '.' . $imageFile->getClientOriginalExtension();
            $old_name = $imageFile->getClientOriginalName();
            $path = $request->file('fileImage')->storeAs('uploads/users/'.Auth::id().'document_images', $new_name, 'public');

            //edit file info of db
            $image->strImageURL = asset('storage/'.$path);
            $image->strFileName = $old_name;
        }
        $image->strImageType = $request->get('selImageType');
        $image->strImageName = $request->get('txtImageName');
        $request->get('selImageType');
        $request->get('txtImageName');

        $image->update();
        return response()->json(["status" => "success", "data" => $image]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $accountId
     * @return \Illuminate\Http\Response
     */
    public function delete($imageId)
    {
        //
        $image = DocumentImage::find($imageId);
        Storage::delete('public/'.$image->strImageURL);
        $image->delete();
        return response()->json(["status" => "success", "data" => "Successfully removed!"]);
    }

}
