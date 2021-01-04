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
                ->select('resource_id','title', 'visibility', 'price')
                ->orderBy('resource_id', 'desc')
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
                    'updated_at' => Carbon::now()
                ]);
        }catch (QueryException $ex){
            dd($ex->getMessage());
            return false;
        }

    }

}
