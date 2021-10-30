<?php

namespace Gglink\CrudPermission\Services;

use Illuminate\Support\Facades\Http;

class LoginService extends BaseService
{
    protected $baseUrl, $apiKey, $userUniqueToken;

    public function __construct(){
        // get base_url and api_key from config file and token from session
        $this->baseUrl = config('crudPermission.base_url');
        $this->apiKey = config('crudPermission.api_key');
        $this->userUniqueToken = session()->get('token') ?? '';
    }

    public function userLogin($request){
        return Http::withHeaders([
            'X-API-KEY' => $this->apiKey,
        ])->post($this->baseUrl.'user/login', [
            'username' => $request->username,
            'password' => $request->password,
        ]);
    }

    public function userLogout($userId){
        return Http::withHeaders([
            'X-API-KEY' => $this->apiKey,
            'X-Token' => $this->userUniqueToken
        ])->post($this->baseUrl.'user/logout', [
            'id' => $userId,
        ]);
    }



}
