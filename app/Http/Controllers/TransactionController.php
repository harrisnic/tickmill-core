<?php

namespace App\Http\Controllers;

use App\Http\Resources\TransactionResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Transaction;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Symfony\Component\HttpFoundation\Response;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        $transactions = Transaction::paginate(10);
        return TransactionResource::collection($transactions);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return TransactionResource
     */
    public function store(): TransactionResource
    {
        $data = $this->validateData();
        $transaction = Transaction::create($data);
        return new TransactionResource($transaction);
    }

    /**
     * Display the specified resource.
     *
     * @param Transaction $transaction
     * @return TransactionResource
     */
    public function show(Transaction $transaction): TransactionResource
    {
        return new TransactionResource($transaction);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Transaction $transaction
     * @return TransactionResource
     */
    public function update(Transaction $transaction): TransactionResource
    {
        $data = $this->validateData();
        $transaction->update($data);
        return new TransactionResource($transaction);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Transaction $transaction
     * @return JsonResponse
     */
    public function destroy(Transaction $transaction): JsonResponse
    {
        $transaction->delete();
        return response()->json('Transaction deleted', Response::HTTP_OK);
    }

    private function validateData(): array
    {
        return request()->validate([
            'amount' => ['required', 'numeric'],
            'client_id' => ['required', 'exists:App\Models\Client,id']
        ]);
    }
}
