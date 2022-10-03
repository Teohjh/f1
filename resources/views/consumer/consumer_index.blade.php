@extends('layouts.consumer_main')

@section('title','Homepage')

@section('consumer_content')


{{ Auth::user()->name }}

fff
@endsection