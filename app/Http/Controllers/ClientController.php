<?php

namespace App\Http\Controllers;

use App\Http\Resources\ClientResource;
use App\Models\Client;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File as FileFacade;
use Intervention\Image\Facades\Image;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        $transactions = Client::all();
        return ClientResource::collection($transactions);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return ClientResource
     */
    public function store(): ClientResource
    {
        $data = $this->validateData();
        $client = Client::create($data);
        return new ClientResource($client);
    }

    /**
     * Display the specified resource.
     *
     * @param Client $client
     * @return ClientResource
     */
    public function show(Client $client): ClientResource
    {
        return new ClientResource($client);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Client $client
     * @return ClientResource
     */
    public function update(Client $client): ClientResource
    {
        $data = $this->validateData();
        $client->update($data);
        return new ClientResource($client);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Upload avatar
     *
     * @param Request $request
     * @param Client $client
     * @return JsonResponse
     */
    public function avatar(Request $request, Client $client): JsonResponse
    {
        $request->validate([
            'avatar' => [
                'required',
                'image',
                'dimensions:min_width=100,min_height=100',
                'mimes:jpeg,png,jpg,gif',
                'max:2048'],
        ]);

        $avatarName = time().'.'.$request->avatar->extension();
        $resizedAvatar = Image::make($request->avatar)->resize(360, 360);
        $resizedAvatar->save(public_path('uploads').'/'. $avatarName);

        // Delete current avatar, if exists, from uploads folder
        if (!is_null($client->avatar)) {
            FileFacade::delete(public_path('uploads').'/'.$client->avatar);
        }

        $client->update(['avatar' => $avatarName]);

        return response()->json('Avatar uploaded', Response::HTTP_CREATED);
    }

    private function validateData(): array
    {
        return request()->validate([
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'email' => ['required', 'email']
        ]);
    }
}
