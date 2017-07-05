<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 08/04/17
 * Time: 12:02
 */
?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <title>Application config</title>
    <!-- HTML5 Shim -->
    <!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
</head>
<body>
<h1>Database</h1>

<form>
    <fieldset>

        <label for="range">Slider</label>
        <input type="range" name="range" />

        <label for="text">Host</label>
        <input type="text" name="host" id="text">

        <label for="text">Database name</label>
        <input type="text" name="dbname" id="text">

        <label for="text">User</label>
        <input type="text" name="user" id="text">

        <label for="text">Password</label>
        <input type="text" name="pswd" id="text">


        <label for="url">Champ d'Url</label>
        <input type="url" id="url" name="url">

        <label for="email">Champ Email</label>
        <input type="email" id="email" name="email">

        <label for="numeric">Format numerique</label>
        <input type="number" name="numeric" id="numeric">

        <label for="date">Format date</label>
        <input type="date" name="date" id="date">

        <label for="color-picker">Choix de la couleur</label>
        <input type="color" name="color-picker" id="color-picker">

        <button type="submit" class="boutonSubmit" role="button" aria-disabled="false">
            Soumettre le formulaire
        </button></p>

    </fieldset>
</form>

<footer>
    <p>Copyright - <a href="http://www.41mag.fr">41Mag</a></p>
</footer>

</body>
</html>
