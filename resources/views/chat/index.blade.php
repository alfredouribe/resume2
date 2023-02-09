@extends('layouts.app')

@section('content')
    <chat-config-component iduser='{{ Auth::user()->id }}'></chat-config-component>
@endsection