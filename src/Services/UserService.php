<?php

namespace Gglink\CrudPermission\Services;

use Illuminate\Support\Facades\Http;

class UserService extends BaseService
{
    protected $baseUrl, $apiKey, $userUniqueToken;
    public function __construct(){
        // get base_url and api_key from config file
        $this->baseUrl = config('crudPermission.base_url');
        $this->apiKey = config('crudPermission.api_key');
        $this->userUniqueToken = session()->get('token') ?? '';
    }

    public function getData(){
        // As i can not login to server and dot get user list so i used "https://jsonplaceholder" for dummy data
        $response = Http::get('https://jsonplaceholder.typicode.com/users')->body();
        return json_decode($response);

        // real code if i can access data from server
       /* return Http::withHeaders([
            'X-API-KEY' => $this->apiKey,
            'X-Token' => $this->userUniqueToken
        ])->get($this->baseUrl.'user/all');*/
    }

    public function saveUser($request){
        return Http::withHeaders([
            'X-API-KEY' => $this->apiKey,
            'X-Token' => $this->userUniqueToken
        ])->post($this->baseUrl.'user/add', [
            'username' => $request->username,
            'email' => $request->email,
            'password' => $request->password,
            'group' => $request->group,
            'avatar' => $request->avatar ?? '',
        ]);

    }

    public function getUserById($id){
        return Http::withHeaders([
            'X-API-KEY' => $this->apiKey,
            'X-Token' => $this->userUniqueToken
        ])->get('https://jsonplaceholder.typicode.com/users/'.$id);

        //real code to access server
       /* return Http::withHeaders([
            'X-API-KEY' => $this->apiKey,
            'X-Token' => $this->userUniqueToken
        ])->get($this->baseUrl.'user/detail', [
            'id' => $id,
        ]);*/

    }

    public function updateUser($request, $id){
        return Http::withHeaders([
            'X-API-KEY' => $this->apiKey,
            'X-Token' => $this->userUniqueToken
        ])->post($this->baseUrl.'user/add', [
            'id' => $id,
            'username' => $request->username,
            'email' => $request->email,
            'password' => $request->password,
            'group' => $request->group,
            'avatar' => $request->avatar ?? '',
        ]);
    }

    public function deleteUser($userId){
        return Http::withHeaders([
            'X-API-KEY' => $this->apiKey,
            'X-Token' => $this->userUniqueToken
        ])->post($this->baseUrl.'user/delete'.$userId, [
            'id' => $userId,
        ]);
    }


}
