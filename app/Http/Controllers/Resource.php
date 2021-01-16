<?php

namespace App\Http\Controllers;

use App\Models\Prime_model;
use Illuminate\Http\Request;
use App\Models\Resource_model;
use Session;
use Image;
use Storage;
use DB;
class Resource extends Controller
{
    //
    public function index($class){

        $data['resources'] = Resource_model::get_user_resource($class);
        $data['class'] = Prime_model::get_class();
        $data['title'] = 'My Resource :: Online Academic Resources Sharing';

        //return $data['resources'];

        foreach ($data['resources'] as $resource) {
            $url = url('/update_visibility?resource_id='.$resource->resource_id);
            if($resource->visibility == 1){

                if(Session::get('user_type')==1){
                    $resource->visibility = '<a href="'.$url.'">All</a>';
                }else{
                    $resource->visibility = 'All';
                }

            }else{
                if(Session::get('user_type')==1){
                    $resource->visibility = '<a href="'.$url.'">Teacher Only</a>';
                }else{
                    $resource->visibility = 'All';
                }
            }

        }




        return view('my_resource', $data);

    }


    public function create(){
        $data['title'] = "Create Resource :: Online Academic Resources Sharing";
        $data['class'] = Prime_model::get_class();
        return view('create_resource', $data);
    }

    public function upload_book(Request $request){
        $request->validate([
            'book_title' => 'required|max:100|min:10',
            'book_description' => 'required|max:200|min:20',
            'book_class' => 'required|numeric',
            'book_cover_photo' => 'required|image|max:1024',
            'book_file' => 'required|mimes:pdf|max:5120'
        ]);

        //$cover_photo_name = $request->file('book_cover_photo')->getClientOriginalName();
        //$path = $request->file('book_cover_photo')->getPath();

        $cover_photo_name = substr($request->file('book_cover_photo')->store('public/thumbnail'), 17);
        $book_name = substr($request->file('book_file')->store('files'),6);

        Image::make(storage_path('app/public/thumbnail/'.$cover_photo_name))
        ->resize(330, 274)
        ->save(storage_path('app/public/thumbnail/'.$cover_photo_name));

        Storage::delete($cover_photo_name);

        // hide from student
        $visibility = 1;
        if(Session::get('user_type') == 1) $visibility = 0;


        $file_data = [
            'user_id' => Session::get('user_id'),
            'title' => $request->get('book_title'),
            'description' => $request->get('book_description'),
            'source' => $book_name,
            'thumbnail' => $cover_photo_name,
            'class_id' => $request->get('book_class'),
            'visibility' => $visibility,
            'price' => 0,
            'type' => 1,
        ];

        if(Resource_model::upload($file_data)){

            $message = Session::get('user_name')." Upload a new Book.";
            Prime_model::message($message);

            return back()->with('success',"Book Upload Successful.");
        }

        return back()->with('error',"Something Wrong Happened. Please try later..");
    }

    public function upload_slide(Request $request){
        $request->validate([
            'slide_title' => 'required|max:100|min:10',
            'slide_description' => 'required|max:200|min:20',
            'slide_class' => 'required|numeric',
            'slide_cover_photo' => 'required|image|max:1024',
            'slide_file' => 'required|mimes:ppt,pptx,pdf|max:5120',
            'slide_price' => 'required|numeric|max:1000|min:10'
        ]);


        $cover_photo_name = substr($request->file('slide_cover_photo')->store('public/thumbnail'), 17);
        $book_name = substr($request->file('slide_file')->store('files'),6);

        Image::make(storage_path('app/public/thumbnail/'.$cover_photo_name))
            ->resize(330, 274)
            ->save(storage_path('app/public/thumbnail/'.$cover_photo_name));

        Storage::delete($cover_photo_name);

        // hide from student
        $visibility = 1;
        if(Session::get('user_type') == 1) $visibility = 0;


        $file_data = [
            'user_id' => Session::get('user_id'),
            'title' => $request->get('slide_title'),
            'description' => $request->get('slide_description'),
            'source' => $book_name,
            'thumbnail' => $cover_photo_name,
            'class_id' => $request->get('slide_class'),
            'visibility' => $visibility,
            'price' => $request->get('slide_price'),
            'type' => 2,
        ];

        if(Resource_model::upload($file_data)){
            $message = Session::get('user_name')." Upload a new Slide.";
            Prime_model::message($message);
            return back()->with('success',"Slide Upload Successful.");
        }

        return back()->with('error',"Something Wrong Happened. Please try later..");
    }

    public function upload_link(Request $request){
        $request->validate([
            'link_title' => 'required|max:100|min:10',
            'link' => 'required|url',
            'link_class' => 'required|numeric',
            'link_description' => 'required|string|min:20|max:200'
        ]);

        $file_data = [
            'user_id' => Session::get('user_id'),
            'title' => $request->get('link_title'),
            'description' => $request->get('link_description'),
            'source' => $request->get('link'),
            'thumbnail' => "link.png",
            'class_id' => $request->get('link_class'),
            'visibility' => 1,
            'price' => 0,
            'type' => 3,
        ];

        if(Resource_model::upload($file_data)){
            $message = Session::get('user_name')." Upload a new Link.";
            Prime_model::message($message);
            return back()->with('success',"Link Save Successful.");
        }

        return back()->with('error',"Something Wrong Happened. Please try later..");
    }

    public function update_visibility(Request $request){

        $resource_id = $request->query('resource_id');

        $row = DB::table('resource')->select('visibility')->where('resource_id', $resource_id)->where('user_id', Session::get('user_id'))->first();

        if($row){
            if($row->visibility == 1){
                DB::table('resource')->where('resource_id', $resource_id)->update(['visibility' => 0]);
            }else{
                DB::table('resource')->where('resource_id', $resource_id)->update(['visibility' => 1]);
            }
        }

        return back();
    }

    public function delete_resource(Request $request){
        $resource_id = $request->query('resource_id');
        DB::table('resource')->where('resource_id', $resource_id)->where('user_id', Session::get('user_id'))->delete();
        return back();
    }

    public function update_resource(Request $request){
        $resource_id = $request->query('resource_id');
        $row = DB::table('resource')->where('resource_id', $resource_id)->where('user_id', Session::get('user_id'))->first();
        $data['class'] = Prime_model::get_class();
        if($row){
            $data['title'] = "Update Resource :: ".$row->title;
            $data['resource'] = $row;
            return view('update_resource', $data);
        }

        return back();
    }

    public function update(Request $request){
        $p = false;
        $f = false;

        $request->validate([
            'title' => 'required|max:80|min:5',
            'description' => 'required|max:100|min:15',
            'class' => 'required|numeric',
            'resource_id' => 'required|numeric'
        ]);

        if($request->has('price')){
            $request->validate([
                'price' => 'required|numeric|max:1000|min:10'
            ]);
        }

        // if link
        if($request->has('link')){
            $request->validate([
                'link' => 'required|url'
            ]);
        }

        // if photo exixt check validation and set p flag is true
        if ($request->hasFile('cover_photo')) {
            $request->validate([
                'cover_photo' => 'required|image|max:1024'
            ]);
            $p = true;
        }
        // if file is exist check validate and set f flag is true
        if($request->hasFile('file')){
            $request->validate([
                'file' => 'required|mimes:ppt,pptx,pdf|max:5120'
            ]);
            $f = true;
        }

        $cover_photo_name = null;
        $file_name = null;

        // if photo exist and valid upload the photo
        if($p){
            $cover_photo_name = substr($request->file('cover_photo')->store('public/thumbnail'), 17);

            Image::make(storage_path('app/public/thumbnail/'.$cover_photo_name))
                ->resize(330, 274)
                ->save(storage_path('app/public/thumbnail/'.$cover_photo_name));

            Storage::delete($cover_photo_name);
        }

        // if file exist and valid file
        if($f){
            $file_name = substr($request->file('file')->store('files'),6);
        }

        if($request->has('link')){
            // locally update
            $result = DB::table('resource')->where('user_id', Session::get('user_id'))->where('resource_id', $request->get('resource_id'))
              ->update([
                  'title' => $request->get('title'),
                  'class' => $request->get('class'),
                  'description' => $request->get('description'),
                  'link' => $request->get('link')
              ]);


            if(!$result){
                // fail
                return back()->with('error', "An error occur. Please try later..");
            }else{
                // success
                return redirect('my_resource/'.$request->get('class'));
            }

        }else{
            if($request->has('price')){
                $price = $request->get('price');
            }else $price = 0;

            $file_data = [
                'title' => $request->get('title'),
                'description' => $request->get('description'),
                'class_id' => $request->get('class'),
                'price' => $price,
            ];

            if($cover_photo_name != null){
                $file_data['thumbnail'] = $cover_photo_name;
            }
            if($file_name != null){
                $file_data['source'] = $file_name;
            }


            $result = DB::table('resource')->where('user_id', Session::get('user_id'))
                ->where('resource_id', $request->get('resource_id'))
                ->update($file_data);

            if(!$result){
                // fail
                return back()->with('error', "An error occur. Please try later..");
            }else{
                // success
                return redirect('my_resource/'.$request->get('class'));
            }
        }

        return back();
    }

    public function search(Request $request){
        if($request->get('search') == ""){
            return back();
        }
        //search on bd
        $files = DB::table('resource')
            ->leftJoin('users', 'resource.user_id', '=', 'users.id')
            ->select('resource.*', 'users.first_name', 'users.last_name')
            ->where('title', 'like', '%'.$request->get('search').'%')
            ->orWhere('description', 'like', '%'.$request->get('search').'%')
            ->orderBy('resource.resource_id', 'desc')
            ->paginate(6);
        $class = Prime_model::get_class();
        $purchase = Prime_model::get_purchase_list(Session::get('user_id'));
        return view('search', ['title'=> "Search :: Online Academic Resources Sharing",
            'files' => $files, 'class' => $class, 'purchase'=>$purchase]);
    }

}
