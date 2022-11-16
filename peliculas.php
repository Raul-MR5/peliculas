<?php
include('./libs/bGeneral.php');
include('./libs/config.php');
cabecera();
$error = false;

// array donde almacenaremos el texto de los errores encontrados
$errores = [];

$titulo = "";
$fechaEstreno = "";
$genero = "";
$duracion = "";
$pais = "";
$sinopsis = "";
$fotoCartel = "";
$fotoReparto_1 = "";
$fotoReparto_2 = "";

//Compruebo si se ha pulsado el botón del formulario
if (!isset($_REQUEST['bAceptar'])) {

    //Sino se ha pulsado, incluyo el formulario
    include('form.php');

} // Si se ha pulsado procesamos los datos recibidos
else {
    //Sanitizamos
    $titulo = recoge("titulo");
    $fechaEstreno = recoge('fechaEstreno');
    $genero = recogeArray('genero');
    $duracion = recoge("duracion");
    $pais = recoge('pais');
    $sinopsis = recoge("sinopsis");
    $fotoCartel = recoge('fotoCartel');
    $fotoReparto_1 = recoge("fotoReparto_1");
    $fotoReparto_2 = recoge('fotoReparto_2');
    echo "<script>console.log('".$fotoReparto_2."');</script>";

    //Validamos
    if ((!cTexto($titulo, "titulo", $errores, 30, 1, true, true))) {
        $errores['titulo'] = 'El titulo no es correcto';
        $error = true;
    }
    // if ((!checkdate($fechaEstreno))) {
    //     $errores['fechaEstreno'] = 'La fecha de estreno no es correcta';
    //     $error = true;
    // }
    // if ((!cCheck($genero, "genero", $errores, $generos))) {
    //     $errores['genero'] = 'El genero no es correcto';
    //     $error = true;
    // }
    if ((!cNum($duracion) && $duracion!=null)) {
        $errores['duracion'] = 'La duracion no es correcta';
        $error = true;
    }
    if ((!cTexto($pais, "pais", $errores, 30, 1, true, true))) {
        $errores['pais'] = 'El pais no es correcto';
        $error = true;
    }
    if ((!cTexto($sinopsis, "sinopsis", $errores, 30, 1, true, true))) {
        $errores['sinopsis'] = 'La sinopsis no es correcta';
        $error = true;
    }
    $dirFotoCartel = cFile("fotoCartel", $errores, $extensionesValidas, $rutaImagenes, $maxFichero, true);
    if ((!$dirFotoCartel)) {
        echo "<script>console.log('peta');</script>";
        $errores['fotoCartel'] = 'La foto de cartel no es correcta';
        $error = true;
    }
    if ((!cFile("fotoReparto_1", $errores, $extensionesValidas, $rutaImagenes, $maxFichero, true) && $fotoReparto_1!=null)) {
        $errores['fotoReparto_1'] = 'La foto de reparto no es correcta';
        $error = true;
    }
    if ((!cFile("fotoReparto_2", $errores, $extensionesValidas, $rutaImagenes, $maxFichero, true) && $fotoReparto_2!=null)) {
        $errores['fotoReparto_2'] = 'La foto reparto no es correcta';
        $error = true;
    }
    //Sino se han encontrado errores pasamos a otra página
    if (empty($errores)) {
        echo "<script>console.log('dentro');</script>";
        header("location:correcto.php?titulo=$titulo&fechaEstreno=$fechaEstreno&duracion=$duracion&genero=$genero&pais=$pais&sinopsis=$sinopsis&fotoCartel=$dirFotoCartel");
    } else {
        //Volvemos a mostrar el formulario con errores &&fotoReparto_1=$fotoReparto_1&fotoReparto_2=$fotoReparto_2
        include('form.php');
        foreach ($errores as $e) {
            echo "<script>console.log('fuera".$e."');</script>";
        }
    }
}
?>


<?php
    pie();
?>