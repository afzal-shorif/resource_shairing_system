<?php

namespace App\Http\Controllers;

use App\Models\Admin_model;
use App\Models\Resource_model;
use Illuminate\Http\Request;
use DB;
use Storage;
class Admin extends Controller
{
    //
    public function index(){
        $data['title'] = 'Dashboard :: '.config('global.title');
        $data['msg_count'] = Admin_model::msg_count();
        $data['msg'] = Admin_model::msg();

        $data['notification_count'] = Admin_model::notification_count();
        $data['notification'] = Admin_model::notification();

        $data['earn_monthly'] = 10000;
        $data['earn_annual'] = 1000000;
        $data['total_user'] = DB::table('users')->count();
        $data['total_pending_user'] = DB::table('users')->where('status', 0)->count();
        return view('admin.dashboard',$data);
    }

    public function registered_student(){
        $data['title'] = 'Registered Student :: '.config('global.title');
        $data['page_name'] = "All Active Student";
        $data['table_type'] = "Students Table";
        $data['action_url'] = "/suspend_user/2/";
        $data['action_text'] = "Suspend";

        $data['msg_count'] = Admin_model::msg_count();
        $data['msg'] = Admin_model::msg();

        $data['notification_count'] = Admin_model::notification_count();
        $data['notification'] = Admin_model::notification();

        $data['user'] = Admin_model::user_list(2,1);

        return view('admin.user_table',$data);
    }
    public function registered_teacher(){
        $data['title'] = 'Registered Teacher :: '.config('global.title');
        $data['page_name'] = "All Active Teacher";
        $data['table_type'] = "Teachers Table";

        $data['action_url'] = "/suspend_user/1/";
        $data['action_text'] = "Suspend";

        $data['msg_count'] = Admin_model::msg_count();
        $data['msg'] = Admin_model::msg();

        $data['notification_count'] = Admin_model::notification_count();
        $data['notification'] = Admin_model::notification();

        $data['user'] = Admin_model::user_list(1,1);

        return view('admin.user_table',$data);

    }
    public function pending_student(){
        $data['title'] = 'Pending Student :: '.config('global.title');
        $data['page_name'] = "All Pending Student";
        $data['table_type'] = "Pending Students Table";

        $data['action_url'] = "/active_user/2/";
        $data['action_text'] = "Active";

        $data['msg_count'] = Admin_model::msg_count();
        $data['msg'] = Admin_model::msg();

        $data['notification_count'] = Admin_model::notification_count();
        $data['notification'] = Admin_model::notification();

        $data['user'] = Admin_model::user_list(2,0);

        return view('admin.user_table',$data);

    }
    public function pending_teacher(){
        $data['title'] = 'Pending Teacher :: '.config('global.title');
        $data['page_name'] = "All Pending Teacher";
        $data['table_type'] = "Pending Teachers Table";

        $data['action_url'] = "/active_user/1/";
        $data['action_text'] = "Active";

        $data['msg_count'] = Admin_model::msg_count();
        $data['msg'] = Admin_model::msg();

        $data['notification_count'] = Admin_model::notification_count();
        $data['notification'] = Admin_model::notification();

        $data['user'] = Admin_model::user_list(1,0);

        return view('admin.user_table',$data);
    }


    public function active_user($type, $id){

        DB::table('users')->where('id', $id)->update(['status' => 1]);

        if($type == 2) return redirect(url('/pending_student'));
        return redirect(url('/pending_teacher'));
    }

    public function suspend_user($type, $id){

        DB::table('users')->where('id', $id)->update(['status' => 0]);

        if($type == 2) return redirect(url('/registered_student'));
        return redirect(url('/registered_teacher'));

    }

    public function user_details(){
        $id = $_GET['id'];
        $data['title'] = 'User :: '.config('global.title');
        $data['msg_count'] = Admin_model::msg_count();
        $data['msg'] = Admin_model::msg();

        $data['notification_count'] = Admin_model::notification_count();
        $data['notification'] = Admin_model::notification();
        $data['resource'] = Resource_model::get_all_resource($id);
        $data['user'] = Admin_model::user_details($id);

        return view('admin.user', $data);
    }


    public function setNotificationStatus(Request $request){

        $update = DB::table('notification')->where('status', 0)->update(['status'=> 1]);
        if($update)
            return response()->json(array('msg'=> 'Success'), 200);
        else return response()->json(array('msg'=> 'error'), 404);
    }

    public function setMessageStatus(Request $request){

        $update = DB::table('message')->where('status', 0)->update(['status'=> 1]);
        if($update)
            return response()->json(array('msg'=> 'Success'), 200);
        else return response()->json(array('msg'=> 'error'), 404);
    }

}
