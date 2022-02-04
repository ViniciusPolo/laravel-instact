<?php

namespace App\Services;

use App\Models\Post;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use App\Repositories\PostRepository;
use Illuminate\Support\Facades\Storage;

class PostService 
{
    /**
     * @var PostRepository
     */
    public function __construct(PostRepository $repository)
    {
        $this->repository = $repository;
    }

    function store(array $input, UploadedFile $photo)
    {
        DB::beginTransaction();
        try {
            if(str_contains($input['description'],'porta')){
                DB::rollBack();
                return [
                    'sucess' => false,
                    'message' => "Não pode a palavra porta"
                ];
            }
            $path = $photo->store('public/images');
            $url = Storage::url($path);
            $post = $this->repository->create([
                'image'=>$url,
                'description'=>$input['description'],
                'user_id'=>$input['user_id']
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            logger()->error($th);
            return [
                'sucess'=>false,
                'message'=> 'Erro ao gravar posts.'
            ];
        }
        DB::commit();
        return [
            'sucess'=>true,
            'message'=>'Post Criado com sucesso.',
            'data'=>$post
        ];
    }
}
