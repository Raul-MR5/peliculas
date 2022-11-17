<?php

/****
 * Librería con funciones generales y de validación
 * @author Heike Bonilla
 * 
 */

function cabecera($titulo = "Peliculas")
{
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <title>
        <?= $titulo ?>
    </title>
    <meta charset="utf-8" />
</head>

<body>
    <?php
}

function pie()
{
    echo "</body>
	</html>";
}


//***** Funciones de sanitización **** //


/**
 * funcion sinTildes
 *
 * Elimina caracteres con tilde de las cadenas
 * 
 * @param string $frase
 * @return string
 */

function sinTildes($frase): string
{
    $no_permitidas = array(
        "á",
        "é",
        "í",
        "ó",
        "ú",
        "Á",
        "É",
        "Í",
        "Ó",
        "Ú",
        "à",
        "è",
        "ì",
        "ò",
        "ù",
        "À",
        "È",
        "Ì",
        "Ò",
        "Ù"
    );
    $permitidas = array(
        "a",
        "e",
        "i",
        "o",
        "u",
        "A",
        "E",
        "I",
        "O",
        "U",
        "a",
        "e",
        "i",
        "o",
        "u",
        "A",
        "E",
        "I",
        "O",
        "U"
    );
    $texto = str_replace($no_permitidas, $permitidas, $frase);
    return $texto;
}

/**
 * Funcion sinEspacios
 * 
 * Elimina los espacios de una cadena de texto
 * 
 * @param string $frase
 * @param string $espacio
 * @return string
 */

function sinEspacios($frase)
{
    $texto = trim(preg_replace('/ +/', ' ', $frase));
    return $texto;
}


/**
 * Funcion recoge
 * 
 * Sanitiza cadenas de texto
 * 
 * @param string $var
 * @return string
 */

function recoge(string $var)
{
    if (isset($_REQUEST[$var]) && (!is_array($_REQUEST[$var]))) {
        $tmp = sinEspacios($_REQUEST[$var]);
        $tmp = strip_tags($tmp);
    } else
        $tmp = "";

    return $tmp;
}

function recogeArray(string $var): array
{
    $array = [];
    if (isset($_REQUEST[$var]) && (is_array($_REQUEST[$var]))) {
        foreach ($_REQUEST[$var] as $valor)
            $array[] = strip_tags(sinEspacios($valor));
    }

    return $array;
}

//***** Funciones de validación **** //

/**
 * Funcion cTexto
 *
 * Valida una cadena de texto con respecto a una RegEx. Reporta error en un array.
 * 
 * @param string $text
 * @param string $campo
 * @param array $errores
 * @param integer $min
 * @param integer $max
 * @param bool $espacios
 * @param bool $case
 * @return bool
 */


function cTexto(string $text, string $campo, array &$errores, int $max = 30, int $min = 1, bool $espacios = TRUE, bool $case = TRUE): bool
{
    $case = ($case === TRUE) ? "i" : "";
    $espacios = ($espacios === TRUE) ? " " : "";
    if ((preg_match("/^[a-zñ$espacios]{" . $min . "," . $max . "}$/u$case", sinTildes($text)))) {
        return true;
    }
    $errores[$campo] = "Error en el campo $campo";
    return false;
}

function cTextoEspacio($text)
{
    if (preg_match("/^[A-Za-zÑñ ]+$/", sinTildes($text)))
        return 1;
    else
        return 0;
}

function cNumTexto($text)
{
    if (preg_match("/^[A-Za-zÑñ0-9]+$/", sinTildes($text)))
        return 1;
    else
        return 0;
}

function cNum($num)
{
    if (preg_match("/^[0-9]+$/", $num))
        return true;
    else
        return false;
}

function cCheck(array $text, string $campo, array &$errores, array $valores, bool $requerido = TRUE)
{

    if (($requerido) && (count($text) == 0)) {
        $errores[$campo] = "Error en el campo $campo";
        return false;
    }
    foreach ($text as $valor) {
        if (!in_array($valor, $valores)) {
            $errores[$campo] = "Error en el campo $campo";
            return false;
        }
    }
    return true;
}

/**
 * Funcion cRadio
 *
 * Valida que un string se encuentre entre los valores posibles. Si es requerido o no
 * 
 * @param string $text
 * @param string $campo
 * @param array $errores
 * @param array $valores
 * @param bool $requerido
 * 
 * @return boolean
 */
function cRadio(string $text, string $campo, array &$errores, array $valores, bool $requerido = TRUE)
{
    if (in_array($text, $valores)) {
        return true;
    }
    if (!$requerido && $text == "") {
        return true;
    }
    $errores[$campo] = "Error en el campo $campo";
    return false;
}


/**
 * Funcion cFile
 * 
 * Valida la subida de un archivo a un servidor.
 *
 * @param string $nombre
 * @param array $extensiones_validas
 * @param string $directorio
 * @param integer $max_file_size
 * @param array $errores
 * @param boolean $required
 * @return boolean|string
 */
function cFile(string $nombre, array &$errores, array $extensionesValidas, string $directorio, int $max_file_size, bool $required = TRUE)
{

    // echo "<script>console.log('Inicio: ".$errores."');</script>";
    if (is_array($_FILES[$nombre])) {
        if (($required) && $_FILES[$nombre]['error'] === 4){
            return true;
        }

        if ($_FILES[$nombre]['error'] != 0) {
            $errores["$nombre"] = "Error al subir el archivo " . $nombre . ". Prueba de nuevo";
            return false;
        } else {

            $nombreArchivo = strip_tags($_FILES["$nombre"]['name']);

            $directorioTemp = $_FILES["$nombre"]['tmp_name'];

            $tamanyoFile = filesize($directorioTemp);


            $extension = strtolower(pathinfo($nombreArchivo, PATHINFO_EXTENSION));

            if (!in_array($extension, $extensionesValidas)) {
                $errores["$nombre"] = "La extensión del archivo no es válida";
                return false;
            }

            if ($tamanyoFile > $max_file_size) {
                $errores["$nombre"] = "La imagen debe de tener un tamaño inferior a $max_file_size kb";
                return false;
            }

            // echo "<script>console.log('pepe');</script>";

            if (empty($errores["$nombre"])) {

                if (is_dir($directorio)) {

                    $nombreArchivo = is_file($directorio . DIRECTORY_SEPARATOR . $nombreArchivo) ? time() . $nombreArchivo : $nombreArchivo;
                    $nombreCompleto = $directorio . DIRECTORY_SEPARATOR . $nombreArchivo;

                    if (move_uploaded_file($directorioTemp, $nombreCompleto)) {
                        return $nombreCompleto;
                    } else {
                        $errores["$nombre"] = "Ha habido un error al subir el fichero";
                        return false;
                    }
                } else {
                    $errores["$nombre"] = "Ha habido un error al subir el fichero";
                    return false;
                }
            }
        }
    }

}
    ?>