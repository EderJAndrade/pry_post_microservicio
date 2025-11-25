<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index() {
        return response()->json(Post::orderBy('created_at','desc')->get(),200);
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'titulo'=>'required|string|max:255',
            'contenido'=>'required|string',
            'publicado'=>'sometimes|boolean',
        ]);
        $validated['slug'] = Str::slug($validated['titulo']).'-'.Str::random(6);
        $post = Post::create($validated);
        return response()->json(['message'=>'Post creado','post'=>$post],201);
    }

    public function show(Post $post) {
        return response()->json($post,200);
    }

    public function update(Request $request, Post $post) {
        $validated = $request->validate([
            'titulo'=>'sometimes|string|max:255',
            'contenido'=>'sometimes|string',
            'publicado'=>'sometimes|boolean',
        ]);
        if (isset($validated['titulo']) && $validated['titulo'] !== $post->titulo) {
            $validated['slug'] = Str::slug($validated['titulo']).'-'.Str::random(6);
        }
        $post->update($validated);
        return response()->json(['message'=>'Post actualizado','post'=>$post],200);
    }

    public function destroy(Post $post) {
        $post->delete();
        return response()->json(['message'=>'Post eliminado'],200);
    }
