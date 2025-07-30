<?php

namespace App\Http\Controllers;
use App\Models\posts;

use Illuminate\Http\Request;

class PostsController extends Controller
{
     public function index()
{
    // Ambil hanya kolom tertentu
    $posts = posts::select('id', 'title', 'tumbnail', 'slug')->get();

    return response()->json($posts);
}
}
