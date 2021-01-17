<?php

namespace App\Http\Controllers;

use App\Mail\ConfirmEmail;
use Auth;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Hash;
use Validator;
use App\Models\Prime_model;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Mail;
use DB;
use function PHPUnit\Framework\isEmpty;

class Authorization extends Controller
{

    /**
     * @return View
     */
    public function index($user_type = null){
        $data['header'] = "";

        if($user_type == "student"){
            $data['header'] = "Student Login";
            $data['type'] = 2;
            $data['register_url'] = url('/register/student');
        }else if($user_type == "teacher") {
            $data['header'] = "Teacher Login";
            $data['type'] = 1;
            $data['register_url'] = url('/register/teacher');
        }else if($user_type == "admin"){
            $data['header'] = "Admin Login";
            $data['type'] = 0;
            $data['register_url'] = "";
        }else{
            return redirect('/login/student');
        }

        $data['title'] = "Online Academic Resources Sharing :: ".$data['header'];

        return view('login',$data);

    }

    /**
     * @param Request $request
     * @return Redirector
     * @throws ValidationException
     */
    public function check_login(Request $request){
        // set validation rule


        $this->validate($request,
            [
                'email' => 'required|string',
                'password' => 'required|alpha_num|min:3',
                'type' => 'required|numeric'
            ]
        );

        if(!filter_var($request->get('email'), FILTER_VALIDATE_EMAIL)){

            $result = DB::table('users')->where('username', $request->get('email'))->get();

            $email = "";

            foreach ($result as $item) {
                $email = $item->email;
                break;
            }

            if($email != ""){
                $request['email'] = $email;
            }

        }

        $remember = $request->has('remember_me')? true : false ;


        // store the form value in $user_data array
        $user_data = array(
            'email' => $request->get('email'),
            'password' => $request->get('password'),
            'user_type' => $request->get('type'),
        );


        if(Auth::attempt($user_data, $remember)){
            // success attempt
            // start session and redirect Home@index

            $user = Prime_model::get_user_id_and_type($user_data['email']);

            if($user[3] == 0){
               return back()->with('error', "Your Account is not active yet.");
            }
            // if admin
            $request->session()->put('authorize', 'anyValue');
            $cart = array();
            $request->session()->put('user_name', $user[2]);
            $request->session()->put('cart', $cart);

            if($user[1] == 0){

                $request->session()->put('type', 'admin');
                $request->session()->put('user_type', 0);
                $request->session()->put('user_id', 1);
            }else{
                // not admin
                $request->session()->put('user_type', $user[1]);
                $request->session()->put('user_id', $user[0]);
            }

            return redirect('/home/1');
        }else{
            // fail login
            // go back with error message

            return back()->with('error', 'Invalid Email or Password');
        }


    }

    /**
     * @param $user_type :{string} type of user (student | teacher)
     * @return View
     */
    public function register($user_type = null){

        $data['header'] = "";

        if($user_type == "student"){

            $data['type'] = "student";
            $data['header'] = "Student Registration";
            $data['login_url'] = url('/login/student');
            $data['register_type'] = 'register_student';
        }else if($user_type == "teacher"){

            $data['type'] = "teacher";
            $data['header'] = "Teacher Registration";
            $data['login_url'] = url('/login/teacher');
            $data['register_type'] = 'register_teacher';
        }else{
            return redirect('/register/student');
        }

        $data['title'] = "Online Academic Resources Sharing :: ".$data['header'];

        return view('register', $data);
    }


    public function register_teacher(Request $request){

        $request->validate([
            'first_name' => 'required|alpha|min:3|max:10',
            'last_name' => 'required|alpha|min:3|max:10',
            'username' => 'required|alpha_num|min:3|max:10|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|alpha_num|min:6|max:15',
            'phone' => 'regex:/01[1-9]([0-9]){8}/'
        ]);


        // user_type = admin = 1
        // user_type = teacher = 2
        // user_type = student = 3
        $user_data = array(
            'user_type' => 1,
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'username' => $request->get('username'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
            'phone' => $request->get('phone'),
        );

        $create_user = Prime_model::create_user($user_data);

        if($create_user){
            /*
            $data = array('name'=> "Manik");

            Mail::send(
                ['text'=>'verification'],
                $data,
                function($message) {
                    $message->to('asmanik20@outlook.com', 'Manik')
                        ->subject('Please verify your email address! Do nor reply');
                    $message->from('hr.admin@easysqlbd.com','Tamim Khan');
                });

            */

            $notification = $request->get('first_name').' '.$request->get('last_name')." is registered as a Teacher.";

            Prime_model::notification($notification);
            return back()->with('success', 'Account Create successfully. Please Log in..');
        }else{
            return back()->with('error', 'Something Wrong Happened. Please try later..');
        }
    }

    public function register_student(Request $request){

        $request->validate([
            'first_name' => 'required|alpha|min:3|max:10',
            'last_name' => 'required|alpha|min:3|max:10',
            'username' => 'required|alpha_num|min:3|max:10|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|alpha_num|min:6|max:15',
            'phone' => 'regex:/01[1-9]([0-9]){8}/',
        ]);


        // user_type = admin = 1
        // user_type = teacher = 2
        // user_type = student = 3
        $user_data = array(
            'user_type' => 2,
            'first_name' => ucfirst($request->get('first_name')),
            'last_name' => ucfirst($request->get('last_name')),
            'username' => strtolower($request->get('username')),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
            'phone' => $request->get('phone'),
        );

        $create_user = Prime_model::create_user($user_data);

        if($create_user){
            $notification = $request->get('first_name').' '.$request->get('last_name')." is registered as a Student.";

            Prime_model::notification($notification);

            return back()->with('success', 'Account Create successfully. Please Log in..');
        }else{
            return back()->with('error', 'Something Wrong Happened. Please try later..');
        }
    }

    public function home(){
        $popular = DB::table('download')
            ->leftJoin('resource', 'download.resource_id', '=', 'resource.resource_id')
            ->leftJoin('users', 'resource.user_id', '=', 'users.id')
            ->select('resource.*', 'users.first_name', 'users.last_name')
            ->orderBy('download_count', 'desc')
            #->where('resource.visibility', '=', 1)
            ->paginate(4);
        return view('index', ['title'=> "Online Academic Resources Sharing", 'popular' => $popular]);
    }

    public function user_select(){
        return view('login_select', ['title'=> "Online Academic Resources Sharing"]);
    }

}
