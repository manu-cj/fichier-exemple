<?php
/**
 * Génère un nom de fichier aléatoire (peut être utile en cas d'utilisateur malveillant
 * pour qu'il ne retrouve pas son fichier upload)
 * @param string $regularName
 * @return string
 */

function getRandomName(string $regularName) {
    $infos = pathinfo($regularName);
    try {
        $bytes = random_bytes(15);
    }
    catch (Exception $e) {
        $bytes = openssl_random_pseudo_bytes(15);
    }
    return bin2hex($bytes) . '.' . $infos['extension'];
}
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
        echo '<p class="success">upload réussi ! </p><br><br>';
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

            $name = getRandomName($_FILES['fichierUtilisateur']["name"]);

            move_uploaded_file($tmp_name, $name);

            echo '<p class="success">upload réussi !</p><br>';
            echo $name . '<br>';
            foreach ($_FILES['fichierUtilisateur'] as $key => $value) {
                echo "$key => $value <br><br>";
            }
        }
        else {
            echo '<p>Une erreur s\'est produite lors de l\'upload du fichier!</p>' ;
        }
    }
   else {
       echo '<br><p>le type du fichier n\'est pas autorisé !</p><style> p { color: red;
}
.success {
color: limegreen;
}</style>';
   }
}