@extends('layouts.app')

@section('titulo')
    Bienvenido a tu Feed
@endsection()

@section('contenido')
    <x-listar-post :posts="$posts" />
@endsection