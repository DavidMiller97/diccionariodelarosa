@extends('layouts.app')
@section('content')
    <section id="presentacion">
        <div class="contenedor-presentacion">
            <h1>Fray Francisco Antonio<br/><span>De la Rosa</span></h1>
            <div class="libro">
                <img src="{{ asset('assets/images/iconos/libro.png') }}" alt="Libro">
            </div>
            <div class="arreglo">
                <img src="{{ asset('assets/images/iconos/arreglo.png') }}" alt=""">
            </div>
        </div>
    </section>
@endsection