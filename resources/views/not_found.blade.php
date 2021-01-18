@extends('app')
@section('title', trans('pokedex.title'))
@section('content')
    <div class="text-center" style="margin-top: 5%;">
        <h1 class="text-white">{{trans('pokedex.error.title')}}</h1>
        <h3 class="text-white" style="margin-bottom: 2%">{{trans("pokedex.error.$message")}}</h3>
        <a href="/pokedex" class="btn btn-primary" role="button" data-bs-toggle="button"><b>{{trans('pokedex.buttons.label.home')}}</b></a>
    </div>
@endsection
