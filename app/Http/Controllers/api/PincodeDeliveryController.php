<?php

namespace App\Http\Controllers\api;


use Exception;
use Carbon\Carbon;
use App\Models\Store;
use App\Helpers\Helper;
use App\Models\Pincode;
use Illuminate\Http\Request;
use App\Models\StoreHasPincode;
use App\Http\Controllers\Controller;

class PincodeDeliveryController extends Controller
{
    public function get_pincode_delivery(Request $req)
    {
        $store = Store::where('email', $req->store_email)->first();
        $pincode = Pincode::where('pincode', $req->pincode)->first();
        if (!isset($store)) {
            $res = [
                'data' => NULL,
                'message' => 'Delivery Not found',
                'status' => 'store_not_found',
                'error' => NULL
            ];
            return response()->json($res);
        }

        if (!isset($pincode)) {
            $res = [
                'data' => NULL,
                'message' => 'Delivery Not found',
                'status' => 'store_not_found',
                'error' => NULL
            ];
            return response()->json($res);
        }

        if (now()->greaterThan(Carbon::parse($pincode->pickup_time))) {
            $min_days = $pincode->min_days + 1;
            $max_days = $pincode->max_days + 1;
        } else {
            $min_days = $pincode->min_days;
            $max_days = $pincode->max_days;
        }

        $res = [
            'data' => ['min_days' => $min_days, 'max_days' => $max_days],
            'message' => 'Delivery found',
            'status' => 'success',
            'error' => NULL
        ];

        return response()->json($res);
    }
}
