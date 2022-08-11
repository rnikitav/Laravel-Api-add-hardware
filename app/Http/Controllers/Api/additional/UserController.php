<?php

namespace App\Http\Controllers\Api\additional;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserCreate;
use App\Http\Requests\UserGetToken;
use App\Services\Token\UserTokenService;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    private $userTokenService;

    /**
     * @param UserTokenService $userTokenService
     */
    public function __construct(UserTokenService $userTokenService)
    {
        $this->middleware('throttle:6,1');
        $this->userTokenService = $userTokenService;
    }


    /**
     * Adds a new user to the DB and returns
     * token for future sending requests
     * @param UserCreate $request
     * @return JsonResponse
     */
    public function create(UserCreate $request): JsonResponse
    {
        return $this->userTokenService->createUserAndGetToken($request->validated());

    }

    /**
     * Request for getting Token Key
     * @param UserGetToken $request
     * @return JsonResponse
     */
    public function getToken(UserGetToken $request): JsonResponse
    {
        return $this->userTokenService->getToken($request->validated());
    }
}
