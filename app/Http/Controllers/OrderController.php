<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class OrderController extends Controller
{

    public function show(): \Illuminate\Http\JsonResponse
    {
        $order = Order::all();
        return response()->json(['Products' => $order],200);
    }

    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
            $validator = Validator::make($request->all(), [
                'delivery_day' => 'required|date|after_or_equal:today|before_or_equal:' . now()->addWeek()->format('Y-m-d'),
                'address' => 'required|string|min:3',
                'phone' => 'required|string|min:10',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }
            $order = Order::create(
                $validator->validated()
            );


        return response()->json(['message' => 'Order successfully created. Please wait delivery!', 'order' => $order], 200);

    }

    public function update(Request $request, $id): \Illuminate\Http\JsonResponse
    {
            $validator = Validator::make($request->all(), [
                'delivery_day' => 'required|date|after_or_equal:today|before_or_equal:' . now()->addWeek()->format('Y-m-d'),
                'address' => 'required|string|min:3',
                'phone' => 'required|string|min:10',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }

            $order = Order::find($id);

            if(!$order){
                return response()->json(['message' => 'not found'],404);
            }

            $order->delivery_day = $request->delivery_day;
            $order->address = $request->address;
            $order->phone = $request->phone;
            $order->save();

            return response()->json(['message' => 'Order successfully updated!'], 200);

    }

    public function destroy($id): \Illuminate\Http\JsonResponse
    {
        $order = Order::find($id);
        if(!$order){
            return response()->json(['message' => 'not found'], 404);
        }
        $order->delete();

        return response()->json(['message' => 'Order successfully deleted!'], 200);

    }

}
