<?php
/**
 * Service for Token requests
 */

namespace App\Services\Token;


use App\Models\User;
use App\Traits\ApiResponser;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserTokenService
{
    use ApiResponser;

    /**
     * Creating a new user and return the token for further requests
     * If the user is not created, response a json error
     * @param array $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function createUserAndGetToken(array $data): JsonResponse
    {
        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);
        if ($user){
            return $this->prepareOutputToken($user);
        }
        return $this->error('Did`t create user', 500);
    }

    /**
     * Validate request data if ok -> response Token key
     * else Credentials not match
     * @param array $data
     * @return JsonResponse
     */
    public function getToken(array $data): JsonResponse
    {
        if (!Auth::validate($data)){
            return $this->error('Credentials not match', 401);
        }
        $user = User::where('email', $data['email'])->firstOrFail();
        return $this->prepareOutputToken($user);
    }

    /**
     * We have User Model then generate Token
     * @param User $user
     * @return JsonResponse
     */
    private function prepareOutputToken(User $user): JsonResponse
    {
        $rawToken = $user->createToken('Api token')->plainTextToken;
        $token = $this->getExplodedToken($rawToken);
        return $this->success($token);
    }


    /**
     * Splits a string at a separator, discarding the part that
     * not needed when verifying Bearer Authentication
     * If the separator is not found, returns the input string
     * @param string $rawToken
     * @return string
     */
    private function getExplodedToken(string $rawToken): string
    {
        $result = explode('|', $rawToken);
        return $result[1]?? $rawToken;

    }

}
