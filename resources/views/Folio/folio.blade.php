@extends('layouts.app')
@section('content')
    <section id="inicio">
        <div class="contenedor-links">
            <a href="{{ route('folio.index') }}">← Regresar</a>
            <div class="links">
                <h4>Folios</h4>
                {{$folios->links('vendor.pagination.custom')}}
            </div>
        </div>
        <div class="contenedor-links">
            <div class="links">
                <h4>Letras</h4>
                <nav class="pagination">
                    <ul class="lista">
                        @foreach($foliosLetras as $key => $value)
                            @if(isset($_GET['page']) && $value == $_GET['page'])
                                <li class="active"><span>{{$key}}</span></li>
                            @else
                                <li><a href={{"http://127.0.0.1:8000/folio?page=$value"}}>{{$key}}</a></li>
                            @endif
                        @endforeach
                    </ul>
                </nav>
            </div>
        </div>
        <div class="contenedor-opciones">
            <div class="info">
                <h3>Reproducción Digital</h3>
                <h4>Traducción por: <a href="https://bnm.iib.unam.mx/index.php/quienes-somos/directorio/investigadores/reyes-equiguas-salvador">Dr. Salvador Reyes Equiguas</a></h4>
            </div>
            <div class="info-opciones">
                <h3>Visualización</h3>
                <div class="opciones">
                    <form action="">
                        <label for="traduccion">Traducción</label>
                        <div class="contenedor-radio">
                            <input type="radio" name="opcion" id="traduccion">
                            <span class="checkmark"></span>
                        </div>
                        <label for="original">Original</label>
                        <div class="contenedor-radio">
                            <input type="radio" name="opcion" id="original">
                            <span class="checkmark"></span>
                        </div>
                        <label for="ambos">Ambos</label>
                        <div class="contenedor-radio">
                            <input type="radio" name="opcion" id="ambos" checked>
                            <span class="checkmark"></span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="contenedor-titulo">
            <h2>Titulo</h2>
        </div>
        <div class="contenedor-texto">
            <div class="boton-manuscrito" id="manuscrito">
                Manuscrito
            </div>
            <div class="container">
                <div class="card folio-traducido" id="folio-traducido">
                    <?php (isset($_GET['marca']) && !empty($_GET['marca'])) ? $marcar = $_GET['marca'] : $marcar = 0; ?>
                    @foreach($folios as $folio)
                        @if(isset($folio->ruta_imagen))
                            <?php $imagen = $folio->ruta_imagen;?>
                            @if($folio->textos->count() > 0)
                                @foreach ($folio->textos as $texto) 
                                    @if($texto->tipo_id == 1 || $texto->folio_id < 15)
                                        {!!$texto->contenido!!}
                                    @else
                                        <p data-id={{_($texto->texto_id)}} class="registro @if($texto->texto_id == $marcar) marcado @endif">{{_($texto->contenido)}}</p>
                                    @endif
                                        
                                @endforeach
                            @else
                                <h2>Estamos trabajando para brindarte la mejor experiencia...</h2>
                            @endif
                        @else
                            <h2>Pagina vacia</h2>
                        @endif
                    @endforeach
                </div>
                @if(isset($imagen))
                    @include('includes.modalImagen', ['imagen' => $imagen])
                @endif
                <div class="card folio-imagen" id="folio-imagen">
                    @if(isset($imagen))
                        <img src="{{ route('folio.imagen', ['filename' => isset($imagen) ? $imagen : '']) }}" alt="">
                    @endif
                </div>
            </div>
        </div>
        <div class="paginacion-footer">
            {{$folios->links('vendor.pagination.other')}}
        </div>
        <div class="arreglo">
            <img src="{{ asset('assets/images/iconos/arreglo.png') }}" alt="">
        </div>
    </section>
    @include('includes.modalLibro')
@endsection
