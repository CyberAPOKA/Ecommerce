<?php

namespace App\Http\Controllers;

use App\Core\Constants\OrderStatus;
use App\Models\Order;
use App\Services\PicPayPaymentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;
use Carbon\Carbon;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Support\Facades\Log;

class PicPayController extends Controller
{

    public function payment(Request $request)
    {
        error_log('cheguei em payment');
        $user = Auth::user();
        $x_picpay_token =  env('X_PICPAY_TOKEN');
        $expiresAt = Carbon::now()->addHours(24);
        $fullName = $user->name;
        $nameParts = explode(' ', $fullName);
        $firstName = $nameParts[0];
        $lastName = end($nameParts);
        $data = [
            'referenceId' => sha1(rand(10000, 99999)),
            'callbackUrl' => route('notification'),
            'expiresAt' => $expiresAt,
            'returnUrl' => route('home'),
            'value' => $request->input('price'),
            'additionalInfo' => [null],
            'buyer' => [
                'firstName' => $firstName,
                'lastName' => $lastName,
                'document' => '010.091.001-91',
            ],
        ];
        $referenceId = $data['referenceId'];
        Order::create([
            'user_id' => $user->id,
            'product_id' => $request->input('id'),
            'reference_id' => $referenceId,
            'status' => 'created'
        ]);
        $ch = curl_init('https://appws.picpay.com/ecommerce/public/payments');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('x-picpay-token: ' . $x_picpay_token));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($ch, CURLOPT_CAINFO, "cacert.pem");
        $res = curl_exec($ch);
        curl_close($ch);
        $return = json_decode($res);
        return response()->json([
            'paymentUrl' => $return->paymentUrl,
        ]);
    }

    public function notification(Request $request)
    {
        error_log('cheguei em notification');
        $x_seller_token = env('X_SELLER_TOKEN');
        $referenceId = $request->input('referenceId');

        if ($request->header('x-seller-token') !== $x_seller_token) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $ch = curl_init("https://appws.picpay.com/ecommerce/public/payments/$referenceId/status");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('x-picpay-token: ' . env('X_PICPAY_TOKEN')));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($ch, CURLOPT_CAINFO, "cacert.pem");
        $res = curl_exec($ch);
        curl_close($ch);
        $return = json_decode($res);

        $order = Order::where('reference_id', $referenceId)->first();
        $order->status = $return->status;
        $order->save();

        return response()->json(['message' => 'OK'], 200);
    }
}
