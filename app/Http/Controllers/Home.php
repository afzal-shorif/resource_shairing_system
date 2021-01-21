<?php

namespace App\Http\Controllers;

use App\Models\Prime_model;
use App\Models\Resource_model;
use App\Models\ResourceModel;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Storage;
use Session;
use Image;
use DB;

class Home extends Controller
{
    // initial page after login student or teacher

    /**
     * generate a list of available resource for the user
     * require a model to get the data from server
     * @return View
     */
    public function index($class = null){
        // get all file list
        // with pagination
        /// user_type = 2 (student)
        /// user_type = 1 (teacher)
        if(!is_numeric($class) || $class == null){
            return redirect('/home/1');
        }
        if(Session::get('user_type')==2){
            $available_file_list = Prime_model::get_file_list_for_student($class);
        }else{
            $available_file_list = Prime_model::get_file_list_for_teacher($class);
        }

        $purchase = Prime_model::get_purchase_list(Session::get('user_id'));
        $class = Prime_model::get_class();


        $num_to_word = array("zero", "one", "two", "three", "four", "five", "six", "seven",
                   "eight", "nine", "ten", "eleven", "twelve",);


        return view('home', ['title'=>'Online Academic Resources Sharing :: Home', 'files'=>$available_file_list, 'purchase'=>$purchase, 'class'=> $class, 'num_to_word'=>$num_to_word]);
    }

    /**
     * generate download link
     * use public store driver
     * @param string $filename
     * @return file in http protocol
     */

    public function download($filename = '', $resource_id = null){

        if ( file_exists( Storage::path('files/'.$filename) ) ) {


            /// initialize resource_id with 0 in download table
            DB::table('download')
            ->updateOrInsert(['resource_id' => $resource_id]);

            $download = Resource_model::check_download($resource_id);
            /// if not download yet
            if($download<=0){
                DB::table('download')
                    ->where('resource_id', $resource_id)
                    ->increment('download_count');
            }
            DB::table('temp')->where('user_id', Session::get('user_id'))->where('resource_id', $resource_id)->update(['flag' => 1]);
            // Send Download
            return Storage::download('files/'.$filename);
        } else {
            // Error
            exit( 'Requested file does not exist on our server!' );
        }

    }

    /**
     * add item to cart array
     * cart array store in session
     * @parameter 2
     *      1. page number for redirect to same page
     *      2. resource id to store into the cart array
     * redirect the /home/page_number route (same page with pagination)
     */
    public function add_to_cart($page, $resource_id){

        /// copy the session array to the local array
        /// push the new resource id to local array
        /// update the session array with local array
        $cart = array();

        $cart = Session::get('cart');

        /// if resource_id not exist
        if(in_array($resource_id, $cart) == false)  array_push($cart,$resource_id);
        Session::put('cart',$cart);

        return redirect('/home/?page='.$page);
    }

    /**
     * generate cart.blade.php view file
     * show the list of cart item
     * load model to get the cart items
     * return /cart
    */

    public function cart(){
        $data = Prime_model::get_cart_item();
        $class = Prime_model::get_class();
        return view('cart',['title'=>'Cart :: Online Academic Resources Sharing','data'=>$data, 'class'=>$class]);
    }



    /**
     *  remove an element from cart array in session
     * @parameter 1
     *      array element that want to remove
     *  redirect /cart route
    */

    public function remove_to_cart($resource_id){

        $cart = Session::get('cart');

        $index = array_search($resource_id, $cart);
        if($index >= 0) {
            array_splice($cart, $index, 1);

        }

        Session::put('cart',$cart);

        return redirect('/cart');
    }

    /**
     *
     */
    public function cart_confirm(){
        Prime_model::cart_confirm();

        $message = Session::get('user_name')." is buy some resources.";
        Prime_model::message($message);

        return redirect('/home/1');
    }


    /**
        delete all session data and redirect /login route
    */
    public function logout(){

        Session::flush();
        return redirect('/');
    }


    /**
     * profile
     */
    public function profile(){
        $data['title'] = config('global.title');
        $data['class'] = Prime_model::get_class();
        $data['user_data'] = DB::table('users')->select('first_name','last_name','username','email', 'phone','picture')->where('id', Session::get('user_id'))->get();
        $data['balance'] = Resource_model::get_balance();
        return view('profile',$data);
    }

    public function update_firstname(Request $request){

        $request->validate([
            'first_name' => 'required|alpha|min:3|max:10',
        ]);

        $affected = DB::table('users')->where('id', Session::get('user_id'))->update(['first_name' => $request->get('first_name')]);

        if($affected){
            return back()->with('success', 'First Name Update Successfully.');
        }
        return back()->with('error', 'An Error occur. Please Try Later.');

    }

    public function update_lastname(Request $request){

        $request->validate([
            'last_name' => 'required|alpha|min:3|max:10',
        ]);

        $affected = DB::table('users')->where('id', Session::get('user_id'))->update(['last_name' => $request->get('last_name')]);

        if($affected){
            return back()->with('success', 'Last Name Update Successfully.');
        }
        return back()->with('error', 'An Error occur. Please Try Later.');

    }

    public function update_email(Request $request){

        $request->validate([
            'email' => 'required|email|unique:users,email',
        ]);

        $affected = DB::table('users')->where('id', Session::get('user_id'))->update(['email' => $request->get('email')]);

        if($affected){
            return back()->with('success', 'Email Update Successfully.');
        }
        return back()->with('error', 'An Error occur. Please Try Later.');

    }

    public function update_phone(Request $request){

        $request->validate([
            'phone' => 'regex:/01[1-9]([0-9]){8}/'
        ]);

        $affected = DB::table('users')->where('id', Session::get('user_id'))->update(['phone' => $request->get('phone')]);

        if($affected){
            return back()->with('success', 'Phone Number Update Successfully.');
        }
        return back()->with('error', 'An Error occur. Please Try Later.');

    }

    public function update_password(Request $request){

        $request->validate([
            'password' => 'required|confirmed|alpha_num|min:6|max:15',
            'old_password' => 'required|alpha_num',
        ]);


        $user = DB::table('users')->where('id', Session::get('user_id'))->first();


        if(Hash::check($request->get('old_password'), $user->password)){

            try{
                DB::table('users')->where('id', Session::get('user_id'))->update(['password' => Hash::make($request->get('password'))]);
                return back()->with('success', 'Password Update Successfully.');
            }catch (QueryException $ex){
                return back()->with('error', 'An Error occur. Please Try Later.');
            }

        }

        return back()->with('error', 'Current password does not match');
    }

    public function update_picture(Request $request){
        $request->validate([
            'picture' => 'required|image|max:1024'
        ]);

        $name = substr($request->file('picture')->store('public/profile'), 15);

        Image::make(storage_path('app/public/profile/'.$name))
            ->resize(140, 160)
            ->save(storage_path('app/public/profile/'.$name));

        Storage::delete($name);

        $affected = DB::table('users')->where('id', Session::get('user_id'))->update(['picture' => $name]);
        if($affected){
            return back()->with('success', 'Profile picture update successfully.');
        }

        return back()->with('error', 'Current password does not match');
    }

    public function payment(){
        $data['title'] = config('global.title');
        $data['class'] = Prime_model::get_class();

        return view('payment', $data);
    }

}
