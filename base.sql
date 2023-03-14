CREATE DATABASE IF NOT EXISTS equiguas_diccionariodelarosa;
USE equiguas_diccionariodelarosa;


CREATE TABLE IF NOT EXISTS folio (

    folio_id INT NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(100) NOT NULL,
    ruta_imagen VARCHAR(255) NULL,
    
    CONSTRAINT pk_folio PRIMARY KEY (folio_id)
);


CREATE TABLE IF NOT EXISTS tipo (

    tipo_id INT NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(100) NOT NULL,

    CONSTRAINT pk_tipo 
    PRIMARY KEY (tipo_id)
);

CREATE TABLE IF NOT EXISTS texto (

    texto_id INT NOT NULL AUTO_INCREMENT,
    folio_id INT NOT NULL,
    tipo_id INT NOT NULL,
    contenido TEXT NOT NULL,

    CONSTRAINT pk_texto PRIMARY KEY (texto_id),
    CONSTRAINT fk_texto_folio FOREIGN KEY (folio_id) REFERENCES folio (folio_id),
    CONSTRAINT fk_texto_tipo FOREIGN KEY (tipo_id) REFERENCES tipo (tipo_id)
);

CREATE TABLE IF NOT EXISTS categoria (

    categoria_id INT NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(255) NOT NULL,

    CONSTRAINT pk_categoria PRIMARY KEY (categoria_id)
);

CREATE TABLE IF NOT EXISTS estante (

    estante_id INT NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(255) NOT NULL,

    CONSTRAINT pk_estante PRIMARY KEY (estante_id)
);

CREATE TABLE IF NOT EXISTS autor (

    autor_id INT NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(255) NOT NULL,

    CONSTRAINT pk_autor PRIMARY KEY (autor_id)
);

CREATE TABLE IF NOT EXISTS seudonimo (

    seudonimo_id INT NOT NULL AUTO_INCREMENT,
    autor_id INT NOT NULL,
    nombre VARCHAR(255) NOT NULL,

    CONSTRAINT pk_seudonimo PRIMARY KEY (seudonimo_id),
    CONSTRAINT fk_seudonimo_autor FOREIGN KEY (autor_id) REFERENCES autor (autor_id)
);

CREATE TABLE IF NOT EXISTS pais (

    pais_id INT NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(255) NOT NULL,

    CONSTRAINT pk_pais PRIMARY KEY (pais_id)
);

CREATE TABLE IF NOT EXISTS localizacion (

    localizacion_id INT NOT NULL AUTO_INCREMENT,
    pais_id INT NULL,
    nombre TEXT NULL,
    direccion_url TEXT NULL,

    CONSTRAINT pk_localizacion PRIMARY KEY (localizacion_id),
    CONSTRAINT fk_localizacion_pais FOREIGN KEY (pais_id) REFERENCES pais (pais_id)
);

CREATE TABLE IF NOT EXISTS marca (

    marca_id INT NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(255) NOT NULL,

    CONSTRAINT pk_marca PRIMARY KEY (marca_id)
);

CREATE TABLE IF NOT EXISTS libro (

    libro_id INT NOT NULL AUTO_INCREMENT,
    folio_id INT NOT NULL,
    texto_id INT NOT NULL,
    autor_id INT NULL,
    categoria_id INT NULL,
    estante_id INT NULL,
    localizacion_id INT NULL,
    marca_id INT NULL,
    nombre TEXT NOT NULL,
    noInventario INT NULL,
    noPaginas INT NULL,

    CONSTRAINT pk_libro PRIMARY KEY (libro_id),
    CONSTRAINT fk_libro_folio FOREIGN KEY (folio_id) REFERENCES folio (folio_id),
    CONSTRAINT fk_libro_texto FOREIGN KEY (texto_id) REFERENCES texto (texto_id),
    CONSTRAINT fk_libro_autor FOREIGN KEY (autor_id) REFERENCES autor (autor_id),
    CONSTRAINT fk_libro_categoria FOREIGN KEY (categoria_id) REFERENCES categoria (categoria_id),
    CONSTRAINT fk_libro_estante FOREIGN KEY (estante_id) REFERENCES estante (estante_id),
    CONSTRAINT fk_libro_localizacion FOREIGN KEY (localizacion_id) REFERENCES localizacion (localizacion_id),
    CONSTRAINT fk_libro_marca FOREIGN KEY (marca_id) REFERENCES marca (marca_id)
);



INSERT INTO tipo (nombre) VALUES ('titulo');
INSERT INTO tipo (nombre) VALUES ('texto');


DELIMITER //
CREATE PROCEDURE escribirfolios()
BEGIN
    DECLARE str VARCHAR(255) DEFAULT '';
    DECLARE _value INT DEFAULT 0;
    DECLARE _counter INT DEFAULT 0;
    DECLARE _counter2 INT DEFAULT 0;
    DECLARE x INT;
    DECLARE bandera BOOLEAN DEFAULT FALSE;
    DECLARE isPagina BOOLEAN DEFAULT FALSE;
    DECLARE paginas INT DEFAULT 0;

    SET @saltar = '[31, 108, 109, 110, 111, 112, 113, 114, 115, 116, 117, 119, 120, 121, 122, 123, 124, 125, 126, 127, 128, 130, 131, 132, 133, 134, 135, 136, 137, 138, 139, 141, 142, 143, 144, 145, 146, 147, 148, 149, 150, 152, 153, 154, 155, 156, 157, 158, 159, 160, 161, 163, 164, 165, 166, 181, 264]';
    SET @falta = '[24, 120, 201]';

    SET x = 0; 
    SET str = '';

    loop_label : LOOP
        IF x > 497 THEN
            LEAVE loop_label;
        END IF;

        IF x >= 8 THEN

            WHILE(_counter < JSON_LENGTH(@saltar)) DO
                SET _value = JSON_EXTRACT(@saltar, CONCAT('$[', _counter, ']'));

                IF (x = _value) THEN
                    SET bandera = TRUE;
                END IF;
            
                SET _counter = _counter + 1;
            END WHILE;

            IF NOT (bandera) THEN
                
                SET paginas = paginas + 1;

                /*No hay********************************************************************************/
                WHILE(_counter2 < JSON_LENGTH(@falta)) DO
                    SET _value = JSON_EXTRACT(@falta, CONCAT('$[', _counter2, ']'));
    
                    IF (paginas = _value) THEN
                        SET isPagina = TRUE;
                    END IF;
                
                    SET _counter2 = _counter2 + 1;
                END WHILE;

                IF (isPagina) THEN

                    INSERT INTO folio (nombre, ruta_imagen) VALUES (CONCAT('folio', paginas), NULL);
                    SET x = x - 1;

                ELSE

                    INSERT INTO folio (nombre, ruta_imagen) VALUES (CONCAT('folio', paginas), CONCAT('folio', x,'.jpg'));   
                    
                END IF;

                SET isPagina = FALSE;
                SET _counter2 = 0;
                /*****************/    
            
                
            END IF;

                SET bandera = FALSE;
                SET _counter = 0;
        END IF;

        
        SET x = x + 1;
        ITERATE loop_label;
    END LOOP;
  SELECT str;
END//
DELIMITER ;


CALL escribirfolios();















