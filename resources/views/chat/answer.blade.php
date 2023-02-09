@extends('layouts.app')

@section('content')
    <answer-component iduser='{{ Auth::user()->id }}'></answer-component>
@endsection