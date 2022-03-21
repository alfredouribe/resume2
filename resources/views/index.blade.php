@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12 text-center">
            <h1 style='font-size:20px; color: #a9ced0' alt="Alfredo Uribe">Alfredo Uribe (A Resume as Never Seen)</h1>
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
                <p><i class="fas fa-map-pin"></i> Address:<br><a href="https://www.google.com/maps/@19.6851089,-101.2196657,3a,75y,145.19h,90t/data=!3m7!1e1!3m5!1s8m4wRJno9sIbDOxHmA1j9w!2e0!6shttps:%2F%2Fstreetviewpixels-pa.googleapis.com%2Fv1%2Fthumbnail%3Fpanoid%3D8m4wRJno9sIbDOxHmA1j9w%26cb_client%3Dmaps_sv.tactile.gps%26w%3D203%26h%3D100%26yaw%3D146.78522%26pitch%3D0%26thumbfov%3D100!7i13312!8i6656" target="blank" >Sol Edificio E int 101, Cosmos, 58050, Morelia, Michoacan, Mexico.</a></p>
            </div>

            <div class="text-center borderTop">
                <worldcomponent></worldcomponent>
                <small>this is not real information</small>
            </div>
        </div>
    </div>

</div>
@endsection

@push('scripts')
    <script src="{{ asset('chart.js/chart.js') }}"></script>
    <script type="text/javascript">

    </script>
@endpush