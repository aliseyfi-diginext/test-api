<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index()
    {
        $user = auth()->user();
        $response = Product::where('user_id', $user->id)->latest()->get();
        return response()->json($response, 200);
    }

    public function store(ProductRequest $request)
    {
        $user = auth()->user();
        $data = $request->validated();
        $data['user_id'] = $user->id;
        $data['picture'] = self::uploadPicture();
        $response = Product::create($data);
        return response()->json($response, 201);
    }

    public function show(Product $product)
    {
        $user = auth()->user();
        if ($user->id == $product->user_id) {
            $response = $product;
            return response()->json($response, 200);
        }else {
            abort(403);
        }
    }

    public function update(ProductRequest $request, Product $product)
    {
        $user = auth()->user();
        if ($user->id == $product->user_id) {
            $data = $request->validated();
            $data['picture'] = self::uploadPicture();
            $product->update($data);
            $response = $product;
            return response()->json($response, 200);
        }else {
            abort(403);
        }
    }

    public function changeStatus(Product $product, Request $request)
    {
        $user = auth()->user();
        if ($user->id == $product->user_id) {
            $product->done = $request->done;
            $product->save();
            return response()->json([], 200);
        }else {
            abort(403);
        }
    }

    public function destroy(Product $product)
    {
        $user = auth()->user();
        if ($user->id == $product->user_id) {
            $product->delete();
            return response()->json([], 204);
        }else {
            abort(403);
        }
    }

    public static function uploadPicture()
    {
        $picture = request('picture');
        if ($picture) {
            $ext = $picture->getClientOriginalExtension();
            $name = Str::random();
            return $picture->storeAs('public/documents', $name.$ext);
        }
    }
}
