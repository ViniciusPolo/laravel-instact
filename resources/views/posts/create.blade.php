@extends('layouts.app')

@section('title', '| Criar')

@section('content')
    @include('components/navbar')
    <div class="min-vh-100 d-flex justify-content-center align-items-center">
        <form class="mw-100 " action="store" method="post" enctype="multipart/form-data">
            @csrf
            <h1 class="text-secondary text-center mb-5"> Criar Post</h1>
            <div class="mb-3">
                <input class="form-control" type="file" name="photo" accept="image/*" required>{{--accept = todo tipo de imagem / required campo obrigatório--}}
            </div>
            
            <div class="mb-3">
                <textarea class= "form-control" name="description" id="" placeholder="Descrição" rows="3"></textarea>
            </div>
            
           
            
            <div class="d-grid gap-2">
                <button class="btn btn-outline-primary" type="submit">Enviar</button>
            </div>
        </form>
    </div>
    @include('components/footer')
@endsection
