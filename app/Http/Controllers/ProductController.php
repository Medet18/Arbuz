<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function show(): \Illuminate\Http\JsonResponse
    {
        $product = Product::all();
        return response()->json(['Products' => $product],200);
    }

    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        try{
            Product::create([
                'name_of_product' => $request->name_of_product,
                'price' => $request->price,
                'category' => $request->category,
                'weight' => $request->weight,
                'unit' => $request->unit,
            ]);
            return response()->json(['message' => 'Product successfully stored!'], 200);

        } catch(\Exception $e){
            //return response()->json(['Message' => "Something went wrong!"], 500);
            return response()->json(['Exception' => $e], 500);
        }
    }


    public function update(Request $request, $id): \Illuminate\Http\JsonResponse
    {
        try{
            $product = Product::find($id);

            if(!$product){
                return response()->json(['message' => 'not found'],404);
            }

            $product->name_of_product = $request->name_of_product;
            $product->price = $request->price;
            $product->category = $request->category;
            $product->weight = $request->weight;
            $product->unit = $request->unit;
            $product->available = $request->available;
            $product->save();

            return response()->json(['message' => 'Product successfully updated!'], 200);


        } catch(\Exception $e){
            //return response()->json(['Message' => "Something went wrong!"], 500);
            return response()->json(['Message' => $e],500);
        }
    }

    public function destroy($id): \Illuminate\Http\JsonResponse
    {
        $product = Product::find($id);
        if(!$product){
            return response()->json(['message' => 'not found'], 404);
        }
        $product->delete();

        return response()->json(['message' => 'Product successfully deleted!'], 200);

    }
}
