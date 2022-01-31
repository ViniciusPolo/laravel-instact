@extends('layouts.app')

@section('title', '| Dashboard')

@section('content')
    @include('components/navbar')
    
    <div class="min-vh-100 d-flex flex-column justify-content-center align-items-center" style="margin-top: 100px">
        @for($i=0;$i<5;$i++)
        @include('components/post-card')
        @endfor
    </div>
    @include('components/footer')
   
@endsection
