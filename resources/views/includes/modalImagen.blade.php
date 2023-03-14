<div class="modal-contenedor" id="modalImagen">
    <div class="modal-imagen">
        <div class="cerrar">
            <img src="{{ asset('assets/images/iconos/cerrar.png') }}" alt="">
        </div>
        <div class="manuscrito-imagen">
            @if(isset($imagen))
                <img src="{{ route('folio.imagen', ['filename' => $imagen]) }}" alt="">
            @else
                <h2>Pagina vacia</h2>
            @endif
        </div>
    </div>
</div>