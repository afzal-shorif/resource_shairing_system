<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Session;
use DB;


class Prime_model extends Model
{
    use HasFactory;

    /**
     * @param $user_type
     * @return object
     *      all file based on user_type
     */
    public static function get_file_list_for_student($class){
        try{
            return DB::table('resource')
                ->orderBy('resource_id', 'desc')
                ->where('visibility', '=' , 1)
                ->where('class_id','=', $class)
                ->paginate(6);
        }catch (QueryException $ex){
            //dd($ex->getMessage());
            return false;
        }
    }
    public static function get_file_list_for_teacher($class){
        try{
            return DB::table('resource')
                ->orderBy('resource_id', 'desc')
                ->where('class_id','=', $class)
                ->paginate(6);
        }catch (QueryException $ex){
            //dd($ex->getMessage());
            return false;
        }
    }

    /**
     * @param string $user_id
     * @return array
     * use foreach loop to convert array from object
     * toArray method not working
     */
    public static function get_purchase_list($user_id = ''){

        //return DB::table('temp')->where('user_id', '=', $user_id)->get()->toArray();

        // if inArray not working

        $purchase = array();
        $list = DB::table('temp')->where('user_id', '=', $user_id)->get();
        foreach ($list as $item) array_push($purchase, $item->resource_id);
        return $purchase;
    }


    /**
     * return an array (user_id, user_type)
     * @param string $email
     * @return array
     */

    public static function get_user_id_and_type($email = ''){
        $user = DB::table('users')->where('email', $email)->first();
        return array($user->id,$user->user_type,$user->first_name);
    }

    /**
     * @return array
     */
    public static function get_cart_item(){
        $sql = "select * from resource where resource_id in( ";

        $cart = Session::get('cart');
        if(count($cart)<=0) return [];

        foreach ($cart as $id){
            $sql .= $id.',';
        }
        $sql[strlen($sql)-1] = ')';

        return DB::select($sql);
    }

    public static function cart_confirm(){
        $values = "";
        $user_id = Session::get('user_id');

        foreach (Session::get('cart') as $data){
            $values .= '('.$user_id.','.$data.'),';
        }
        $values[strlen($values)-1] = ';';

        $sql = 'insert into temp(user_id, resource_id) VALUES '.$values;

        try{
            DB::insert($sql);


        }catch (QueryException $ex){
            dd($ex->getMessage());
        }

        $cart = array();
        Session::forget('cart');
        Session::put('cart',$cart);
    }

    public static function create_user($user_data){

        try{
            return DB::table('users')->insert([
                'user_type'=> $user_data['user_type'],
                'first_name'=> $user_data['first_name'],
                'last_name'=> $user_data['last_name'],
                'username'=> $user_data['username'],
                'email'=> $user_data['email'],
                'password'=> $user_data['password'],
                'phone' => $user_data['phone'],
                'status' => 0
            ]);


        }catch (QueryException $ex){
            //dd($ex->getMessage());
            return false;
        }

    }

    public static function get_class(){
        try{
            return DB::table('class')->get();
        }catch (QueryException $ex){
            //dd($ex->getMessage());
            return false;
        }
    }


}
