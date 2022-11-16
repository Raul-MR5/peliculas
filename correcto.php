<?php
    include ('./libs/bGeneral.php');
    cabecera (""); //el archivo actual
    echo "Título:", recoge('titulo');
    echo '<br>';
    echo "Generos:", var_dump(recoge('genero')) ;
    echo '<br>';
    echo "Fecha Estreno:", recoge('fechaEstreno');
    echo '<br>';
    echo "Duracion:", recoge('duracion');
    echo '<br>';
    echo "Pais:", recoge('pais');
    echo '<br>';
    echo "Sinopsis:", recoge('sinopsis');
    echo '<br>';
    echo "Foto Cartel:", "<br><img src=".recoge('fotoCartel')." width=250px>";
    echo '<br>';
    echo "Foto Reparto 1:", "<br><img src=".recoge('fotoReparto_1')." width=250px>";
    echo '<br>';
    echo "Foto Reparto 2:", "<br><img src=".recoge('fotoReparto_2')." width=250px>";
    pie();
?>