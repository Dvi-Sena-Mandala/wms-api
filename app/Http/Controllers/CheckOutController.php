<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckOutRequest;
use App\Http\Resources\CheckOutResource;
use App\Models\CheckIn;
use App\Models\CheckOut;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CheckOutController extends Controller
{
    public function create(CheckOutRequest $request): CheckOutResource
    {
        $data = $request->validated();


        $user = Auth::user();

        $checkout = new CheckOut($data);
        Log::info('request data: ' . $checkout);

        $checkin = CheckIn::where('user_id', $user->id)->where('id', $checkout->checkin_id)->first();

        // if checkin id not exist, throw error
        if (!$checkin->exists()) {
            throw new HttpResponseException(response([
                "errors" => [
                    "message" => ["There is no document checkin with id: " . $checkin->id]
                ]
            ], 400));
        }

        // if checkin id allready exist in checkout db, throw error (handle duplication)
        if (CheckOut::where('checkin_id', $checkout->checkin_id)->exists()) {
            throw new HttpResponseException(response([
                "errors" => [
                    "message" => ["Check Out data allready exist"]
                ]
            ], 400));
        }

        // handle upload image and save the path to db
        $image_front_truck_path = $request->file('image_front_truck')->store('images', 'public');
        $image_rear_truck_path = $request->file('image_rear_truck')->store('images', 'public');
        $checkout->image_front_truck = $image_front_truck_path;
        $checkout->image_rear_truck = $image_rear_truck_path;

        // change checkin data checkpoint to checkout
        $checkin->checkpoint = 'CHECKOUT';

        // save the changes to db
        $checkin->save();
        $checkout->save();

        return new CheckOutResource($checkout);
    }
}
