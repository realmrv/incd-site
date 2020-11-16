@extends('layouts.app')

@section('title', 'Page')

@section('content')
    @widget('dataPanel', compact('page_uid'))
@endsection
