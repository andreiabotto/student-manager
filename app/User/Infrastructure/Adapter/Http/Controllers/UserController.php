<?php

namespace App\User\Infrastructure\Adapter\Http\Controllers;

use App\Http\Controllers\Controller;
use App\User\Application\Services\Interfaces\UserServiceInterface;
use App\User\Infrastructure\Adapter\Http\Requests\StoreUserRequest;
use App\User\Infrastructure\Adapter\Http\Requests\UpdateUserRequest;
use App\User\Infrastructure\Adapter\Http\Responses\UserResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

/**
 * @OA\Info(
 *     title="User manager",
 *     version="1.0.0",
 *     description="Documentation for user manager",
 *     @OA\Contact()
 * )
 */
class UserController extends Controller
{
    protected $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @OA\Get(
     *     path="/api/users",
     *     tags={"Users"},
     *     summary="Get list of users",
     *     description="Returns a list of users",
     *     @OA\Response(
     *         response=200,
     *         description="Successful response"
     *     )
     * )
     */
    public function index(Request $request)
    {
        $params = $request->all();
        if($params) {
            $params = $params['values'];

            if (is_null($params[1])) {
                $params = [];
            }
        }

        $users = $this->userService->getAllUsers($params);
        return UserResponse::collection($users);
    }

    /**
     * @OA\Get(
     *     path="/api/users/{id}",
     *     tags={"Users"},
     *     summary="Get user by ID",
     *     description="Returns a user by ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="User ID",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful response"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="User not found"
     *     )
     * )
     */
    public function show($id)
    {
        $user = $this->userService->getUserById($id);

        if ($user) {
            return new UserResponse($user);
        }

        return response()->json(['message' => 'User not found'], 404);
    }

    /**
     * @OA\Post(
     *     path="/api/users",
     *     tags={"Users"},
     *     summary="Create a new user",
     *     description="Creates a new user",
     *     @OA\RequestBody(
     *         description="User object that needs to be added",
     *         required=true
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Successful response"
     *     )
     * )
     */
    public function store(StoreUserRequest $request)
    {
        $user = $this->userService->createUser($request->validated());
        return new UserResponse($user);
    }

    /**
     * @OA\Put(
     *     path="/api/users/{id}",
     *     tags={"Users"},
     *     summary="Update an existing user",
     *     description="Updates an existing user",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="User ID",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         description="User object that needs to be updated",
     *         required=true
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful response"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="User not found"
     *     )
     * )
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $updated = $this->userService->updateUser($id, $request->validated());

        if ($updated) {
            $user = $this->userService->getUserById($id);
            return new UserResponse($user);
        }

        return response()->json(['message' => 'User not found'], 404);
    }

    /**
     * @OA\Delete(
     *     path="/api/users/{id}",
     *     tags={"Users"},
     *     summary="Delete a user",
     *     description="Deletes a user",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="User ID",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful response"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="User not found"
     *     )
     * )
     */
    public function destroy($id)
    {
        $deleted = $this->userService->deleteUser($id);

        if ($deleted) {
            return response()->json(['message' => 'User deleted successfully']);
        }

        return response()->json(['message' => 'User not found'], 404);
    }
}
