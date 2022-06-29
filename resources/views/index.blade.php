@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12 text-center">

            <h1 style="font-family: 'Montserrat', sans-serif; letter-spacing: 6px; color: white!important; transform: scale(1, 0.9);">ALFREDO URIBE</h1>
            <h2>Web Developer</h2>

        </div>
    </div>
    <div class="row">
        <div class="col-md-2 col-sm-12 personalData">
            
            <infocomponent></infocomponent>

            <!-- <carcomponent></carcomponent> -->
        </div>

        <div class="col-md-8 col-sm-12">
            <div class="">
                <consolecomponent v-if="consola == true"></consolecomponent>
                <gamecomponent v-if="consola == false"></gamecomponent>
            </div>

            <div class="row">
                <div class="">
                    <!-- <keyboardcomponent></keyboardcomponent> -->
                    <!-- <keyboard2component @onChange="onChange" @onKeyPress="onKeyPress" :input="newCommand"></keyboard2component> -->
                </div>
            </div>

        </div>

        <div class="col-md-2 col-sm-12">
            <div id="time">
                <clockcomponent date="<?= date('Y-m-d') ?>"></clockcomponent>
            </div>

            <div class="text-center">
                <ipcomponent ip="<?= $_SERVER['REMOTE_ADDR'] ?>"></ipcomponent>
            </div>

            <div class="borderTop text-center" style="word-wrap: break-word;">
                <p><i class="fas fa-envelope"></i> Email:<br><a href="mailto:alfredo.uribe.sanchez@gmail.com" target="blank" alt="Email">alfredo.uribe.sanchez@gmail.com</a></p>
                <p><i class="fas fa-phone"></i> Phone:<br><a href="tel:+524432373943" alt="Phone" >+52 44 32 37 39 43</a></p>
                <p><i class="fas fa-map-pin"></i> Address:<br><a href="https://www.google.com/maps/place/Morelia,+Mich./@19.7036417,-101.2761644,12z/data=!3m1!4b1!4m5!3m4!1s0x842d0ba2b29da7e3:0x4016978679c8620!8m2!3d19.7059504!4d-101.1949825" target="blank" >Morelia, Mexico</a></p>
            </div>

            <!-- <div class="text-center borderTop">
                <worldcomponent></worldcomponent>
                <small>this is not real information</small>
            </div> -->

            <!-- <carcomponent></carcomponent> -->
            <img src="//rf.revolvermaps.com/h/m/a/5/ff0000/128/0/5rodzt405u9.png" width="100%" height="128" alt="Map" style="border:0;">

        </div>
    </div>

</div>
@endsection

@push('scripts')

    <script src="{{ asset('chart.js/chart.js') }}"></script>
    <script type="text/javascript">

    </script>
@endpush