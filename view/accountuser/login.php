<?php
?>
<?php $title = 'Connexion'; ?>

<?php ob_start(); ?>

<div class="wrapper fadeInDown">
<div class="formContent">
    <!-- Tabs Titles -->

    <!-- Icon -->
    <div class="fadeIn first">
        <h2>Authentification</h2>
    </div>

    <!-- Login Form -->
    <form action="http://localhost/MVC_project/index.php?action=login" method='post'>
        <input type="text" id="login" class="fadeIn second" name="login" placeholder="pseudo">
        <input type="password" id="password" class="fadeIn third" name="password" placeholder="mot de passe">
        <input type="submit" class="fadeIn fourth" value="Se connecter">
    </form>

    <!-- Remind Passowrd -->
    <div class="formFooter">
        <a class="underlineHover" href="register.php">S'enregistrer</a>
    </div>

</div>
</div>
<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>
