<?php
?>


<form action="index.php" method="post" enctype="multipart/form-data">
    <label for="id-fichier"> choisissez un fichier</label><br>
    <input type="file" name="fichierUtilisateur" id="id-fichier"><br>
    <input type="submit" value="Send"><br>
</form>


<?php
foreach ($_FILES['fichierUtilisateur'] as $key => $value) {
    echo "$key => $value <br>";
}

if (isset($_FILES["fichierUtilisateur"])) {
    $tmp_name = $_FILES['fichierUtilisateur']["tmp_name"];

    $name = $_FILES['fichierUtilisateur']["name"];

    move_uploaded_file($tmp_name, $name);
}