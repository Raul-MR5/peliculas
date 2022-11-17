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
    $genero = isset($_POST['genero']) ? $_POST['genero'] : [];
    $duracion = recoge("duracion");
    $pais = recoge('pais');
    $sinopsis = recoge("sinopsis");

    //Validamos
    if ((!cTexto($titulo, "titulo", $errores, 30, 1, true, true))) {
        $errores['titulo'] = 'El titulo no es correcto';
        $error = true;
    }
    // if ((!checkdate($fechaEstreno) && $fechaEstreno!=null)) {
    //     $errores['fechaEstreno'] = 'La fecha de estreno no es correcta';
    //     $error = true;
    // }
    if ((!cCheck($genero, "genero", $errores, $generos))) {
        $errores['genero'] = 'El genero no es correcto';
        $error = true;
    }
    if ((!cNum($duracion) && $duracion != null)) {
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
        $errores['fotoCartel'] = 'La foto de cartel no es correcta';
        $error = true;
    }
    $dirFotoReparto_1 = cFile("fotoReparto_1", $errores, $extensionesValidas, $rutaImagenes, $maxFichero, true);
    if ((!$dirFotoReparto_1)) {
        $errores['fotoReparto_1'] = 'La foto de reparto no es correcta';
        $error = true;
    }
    $dirFotoReparto_2 = cFile("fotoReparto_2", $errores, $extensionesValidas, $rutaImagenes, $maxFichero, true);
    if ((!$dirFotoReparto_2)) {
        $errores['fotoReparto_2'] = 'La foto de reparto no es correcta';
        $error = true;
    }
    //Sino se han encontrado errores pasamos a otra página
    if (empty($errores)) {
        $arrayGeneros = "";
        $templateGenero = "&genero[]=";
        if (is_array($genero)) {
            foreach ($genero as $g) {
                $arrayGeneros .= $templateGenero.$g;
            }
        }

        header("location:correcto.php?titulo=$titulo&fechaEstreno=$fechaEstreno&duracion=$duracion$arrayGeneros&pais=$pais&sinopsis=$sinopsis&fotoCartel=$dirFotoCartel&fotoReparto_1=$dirFotoReparto_1&fotoReparto_2=$dirFotoReparto_2");
    } else {
        //Volvemos a mostrar el formulario con errores &&fotoReparto_1=$fotoReparto_1&fotoReparto_2=$fotoReparto_2
        include('form.php');
    }
}
?>


<?php
pie();
?>