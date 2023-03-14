@extends('layouts.app')
@section('content')
    <section id="creditos">
        <div class="contenedor-creditos">
            <div class="arreglo">
                <img src="{{ asset('assets/images/iconos/arreglo.png') }}" alt="">
            </div>
            <div class="creditos">
                <div class="credito">
                    <h4>Traducción</h4>
                    <h3><a href="https://bnm.iib.unam.mx/index.php/quienes-somos/directorio/investigadores/reyes-equiguas-salvador">Dr. Salvador Reyes Equiguas</a></h3>
                </div>
                <div class="credito">
                    <h4>Análisis y diseño para UX, UI, base de datos y programación</h4>
                    <h3>Francisco David Latapi Zapata</h3>
                </div>
            </div>
            <div class="arreglo">
                <img src="{{ asset('assets/images/iconos/arreglo.png') }}" alt="">
            </div>
        </div>
    </section>
@endsection