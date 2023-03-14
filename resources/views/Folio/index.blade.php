@extends('layouts.app')
@section('content')
    <section id="diccionario">
        <div class="contenedor-diccionario">
            <h2>Diccionario</h2>
            <div class="presentacion-diccionario">
                <a href="{{ route('folio.texto') }}">
                    <div class="texto">
                        <h3>Diccionario bibliográfico alfabético e índice silabo repertorial de cuantos libros sencillos existen en esta librería de este convento de Nuestro Santo Padre San Francisco de México</h3>
                        <p>
                            El libro presenta un catálogo ordenado por títulos, apellidos de los autores que realizó el bibliotecario del Convento de San Francisco, el señor fray Francisco Antonio de la Rosa Figueroa. Al principio de la obra se presentan algunas notas previo al uso del diccionario, donde se explica la estructura y organización, así como algunas recomendaciones sobre la presente obra de consulta. 
                        </p>
                    </div>
                </a>
                <div class="ojo">
                    <a href="{{ route('folio.texto') }}">
                        <img src="{{ asset('assets/images/iconos/ojo.png') }}" alt="">
                    </a>
                </div>
            </div>
            <div class="arreglo">
                <img src="{{ asset('assets/images/iconos/arreglo.png') }}" alt="">
            </div>
        </div>
    </section>
@endsection