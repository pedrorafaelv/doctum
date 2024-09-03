<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Validator;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::all();
        if (!$posts->isEmpty()){
            return response()->json(['message'=>'posts', 'data'=>$posts], 200);
        }
        return response()->json(['error'=>'no hay posts'], 201);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validar el request
        $rules=[
            'title' => 'required|min:3|unique:posts,title',
            'content' => 'required|min:10',
        ];
        $messages=[
            'title.required' => 'El titulo es obligatorio.',
            'title.min'=>'el titulo debe ser minimo :min caracateres',
            'title.unique'=>'el titulo ya esta en uso',
            'content.required' => 'El contenido es obligatorio.',
            'content.min'=>'el content minimo son :min caracteres',

        ];
        //  dd($request->all());
        // dd($request->route()->parameters);
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()){
             return response()->json(['Error'=> 'Error al Crear Post', 'errors '=>$validator->errors()], 400);
        }
        try {
        $nuevoPost = new Post();
        $nuevoPost->fill($request->all());
        // Guardamos la nueva empresa en la base de datos
        $resp = $nuevoPost->save();
        // Devolvemos una respuesta con el código HTTP 201 y el mensaje de que se ha creado correctamente
            return response()->json(['message'=> 'Post creado existosamente', 'data'=>$nuevoPost], 200);
         } catch (\Exception $e) {
            return response()->json(['Error'=> 'Error al Crear Post', 'errors'=>$validator->errors(), 'data'=> $nuevoPost], 400);
            // En caso de que no se pueda crear el registro, devolvemos un código HTTP 400 en lugar de 500
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::find($id);
        if (is_object($post)){
            return response()->json(['message'=>'post', 'data'=>$post], 200);
        }
        return response()->json(['error'=>'el post no existe'], 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         //validar el request
         $rules=[
            'title'   => 'required|min:3|unique:posts,title',
            'content' => 'required|min:10',
        ];
        $messages=[
            'title.required' => 'El titulo es obligatorio.',
            'title.min'=>'el titulo debe ser minimo :min caracateres',
            'title.unique'=>'el titulo ya esta en uso',
            'content.required' => 'El contenido es obligatorio.',
            'content.min'=>'el content minimo son :min caracteres',

        ];
        $post = Post::find($id);
        if($post){
            $validator = Validator::make($request->all(), $rules, $messages);
            if (!$validator->fails()){
                $res = $post->update($request->all());
                if($res){
                   return response()->json(['message'=>'post', 'data'=>$post], 200);
                }
                return response()->json(['error'=>'no se pudo actualizar el registro'], 404);
            }
        }
        return response()->json(['error'=>'no se pudo actualizar el registro', 'errors'=>$validator->errors()], 409);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $eliminado = false;
        $post= Post::find($id);
        if (!$post){
            return  response()->json(['error'=>'el post no existe'],404);
        }
        $eliminado = $post->delete();
        if($eliminado ){
            return response()->json(['message'=>'post eliminado'], 200);
        }
        return response()->json(['error'=> 'error al eliminar el post'], 409);
    }
}
