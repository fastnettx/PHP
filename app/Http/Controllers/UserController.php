<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use App\Post;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show()
    {
        $products = Product::all();
        $users = User::all();

        $prod = array();
        $user_prod = array();
        foreach ($products as $product) {
            if (array_key_exists($product->user_id, $prod)) {
                $prod[$product->user_id]++;
            }
            else  $prod[$product->user_id] =  1;
        }
        foreach ($users as $item){
            if (array_key_exists($item->id, $prod)){
                $user_prod[$item->email] = $prod[$item->id];
            }
            else $user_prod[$item->email] = 0;
        }
        return view('layouts.app', ['product' => $user_prod]);
    }
}
