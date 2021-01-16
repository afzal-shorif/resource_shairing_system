<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Session;
use DB;
use Carbon\Carbon;
class Resource_model extends Model
{
    use HasFactory;


    public static function get_user_resource($class_id){
        try{
            return DB::table('resource')
                ->orderBy('resource_id', 'desc')
                ->leftJoin('download', 'resource.resource_id', '=', 'download.resource_id')
                ->select('resource.resource_id','title', 'visibility', 'price', 'download.download_count')
                ->where('class_id', '=', $class_id)
                ->where('user_id', "=", Session::get('user_id'))
                ->paginate(8);
        }catch (QueryException $ex){
            //dd($ex->getMessage());
            //die("An error occur.");
        }
    }


    public static function upload($file_data){
        try{
            return DB::table('resource')
                ->insert([
                    'user_id' => $file_data['user_id'],
                    'title' => $file_data['title'],
                    'description' => $file_data['description'],
                    'source' => $file_data['source'],
                    'thumbnail' => $file_data['thumbnail'],
                    'class_id' => $file_data['class_id'],
                    'visibility' => $file_data['visibility'],
                    'price' => $file_data['price'],
                    'type' => $file_data['type'],
                    'updated_at' => Carbon::now(),
                    'created_at' => Carbon::now()
                ]);
        }catch (QueryException $ex){
            dd($ex->getMessage());
            return false;
        }

    }

    public static function get_balance(){

        $total = 0;
        try{
            $user_paid_resources = DB::table('resource')
                ->join('download', 'resource.resource_id', 'download.resource_id')
                ->select('download.download_count', 'resource.price')
                ->where('type', 2)
                ->where('user_id', Session::get('user_id'))
                ->get();
            foreach($user_paid_resources as $row) $total += $row->price * $row->download_count;
        }catch (QueryException $ex){
            //return dd($ex->get_message());
            $total = 0;
        }

        return $total;

    }

    public static function check_download($resource_id){
        return DB::table('temp')->where('resource_id', $resource_id)->where('user_id', Session::get('user_id'))->where('flag', 1)->count();
    }

    public static function get_all_resource($id){
        try{
            return DB::table('resource')
                ->orderBy('resource_id', 'desc')
                ->leftJoin('download', 'resource.resource_id', '=', 'download.resource_id')
                ->select('resource.resource_id','title', 'visibility', 'price', 'download.download_count', 'source', 'resource.class_id','resource.created_at')
                ->where('user_id', "=", $id)
                ->get();
        }catch (QueryException $ex){
            //dd($ex->getMessage());
            //die("An error occur.");
        }

    }
}
