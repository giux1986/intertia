<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Interfaces\UserRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Inertia\Inertia; 

class UserController extends Controller
{
     private UserRepositoryInterface $userRepository;
     public function __construct(UserRepositoryInterface $userRepository) 
    {
        $this->userRepository = $userRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function page() {
        return Inertia::render('Test');
    }
    public function index()
    {
        return response()->json([
            'data' => $this->userRepository->getAllUsers()
        ]);
    }

     public function store(Request $request): JsonResponse 
    {
        $user = $request->only([
            'id',
            'name',
            'email'
        ]);

        return response()->json(
            [
                'data' => $this->userRepository->createUser($user)
            ],
            Response::HTTP_CREATED
        );
    }

    public function show(Request $request): JsonResponse 
    {
        $userId = $request->route('id');

        return response()->json([
            'data' => $this->userRepository->getUserById($userId)
        ]);
    }

    public function update(Request $request): JsonResponse 
    {
        $userId = $request->route('id');
        $user = $request->only([
            'client',
            'details'
        ]);

        return response()->json([
            'data' => $this->userRepository->updateOrder($userId, $user)
        ]);
    }

    public function destroy(Request $request): JsonResponse 
    {
        $userId = $request->route('id');
        $this->userRepository->deleteUser($userId);

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
