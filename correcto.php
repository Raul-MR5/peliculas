<?php
    include ('./libs/bGeneral.php');
    cabecera (""); //el archivo actual
    echo "Nombre:", recoge('nombre');
    echo '<br>';
    echo "Generos:", recoge('genero');
    echo '<br>';
    echo "Fecha Estreno:", recoge('fechaEstreno');
    echo '<br>';
    echo "Duracion:", recoge('duracion');
    echo '<br>';
    echo "Pais:", recoge('pais');
    echo '<br>';
    echo "Sinopsis:", recoge('sinopsis');
    echo '<br>';
    echo "Foto Cartel:", recoge('fotoCartel');
    echo '<br>';
    echo "Foto Reparto 1:", recoge('fotoReparto_1');
    echo '<br>';
    echo "Foto Reparto 2:", recoge('fotoReparto_2');
    pie();
?>