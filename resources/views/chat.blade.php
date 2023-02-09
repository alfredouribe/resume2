@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 text-center offset-md-2" >
            <h1 style="font-family: 'Montserrat', sans-serif; letter-spacing: 6px; color: white!important; transform: scale(1, 0.9);">ALFREDO URIBE <BR> CHATBOT</h1>
            <chat-component></chat-component>
        </div>
    </div>
</div>

@endsection

@push('scripts')
    
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.js"></script>

@endpush