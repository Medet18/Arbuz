<?php

namespace App\Http\Controllers;

use App\Models\appsubs;
use App\Models\Subscription;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function show(): \Illuminate\Http\JsonResponse
    {
        $subs = appsubs::all();
        return response()->json(['Subscriptions'=>$subs],200);
    }


    public function getSubscription(Request $request): \Illuminate\Http\JsonResponse
    {
        $app = appsubs::where('id', $request->id)->first();
        try{
            Subscription::create([
                'name_subs' => $app->name,
                'start_date' => Carbon::now(),
                'end_date' => Carbon::now()->addWeek(),
                'status' => $request->status,
            ]);
            return response()->json(['message' => 'Subscription successfully completed!'], 200);

        } catch(\Exception $e){
            return response()->json(['Exception' => $e], 500);
        }
    }
    public function update(Request $request, $id): \Illuminate\Http\JsonResponse
    {
        try {
            $subs = Subscription::find($id);

            if(!$subs) {
                return response()->json(['message' => 'not found'], 404);
            }
            $subs->status = $request->status;
            $subs->save();
            return response()->json(['message' => 'Subscription successfully canceled!'], 200);

        } catch (\Exception $e) {
            //return response()->json(['Message' => "Something went wrong!"], 500);
            return response()->json(['Message' => $e], 500);
        }
    }

    public function cancel($id): \Illuminate\Http\JsonResponse
    {
        $subs = Subscription::find($id);
        if(!$subs){
            return response()->json(['message' => 'not found'], 404);
        }
        $subs->delete();
        return response()->json(['message' => 'Subscription successfully canceled !'], 200);
    }
}
