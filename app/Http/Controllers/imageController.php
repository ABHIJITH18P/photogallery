<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Photogallery;
use Auth;
use Session;
use Response;
use App\User;
use DataTables;

class imageController extends Controller
{

    public function index(){
    	$images=Photogallery::paginate(6);
    	return view('welcome')->with('images',$images);
    }

    public function post(Request $request){
    	$this->validate($request,[
    		'image'=>'required'
    	]);
    	$images=$request->image;
    	foreach ($images as $key => $image) {
    		$image_new_name=time().$image->getClientOriginalName();
    		$image->move('images',$image_new_name);
    		$post=new Photogallery;
    		$post->image=$image_new_name;
    		$post->user_id=Auth::user()->id;
    		$post->save();
    		    	}
    		    	Session::flash('success','Images Uploaded Succesfully');
    		    	return redirect('/');
    }


    public function destroy($id){
    	$image=Photogallery::find($id);
    	$image->delete();
    	Session::flash('success','Image deleted Succesfully');
    	return redirect('/');
    }

    public function downloadImage(Request $request,$id){
        $id=$request->id;
        // echo $id;exit;
        $image_path= Photogallery::where('id', $id)->first();
        $image_path=$image_path->image;
        $path = Storage::path($image_path);
        // print_r($path);exit;
     //    $url = Storage::url($image_path);
     //    $contents = Storage::get($image_path);
     //    print_r($contents);
     //    // $contents = Storage::get($image_path);
     //    // print_r($contents);
        $file = public_path().$image_path;
        $headers = array('Content-Type: image/jpg',);
        return Response::download($file, $image_path,$headers);
    	return Storage::download($path);
    }

    public function userListAction(Request $request)
    {
             if ($request->ajax()) {

            $data = User::select('*');

            return Datatables::of($data)

                    ->addIndexColumn()

                    // ->addColumn('action', function($row){

     

                    //        $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>';

    

                    //         return $btn;

                    // })

                    // ->rawColumns(['action'])

                    ->make(true);

        }

        

        return view('users');
    }
}
