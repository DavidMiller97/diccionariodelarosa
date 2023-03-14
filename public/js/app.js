$(document).ready(function() {

    if(localStorage.getItem('autor-libros') != null){

        $('#control-libros').css('display', 'flex');
        const libros = JSON.parse(localStorage.getItem("autor-libros"));
        console.log(libros);
        $('<h4></h4>', {text: libros.autorNombre}).appendTo($('#control-libros .autor'));
        $('#actual').text(parseInt(localStorage.getItem('libro-actual')));
        $('#numero-libros').text(libros.libros.length);

        if(parseInt(localStorage.getItem('libro-actual')) >= JSON.parse(localStorage.getItem("autor-libros")).libros.length){
            $('#adelante').css('opacity', 0.5);
        }else if(parseInt(localStorage.getItem('libro-actual')) <= 1){
                $('#atras').css('opacity', 0.5);
        }

        
    }
    
    $('#adelante').click(function(e){

        e.preventDefault();

        const libros = JSON.parse(localStorage.getItem("autor-libros"));

        if(parseInt(localStorage.getItem('libro-actual')) >= libros.libros.length) {
            console.log('lleno ' + parseInt(localStorage.getItem('libro-actual')));
            return;
        }


        let siguiente = parseInt(localStorage.getItem('libro-actual'))+1;
        localStorage.setItem("libro-actual", siguiente);

        let enlace = libros.libros.filter((libro) => libro.id == siguiente);
        window.location.href = enlace[0].url;

    });

    $('#atras').click(function(e){

        e.preventDefault();

        const libros = JSON.parse(localStorage.getItem("autor-libros"));

        if(parseInt(localStorage.getItem('libro-actual')) <= 1) {
            console.log('vacio ' + parseInt(localStorage.getItem('libro-actual')));
            return;
        }

        let siguiente = parseInt(localStorage.getItem('libro-actual'))-1;
        
        localStorage.setItem("libro-actual", siguiente);

        let enlace = libros.libros.filter((libro) => libro.id == siguiente);
        window.location.href = enlace[0].url;

        

    });

    $('.cerrar-controls').click(function(){

        $('#control-libros').css('display', 'none');
        localStorage.removeItem('libro-actual');
        localStorage.removeItem('autor-libros');

    });

    //Scroll a donde esta la ficha del libro buscado
    const queryString = window.location.search;
    const params = new URLSearchParams(queryString);

    if(params.has('marca')){
        let scroll = $(`[data-id=${params.get('marca')}]`).offset().top - document.body.scrollTop;
        $(window).scrollTop(scroll ? scroll : 0);
    }

    //Mantener el scroll en la barra de folios

    let scroll = localStorage.getItem('scroll');

    $('#pagination').scrollLeft(scroll ? scroll : 0);

    $('#pagination').scroll(function(e){

        let scroll = $(this).scrollLeft();
        localStorage.setItem('scroll', scroll);
    });

    //Diccionario modos****************************************************************
    $('#ambos').click(function(){

        if($('#folio-traducido').is(':visible') && $('#folio-imagen').is(':visible')) return;

        $('#folio-traducido').show();
        $('#folio-imagen').show();

    });

    $('#traduccion').click(function(){

        
        if($('#folio-traducido').is(':visible') && !$('#folio-imagen').is(':visible')) return;

        $('#folio-imagen').hide();
        $('#folio-traducido').show();
        
        
    });

    $('#original').click(function(){

        
        if($('#folio-imagen').is(':visible') && !$('#folio-traducido').is(':visible')) return;

        $('#folio-traducido').hide();
        $('#folio-imagen').show();
        
    });

    //Menu****************************************************************************************************
    $("span[class^='hamburger-menu']").click(function() {

        $(this).toggleClass('toggle');

    });

    $('#hamburger-menu').click(function() {

        $('.menu-responsive').toggleClass('active');
    });

    $('main').click(function(e) {

        if($(e.target).closest('.menu-responsive').length === 0){

            $('.menu-responsive').removeClass('active');
            $("span[class^='hamburger-menu']").toggleClass('toggle');
        }
    });

    //Modal*****************************************************************************************************

    $('#buscador').click(function() {

        $('#modalBusqueda').toggleClass('active');
        $('#resultados').html('');
    });

    $('.cerrar').click(function() {

        $('#modalLibro').removeClass('active');
        $('#modalBusqueda').removeClass('active');
        $('#resultados').html('');
    });

    $('.modal-contenedor').click(function(e) {

        if($(e.target).closest('.modal').length === 0){

            $('.modal-contenedor').removeClass('active');
            $('#resultados').html('');
        }
    });

    $('#manuscrito').click(function(){

        $('#modalImagen').toggleClass('active');

    });

    
    $('#buscar').click(buscar); 
    $('#input-buscar').keypress(function(e){

        var code = (e.keyCode ? e.keyCode : e.which);

        if(code==13){

            buscar();
        }

    });

    //Regsitros**********************************************************************************************
    $('.registro').click(function(){

        $("#preloader-busqueda").css('display', 'flex');

        let id = $(this).data('id');

        $.ajax({

            url: `http://127.0.0.1:8001/libro/${id}`,

        }).then(function(data){

            //Limpiar modal
            $('#modal-libro .informacion').empty();
            $('#modalLibro').toggleClass('active');

            const {nombre, autor, localizacion, marca, estante, libro_id, noInventario, noPaginas} = data.data;
            const { libros } = autor;

            //Autor
            if(autor){

                let h3 = $('<h3></h3>', {id: 'autor'});

                h3.html(`<span>Autor: </span>${autor.nombre}`);

                h3.appendTo('#modal-libro .informacion');
            }

            $('<h3></h3>', {text: 'Libro:'}).appendTo('#modal-libro .informacion');
            let div = $('<div></div>', {class: 'info-libro'});

            //Nombre libro
            if(nombre) $('<h4></h4>').html(`<span>Titulo: </span>${nombre}`).appendTo(div);
            //Marca
            if(marca) $('<h4></h4>').html(`<span>Marca: </span>${marca.nombre}`).appendTo(div);
            //Estante
            if(estante) $('<h4></h4>').html(`<span>Estante: </span>${estante.nombre}`).appendTo(div);
            //No paginas
            if(noPaginas) $('<h4></h4>').html(`<span>No. Páginas: </span>${noPaginas}`).appendTo(div);
            //Inventario
            if(noInventario) $('<h4></h4>').html(`<span>Inventario: </span>${noInventario}`).appendTo(div);

            //Localizacion
            if(localizacion){

                $('<h4></h4>').html('<span>Localizacion</span>').appendTo(div);

                let divLoalizacion = $('<div></div>', {class: 'info-localizacion'});

                $('<h4></h4>').html(`<span>Nombre:</span> ${localizacion.nombre}`).appendTo(divLoalizacion);
                //Pais
                if(localizacion.pais) $('<h4></h4>').html(`<span>Pais: </span>${localizacion.pais.nombre}`).appendTo(divLoalizacion);
                //URL
                if(localizacion.direccion_url) $('<h4></h4>').html(`<a href="${localizacion.direccion_url}" target="_blank"><span>Link</span></a>`).appendTo(divLoalizacion);

                divLoalizacion.appendTo(div);
            }

            div.appendTo('#modal-libro .informacion');


            //Mas libros del autor
            if(libros && libros.length > 1){

                $('<h3></h3>', {text: 'Más libros del Autor:'}).appendTo('#modal-libro .informacion');

                let divLibros = $('<div></div>', {class: 'libros'});
                let a;
                let ul = $('<ul></ul>');
                let li;

                libros.forEach(function(libro){

                    if(libro_id != libro.libro_id){

                        li = $('<li></li>');
                        a = $('<a></a>', {text: `${libro.nombre}`, href: `http://127.0.0.1:8001/folio?page=${libro.folio_id}&marca=${libro.texto_id}`});
                    
                        a.appendTo(li);
                        li.appendTo(ul);
                    }        
    
                });

                ul.appendTo(divLibros);

                divLibros.appendTo('#modal-libro .informacion');

            }

            $("#preloader-busqueda").css('display', 'none');


        })
        .catch(function(){

            $("#preloader-busqueda").css('display', 'none');

            //Limpiar modal
            $('#modal-libro .informacion').empty();
            $('#modalLibro').toggleClass('active');
            $('<h3></h3>', {text: 'Estamos trabajando para brindarte una mejor experiencia...'}).appendTo('#modal-libro .informacion');
        });
    });

});

function spinner (){

    if($('#resultados').children().length > 0) $('#resultados').empty();

    let divResultados = $('#resultados');
    let divContenedor = $('<div></div>', {class: 'contenedor-spinner', text: ''});
    let div = $('<div></div>', {class: 'lds-dual-ring', text: ''});


    div.appendTo(divContenedor);
    divContenedor.appendTo(divResultados);
    
}


function buscar(){ 

    let nombre = $('#input-buscar').val();
    let divResultados = $('#resultados');

    if(nombre){

        spinner();

        $.ajax({

            type: 'POST',
            headers: {
                
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: `http://127.0.0.1:8001/buscar`, 
            data: {nombre: nombre}

        }).then(function(data){
            
            divResultados.empty();
            const {autores, libros} = data;
            let h3;
            let ul;
            let li;

            if(autores.length > 0){

                h3 = $('<h3></h3>', {text: 'Autores:'});
                ul = $('<ul></ul>');
                let ulLibros = $('<ul></ul>');
                let li_libro;
                let a;


                autores.forEach(function(autor){
                   
                    li = $('<li></li>', {text: `${autor.nombre}`, class: 'autor-busqueda', id: `autor-${autor.autor_id}`}).click(function(){

                        if($(this).hasClass('autor-busqueda') && autor.libros.length > 0){

                            //Almacenar libros en el storage
                            const librosAutor = autor.libros.map((libro, index) => {

                                return {
                                    ...libro,
                                    id: index+1,
                                    url: `http://127.0.0.1:8001/folio?page=${libro.folio_id}&marca=${libro.texto_id}`,

                                }

                            }); 

                            console.log(librosAutor);
                            const libros_storage = JSON.stringify({libros:librosAutor, autorNombre:autor.nombre});
                            localStorage.setItem('autor-libros', libros_storage);
                            localStorage.setItem('libro-actual', 1);

                            /*ulLibros.empty();
                            autor.libros.forEach(libro => {

                                li_libro = $('<li></li>');
                                a = $('<a></a>', {text: `${libro.nombre}`, href: `http://127.0.0.1:8001/folio?page=${libro.folio_id}&marca=${libro.texto_id}`});

                                a.appendTo(li_libro);
                                li_libro.appendTo(ulLibros);
                                
                            });

                            ulLibros.appendTo($(this));*/

                            let enlace = librosAutor.filter((libro) => libro.id == localStorage.getItem("libro-actual"));
                            window.location.href = enlace[0].url;
                        }
                        
                    });
                    
                    li.appendTo(ul);
                });

                h3.appendTo(divResultados);
                ul.appendTo(divResultados);

            }

            if(libros.length > 0){

                h3 = $('<h3></h3>', {text: 'Libros:'});
                ul = $('<ul></ul>');

                libros.forEach(function(libro){

                    li = $('<li></li>');
                    a = $('<a></a>', {text: `${libro.nombre}`, href: `http://127.0.0.1:8001/folio?page=${libro.folio_id}&marca=${libro.texto_id}`});

                    a.appendTo(li);
                    li.appendTo(ul);

                });

                h3.appendTo(divResultados);
                ul.appendTo(divResultados);

            }

            if(autores.length == 0 && libros.length == 0) {

                h3 = $('<h3></h3>', {text: 'No hay resultados!'});

                h3.appendTo(divResultados);

            }
            
        
        }).catch(function(){

            divResultados.empty();
            h3 = $('<h3></h3>', {text: 'No hay resultados!'});

            h3.appendTo(divResultados);
        });

    }

    
    $('#input-buscar').val('');

}
