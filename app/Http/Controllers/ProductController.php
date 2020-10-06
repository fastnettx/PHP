<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class ProductController extends Controller
{
    public function register(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'repeat_password' => 'required|same:password',
        ]);

        if ($validatedData->fails()) {
            $response = [
                'success' => false,
                'message' => 'Data has not been validated',
            ];

            return response()->json($response, 404);
        }
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success = $user->createToken('MyApi')->accessToken;

        $response = [
            'success' => true,
            'token' => $success,
        ];
        return response()->json($response, 200);
    }

    public function index()
    {
        $products = Product::all();
        return response()->json($products->toArray(), 200);;
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'user_id' => 'required',
        ]);
        if ($validator->fails()) {
            response()->json($validator->errors(), 404);
        }
        $product = Product::create($request->all());
        return response()->json($product->toArray(), 201);
    }

    public function show($id)
    {
        $product = Product::find($id);
        if (is_null($product)) {
            return response()->json(['error' => 'Product not found'], 404);
        }
        return response()->json($product->toArray(), 200);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
        ]);
        if ($validator->fails()) {
            response()->json($validator->errors(), 404);
        }
        $product = Product::find($id);
        if (is_null($product)) {
            return response()->json(['error' => 'Product not found'], 404);
        }
        $product->update($request->all());
        return response()->json($product->toArray(), 200);
    }

    public function destroy(Request $request, $id)
    {
        $product = Product::find($id);
        if (is_null($product)) {
            return response()->json(['error' => 'Product not found'], 404);
        }
        $product->delete($id);
        return response()->json(['product' => $product->name, 'text'=>'Product deleted '], 200);
    }
}
