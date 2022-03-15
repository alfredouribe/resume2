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
        </div>

        <div class="col-md-8 col-sm-12">
            <div class="consoleSection">
                <consolecomponent v-if="consola == true"></consolecomponent>
                <gamecomponent v-if="consola == false"></gamecomponent>
            </div>

            <div class="row">
                <div class="col d-flex align-items-end justify-content-center">
                    <keyboardcomponent></keyboardcomponent>
                </div>
            </div>

        </div>

        <div class="col-md-2 col-sm-12">
            <div id="time">
                <clockcomponent date="<?= date('Y-m-d') ?>"></clockcomponent>
            </div>

            <div>
                <ipcomponent ip="<?= $_SERVER['REMOTE_ADDR'] ?>"></ipcomponent>
            </div>

            <div class="text-center">
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