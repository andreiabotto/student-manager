@extends('layouts.app')

@section('title', 'User manager')

@section('title_card', 'Usuários')

@section('content')
    @include('layouts.users.table')
@endsection

@section('menu_data')
    @include('layouts.users.menu')
@endsection
