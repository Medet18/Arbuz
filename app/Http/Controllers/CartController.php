<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function totalPrice()
    {
        $products = DB::table('products')
                    ->select( 'price','quantity')
                    ->join('carts', 'products.id', '=', 'carts.product_id')
                    ->get();

        $total = 0;
        foreach ($products as $pro) {
            $total += $pro->price * $pro->quantity;
        }
        return response()->json(["Total sum is : " => $total." kz"],200);
    }

    public function show(): \Illuminate\Http\JsonResponse
    {
        $cart = DB::table('products')
                    ->select('carts.id','name_of_product', 'price','weight','quantity')
                    ->rightJoin('carts', 'products.id', '=', 'carts.product_id')
                    ->get();

        return response()->json(['Cart' => $cart],200);
    }

    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $id = Product::where('id', $request->product_id)->first();

        try {
            if ($id->available === 1){
                Cart::create([
                    'product_id' => $id->id,
                ]);
                return response()->json(['message' => 'Product added to cart successfully!'], 200);
            }
            else{
                return response()->json(['message' => 'This product not available!'], 200);
            }

        } catch(\Exception $e){
            //return response()->json(['Message' => "Something went wrong!"], 500);
            return response()->json(['Exception' => $e], 500);
        }
    }
    public function update(Request $request, $id): \Illuminate\Http\JsonResponse
    {
        try {
            $product = Cart::find($id);

            if (!$product) {
                return response()->json(['message' => 'not found'], 404);
            }
            elseif ($request->quantity === 0) {
                return response()->json(['message' => 'The quantity of product cannot be 0!'], 200);
            }
            else {
                $product->quantity = $request->quantity;
                $product->save();
                return response()->json(['message' => 'Cart successfully updated!'], 200);
            }
        } catch (\Exception $e) {
            //return response()->json(['Message' => "Something went wrong!"], 500);
            return response()->json(['Message' => $e], 500);
        }
    }

    public function destroy($id): \Illuminate\Http\JsonResponse
    {
        $product = Cart::find($id);
        if(!$product){
            return response()->json(['message' => 'not found'], 404);
        }
        $product->delete();
        return response()->json(['message' => 'Product successfully deleted from cart!'], 200);
    }
}
