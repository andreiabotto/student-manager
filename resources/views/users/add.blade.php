@extends('layouts.app')

@section('title', 'User manager')

@if (request()->path() == 'add')
    @section('title_card', 'Adicionar usuário')
@else (request()->path() == 'edit')
    @section('title_card', 'Editar usuário')
@endif

@section('content')
    @include('layouts.users.form')

@endsection

@section('menu_data')

@endsection
