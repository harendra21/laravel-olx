<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Comment;
use Session;
use DB;
class HomeCtrl extends Controller
{
    //
    public function index(Request $request){
        $data = [];
        $data['products'] = Product::get();
        return view('pages.home')->with($data);
    }

    public function view_product(Request $request,$url){
        $data = [];
        $url = $request->route('url');
        $data['product'] = Product::where('url',$url)->with('user')->first();
        return view('pages.product.product')->with($data);
    }

    public function get_comments(Request $request){
        
        $formdata = $request->all();
        $id = $formdata['id'];

        $comments = DB::select("SELECT `comments`.*,`users`.`f_name`,`users`.`l_name` FROM `comments` 
        LEFT JOIN `users` ON ( `comments`.`user_id` = `users`.`id` ) WHERE `comments`.`product_id` = '$id';");
        echo json_encode($comments);

    }

    public function add_comment(Request $request){
        $formdata = $request->all();
        
        $product_id = $formdata['product_id'];
        $user_id = $formdata['user_id'];
        $comment = $formdata['comment'];

        $added = Comment::create([
            'product_id' => $product_id,
            'user_id' => $user_id,
            'text' => $comment
        ]);
        if($added){ echo '1';}
        else{ echo '0'; }

    }
}
