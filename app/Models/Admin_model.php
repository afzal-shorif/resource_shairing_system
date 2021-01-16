<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use DB;
class Admin_model extends Model
{
    use HasFactory;

    public static function user_list($type, $status){
        try{
            return DB::table('users')
                ->select('users.id', 'users.first_name','users.last_name', 'users.email', 'users.phone', 'users.created_at',
                    DB::raw('(SELECT COUNT(resource.resource_id) FROM resource WHERE resource.user_id = users.id) as total_resource'))
                ->where('user_type', $type)
                ->where('status', $status)
                ->get();
        }catch (QueryException $ex){
            dd($ex->getMessage());
            return false;
        }
    }

    public static function user_details($id){

        try{

            return DB::table('users')
                ->select('users.id', 'users.picture','users.username' ,'users.first_name','users.last_name', 'users.email', 'users.phone', 'users.created_at', 'users.user_type',
                    DB::raw('(SELECT COUNT(resource.resource_id) FROM resource WHERE resource.user_id = users.id) as total_resource'))
                ->where('id', $id)
                ->get();

        }catch (QueryException $ex){
            //dd($ex->getMessage());
            return false;
        }
    }


    public static function msg_count(){
        return DB::table('message')->where('status', 1)->count();
    }
    public static function msg(){
        return DB::table('message')->where('status', 1)->paginate(5);
    }
    public static function notification_count(){
        return DB::table('notification')->where('status', 1)->count();
    }
    public static function notification(){
        return DB::table('notification')->where('status', 1)->paginate(5);
    }
}
