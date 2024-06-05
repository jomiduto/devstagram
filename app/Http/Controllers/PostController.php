<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;

class PostController extends Controller implements HasMiddleware
{
    // Uso de middleware para proteger el endpoint de muro
    public static function middleware(): array
    {
        return[
            'auth',
        ];
    }

    public function index(User $user)
    {   
        return view('dashboard', [
            'user' => $user
        ]);
    }

    public function create()
    {
        return view('posts.create');
    }
}
