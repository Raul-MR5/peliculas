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
    $genero = recoge('genero');
    $duracion = recoge("duracion");
    $pais = recoge('pais');
    $sinopsis = recoge("sinopsis");
    $fotoCartel = recoge('fotoCartel');
    $fotoReparto_1 = recoge("fotoReparto_1");
    $fotoReparto_2 = recoge('fotoReparto_2');
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
    if ((!cNum($duracion))) {
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
    if ((!cFile("fotoCartel", $errores, $extensionesValidas, $rutaImagenes, $maxFichero, true))) {
        $errores['fotoCartel'] = 'La foto de cartel no es correcta';
        $error = true;
    }
    // if ((!cFile($fotoReparto_1, $errores, $extensionesValidas, $rutaImagenes, $maxFichero, false))) {
    //     $errores['fotoReparto_1'] = 'La foto de reparto no es correcta';
    //     $error = true;
    // }
    // if ((!cFile($fotoReparto_2, $errores, $extensionesValidas, $rutaImagenes, $maxFichero, false))) {
    //     $errores['fotoReparto_2'] = 'La foto reparto no es correcta';
    //     $error = true;
    // }
    //Sino se han encontrado errores pasamos a otra página
    if (empty($errores)) {
        echo "<script>console.log('Debug Objects: " . "empty" . "' );</script>";
        // $arrayGeneros = "";
        // foreach ($genero as $g) {
        //     print($genero[1]);
        //     $arrayGeneros += $g;
        // }
        header('location:correcto.php?titulo='.$titulo.'&fechaEstreno='.$fechaEstreno.'&pais='.$pais.'&sinopsis='.$sinopsis.'&fotoCartel='.$_FILES["fotoCartel"].'&duracion='.$duracion.'');
    } else {
        foreach ($errores as $e) {
            echo "<script>console.log('Debug Objects: " . $e . "' );</script>";
        }
        //Volvemos a mostrar el formulario con errores genero[]=a&genero[]=b&fotoReparto_1=$fotoReparto_1&fotoReparto_2=$fotoReparto_2
        // foreach ($errores as $e) {
        //     print($e);
        // }
        include('form.php');
    }
}
?>


<?php
    pie();
?>