<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdatePostRequest;
use App\Services\PostService;

class PostController extends Controller
{
    /**
     * @var PostService
     * @return \Illuminate\Http\Response
     */
    protected $service;

    /**
     * Método Contrutor da Classa
     */
    public function __construct(PostService $service)
    {
        $this->service = $service; //injeção de dependencias
    }


    public function index()
    {
        $user = auth()->user();
        $posts = Post::orderby('id','desc')->get();
        return view('/dashboard', compact('posts', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = auth()->user();

        return view('posts.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        //código transferido para a service
        $input = $request->only('description');
        $input['user_id'] = auth()->id();

        $response = $this->service->store(
            $input,
            $request->photo
        );

        if(!$response['sucess']){
            return back()->with('error',$response['message']);
        }
        return redirect('dashboard');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}
