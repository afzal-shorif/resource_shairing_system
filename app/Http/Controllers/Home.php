<?php

namespace App\Http\Controllers;
use App\Mail\ConfirmEmail;
use App\Models\Prime_model;
use App\Models\ResourceModel;
use Illuminate\Support\Facades\Storage;
use Session;
use Illuminate\Support\Facades\Mail;
use DB;
class Home extends Controller
{
    // initial page after login student or teacher

    /**
     * generate a list of available resource for the user
     * require a model to get the data from server
     * @return View
     */
    public function index($class = 1){
        // get all file list
        // with pagination
        /// user_type = 2 (student)
        /// user_type = 1 (teacher)
        if(!is_numeric($class)){
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



            DB::table('download')
            ->updateOrInsert(['resource_id' => $resource_id]);
            DB::table('download')
                ->where('resource_id', $resource_id)
                ->increment('download_count');
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
        return redirect('/home/1');
    }


    /**
        delete all session data and redirect /login route
    */
    public function logout(){

        Session::flush();
        return redirect('/login');
    }


}
