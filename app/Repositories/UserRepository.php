<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface
{
    public function create(array $data):?User
    {
        $userId = DB::table('users')->insertGetId([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'phone_number' => $data['phone_number'] ?? null,
            'created_at' => now(),
            'updated_at' => now(),
            'is_active'=> true
        ]);

    
        return User::find($userId);
    }

    public function findByEmail(string $email):?User
    {
        $user = DB::table('users')
            ->where('email', $email)
            ->where('is_active', true)
            ->first();

        if ($user) {
            return new User((array) $user);
        }

        return null;
    }
}