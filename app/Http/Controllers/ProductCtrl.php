<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Comment;
use Session;
class ProductCtrl extends Controller{
    //
    public function my_products(Request $request){
        $data = [];
        
        $user_id = $this->user_id();

        $products = Product::where('user_id',$user_id)->get();

        $prod = [];

        foreach($products as $product){
            $product_id = $product['id'];
            $comment_count = Comment::where('product_id',$product_id)->count();
            $product['comments'] = $comment_count;
            $prod[] = $product;
        }

        $data['products'] = $prod;

        return view('pages.product.my-products')->with($data);
    }
    public function add_product(Request $request){
        $data = [];
        
        return view('pages.product.add-product')->with($data);
    }

    public function do_add_product(Request $request){

    	$rules = [
            'title' => 'required|min:2|max:255',
            'description' => 'required|min:2',
            'price' => 'required|numeric',
            'images' => 'required'
        ];

        $customMessages = [
            'title.required' => 'Title is empty',
            'title.min' => 'Title is too short',
            'title.max' => 'Title is too long',
            'description.required' => 'Description is empty',
            'description.min' => 'Description is too short',
            'price.required' => 'Price is empty',
            'price.numeric' => 'Price is not valid',
            'images.required' => 'Images are empty',
            
        ];
        $validator = $this->validate($request, $rules, $customMessages);

        if (!is_array($validator) && $validator->fails()) {
            Session::flash('error', $validator->messages()->first());
            return redirect()->back()->withInput();
        }else{
            $formData = $request->all();
            $images=array();
            if($files=$request->file('images')){
                foreach($files as $file){
                    $name=$file->getClientOriginalName();
                    $file->move('uploads',$name);
                    $images[]=$name;
                }
            }
            $images = json_encode($images);
            $user_id = $this->user_id();
        	$insert = [
        		'user_id'           =>  $user_id,
			    'title'             =>  $formData['title'],
			    'description'       =>  $formData['description'],
                'images'            =>  $images,
                'url'               =>  $this->slugify($formData['title']),
                'price'             =>  $formData['price']
            ];
            
            //print_r($insert);

            $add = Product::create($insert);

            if($add){
                Session::flash('success', 'Product added successfully');
            }else{
                Session::flash('error', 'Product not added. Please try again !');
            }
			return redirect()->back();
        }
    }

    public static function slugify($text){
        // replace non letter or digits by -
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);

        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        // trim
        $text = trim($text, '-');

        // remove duplicate -
        $text = preg_replace('~-+~', '-', $text);

        // lowercase
        $text = strtolower($text);

        if (empty($text)) {
            return 'n-a';
        }

        return $text;
    }

    public function delete_product(Request $request,$id){
        $id = $request->route('id');
        Product::where('id',$id)->delete();
        return redirect()->back();
    }

}
