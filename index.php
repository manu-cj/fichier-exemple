<?php
?>


<form action="index.php" method="post" enctype="multipart/form-data">
    <label for="id-fichier"> choisissez un fichier</label><br>
    <input type="file" name="fichierUtilisateur" id="id-fichier"><br>
    <input type="submit" value="Send"><br>
</form>


<?php
/**
 * Réception sans sécurité
 */

if (isset($_FILES["fichierUtilisateur"])) {
    if ($_FILES['fichierUtilisateur']['error']===0) {
        $tmp_name = $_FILES['fichierUtilisateur']["tmp_name"];

        $name = $_FILES['fichierUtilisateur']["name"];

        move_uploaded_file($tmp_name, $name);
        foreach ($_FILES['fichierUtilisateur'] as $key => $value) {
            echo "$key => $value <br>";
        }
    }
    else {
        echo 'error';
    }
}

/**
 * Réception avec sécurité
 */

if (isset($_FILES["fichierUtilisateur"])) {
    $allowedMimeTypes = ['text/plain', 'image/jpeg', 'image/png'];
    if (in_array($_FILES['fichierUtilisateur']['type'], $allowedMimeTypes)) {
        if ($_FILES['fichierUtilisateur']['error']===0) {
            $tmp_name = $_FILES['fichierUtilisateur']["tmp_name"];

            $name = $_FILES['fichierUtilisateur']["name"];

            move_uploaded_file($tmp_name, $name);
            foreach ($_FILES['fichierUtilisateur'] as $key => $value) {
                echo "$key => $value <br>";
            }
        }
        else {
            echo 'error';
        }
    }
   else {
       echo 'le type du fichier n\'est pas autorisé';
   }
}

