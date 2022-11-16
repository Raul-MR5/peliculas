<form action="" method='post' enctype="multipart/form-data">
    Título: <input type="text" name="titulo" value="<?= isset($titulo) ? $titulo : ""; ?>" required>
    <br>
    <?php
    echo (isset($errores['titulo'])) ? "$errores[titulo] <br>" : "";
    ?>

    <br>

    Fecha de estreno: <input type="date" name="fechaEstreno" value="<?= isset($fechaEstreno) ? $fechaEstreno : ""; ?>">
    <br>
    <br>

    Género: 
    <?php
    if (is_array($generos))
    {
        foreach ($generos as $g)
            echo '<input type="checkbox" name="genero" value="'.$g.'">'.$g.' ';
    }
    ?>

    <br>
    <?php
        echo (isset($errores['genero'])) ? "$errores[genero] <br>" : "";
        ?>

    <br>

    Duración: <input type="number" name="duracion" value="<?= isset($duracion) ? $duracion : ""; ?>">
    <br>
    <br>

    País:
    
    <select name="pais">
    <?php
    if (is_array($paises))
    {
        foreach ($paises as $p)
            echo '<option value="'.$p.'" selected>'.$p.'</OPTION>';
    }
    ?>
    </select>

    <br>
    <?php
        echo (isset($errores['pais'])) ? "$errores[pais] <br>" : "";
        ?>

    <br>

    Sinopsis: <br> 
    <textarea name="sinopsis" rows="4" cols="50" required><?= isset($sinopsis) ? $sinopsis : ""; ?></textarea>
    <br>
    <?php
        echo (isset($errores['sinopsis'])) ? "$errores[sinopsis] <br>" : "";
        ?>

    <br>

    Foto cartel: <input type="file" name="fotoCartel" value="<?= isset($fotoCartel) ? $fotoCartel : ""; ?>" required>
    <br>
    <?php
        echo (isset($errores['fotoCartel'])) ? "$errores[fotoCartel] <br>" : "";
        ?>

    <br>

    Foto reparto 1: <input type="file" name="fotoReparto_1" value="<?= isset($fotoReparto_1) ? $fotoReparto_1 : ""; ?>">
    <br>
    <br>

    Foto reparto 2: <input type="file" name="fotoReparto_2" value="<?= isset($fotoReparto_2) ? $fotoReparto_2 : ""; ?>">
    <br>
    <br>

    <input TYPE="submit" name="bAceptar" VALUE="aceptar">
</form>