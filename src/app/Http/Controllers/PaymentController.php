<?php

namespace App\Http\Controllers;

use App\Http\Requests\Payment\PostRequest;
use App\Http\Requests\Payment\PutRequest;
use App\Models\Payment;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use function response;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        try {
            /** @var Payment[]|Collection $payments */
            $payments = Payment::all();
            return response()->json(["payments" => $payments]);
        } catch (Exception $exception) {
            return response()->json(["error" => $exception->getMessage()]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        //return view
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  PostRequest  $request
     * @return JsonResponse
     */
    public function store(PostRequest $request)
    {
        DB::beginTransaction();
        try {
            $payment = new Payment();
            $payment->user_id = $request->user_id;
            $payment->product_id = $request->product_id;
            $payment->total_price = $request->total_price;
            $payment->save();
            DB::commit();
            return response()->json(["message" => "success"]);
        } catch (Exception $exception) {
            DB::rollBack();
            return response()->json(["error" => $exception->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  Payment  $payment
     * @return JsonResponse
     */
    public function show(Payment $payment)
    {
        try {
            return response()->json(["payment" => $payment]);
        } catch (Exception $exception) {
            return response()->json(["error" => $exception->getMessage()]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Payment  $payment
     * @return void
     */
    public function edit(Payment $payment)
    {
        //return view
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  PutRequest  $request
     * @param  Payment  $payment
     * @return JsonResponse
     */
    public function update(PutRequest $request, Payment $payment)
    {
        DB::beginTransaction();
        try {
            $payment->user_id = $request->user_id;
            $payment->product_id = $request->product_id;
            $payment->total_price = $request->total_price;
            $payment->update();
            DB::commit();
            return response()->json(["message" => "success"]);
        } catch (Exception $exception) {
            DB::rollBack();
            return response()->json(["error" => $exception->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Payment  $payment
     * @return JsonResponse
     */
    public function destroy(Payment $payment)
    {
        DB::beginTransaction();
        try {
            $payment->delete();
            DB::commit();
            return response()->json(["message" => "success"]);
        } catch (Exception $exception) {
            DB::rollBack();
            return response()->json(["error" => $exception->getMessage()]);
        }
    }
}
