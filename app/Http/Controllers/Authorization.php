<?php

namespace App\Http\Controllers;

use App\Mail\ConfirmEmail;
use Auth;
use Illuminate\Support\Facades\Hash;
use Validator;
use App\Models\Prime_model;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Mail;

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
        }else if($user_type == "teacher"){
            $data['header'] = "Teacher Login";
            $data['type'] = 1;
            $data['register_url'] = url('/register/teacher');
        }else{
            return redirect('/login/student');
        }

        $data['title'] = $data['header']." :: Project Name";

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
                'email' => 'required|email',
                'password' => 'required|alphaNum|min:3',
                'type' => 'required|numeric'
            ]
        );

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

            $cart = array();
            $request->session()->put('authorize', 'anyValue');
            $request->session()->put('user_type', $user[1]);
            $request->session()->put('user_name', $user[2]);
            $request->session()->put('user_id', $user[0]);
            $request->session()->put('cart', $cart);

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

        $data['title'] = $data['header']." :: Project Name";

        return view('register', $data);
    }


    public function register_teacher(Request $request){

        $request->validate([
            'first_name' => 'required|alpha|min:3|max:10',
            'last_name' => 'required|alpha|min:3|max:10',
            'username' => 'required|alpha|min:3|max:10|unique:users,username',
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

            return back()->with('success', 'Account Create successfully. Please Log in..');
        }else{
            return back()->with('error', 'Something Wrong Happened. Please try later..');
        }
    }

    public function register_student(Request $request){

        $request->validate([
            'first_name' => 'required|alpha|min:3|max:10',
            'last_name' => 'required|alpha|min:3|max:10',
            'username' => 'required|alpha|min:3|max:10|unique:users,username',
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

            return back()->with('success', 'Account Create successfully. Please Log in..');
        }else{
            return back()->with('error', 'Something Wrong Happened. Please try later..');
        }
    }

    public function home(){
        return view('index', ['title'=> "School Resource"]);
    }

    public function user_select(){
        return view('login_select', ['title'=> "School Resource :: Select User"]);
    }
}
