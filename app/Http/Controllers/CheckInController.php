<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckInRequest;
use App\Http\Resources\CheckInResource;
use App\Models\CheckIn;
use App\Models\User;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

use function Illuminate\Log\log;

class CheckInController extends Controller
{
    public function create(CheckInRequest $request): CheckInResource
    {
        $data = $request->validated();
        $user = Auth::user();

        $checkin = new CheckIn($data);

        if (CheckIn::where('no_document', $checkin->no_document)->exists()) {
            throw new HttpResponseException(response([
                "errors" => [
                    "no_document" => ["No Document Allready Check In"]
                ]
            ], 400));
        }

        Log::info("checkin data ->" . $checkin);
        Log::info("no doc ->" . $checkin->no_document);

        $docType = explode('/', $checkin->no_document)[0];

        Log::info("doctype ->" . $docType);

        $image_identity_card_path = $request->file('image_identity_card')->store('images', 'public');
        $image_front_truck_path = $request->file('image_front_truck')->store('images', 'public');
        $checkin->image_identity_card = $image_identity_card_path;
        $checkin->image_front_truck = $image_front_truck_path;

        $checkin->document_type = $docType;
        $checkin->user_id = $user->id;

        $checkin->save();

        return new CheckInResource($checkin);
    }

    public function list(): JsonResponse
    {
        $user = Auth::user();
        $listCheckIn = CheckIn::where('user_id', $user->id)->get();

        return CheckInResource::collection($listCheckIn)->response()->setStatusCode(200);
    }
}
