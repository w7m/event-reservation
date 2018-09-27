<?php
session_start();
include_once '../control/controllerUsers.php';
if (isset($_SESSION['login'])) {
    $role = "admin";
    if ($_SESSION['login']['role'] == $role) {
        true;
    } else
        header('Location: ../vue/index.php');
}
else
    header('Location: ../vue/index.php');
?>
<?php ob_start(); ?>
<?php $title = 'INSCRIPTION'; ?>
<section class="container section-login-signup">
    <div class="col-lg-3 col-md-3"></div>
    <div class="col-lg-5 col-md-5 col-xs-12 col-sm-12 form-connection">
        <?php
        if (isset($_GET['update'])){
            $user = updateUserController($_GET['update']) ;
        }

        ?>
        <form action="../routeur/index.php" method="POST" id="form-registration" >
            <legend>Mise à jour  utilisateur : id = <?php echo $user["id"] ?></legend>
            <input id="id" type="hidden" name="id" class="form-control" value=<?php echo $user["id"] ?> >
            <div class="form-group">
                <label for="name1">Nom : </label>
                <input id="name1" type="text" name="name1" class="form-control" value=<?= "\"",$user["name1"],"\"" ?> >
            </div>
            <div class="form-group">
                <label for="first-name">Prénom : </label>
                <input id="firts-name" type="text" name="first-name" class="form-control" value=<?= "\"",$user["first_name"],"\"" ?>  >
            </div>
            <div class="form-group">
                <label for="date_birth">Date de naissance  : </label>
                <input id="date_birth" name="date_birth" type="date" class="form-control" value=<?= $user['date_birth'] ?> >
            </div>
            <div class="form-group">
                <label for="Pseudo">Pseudo : </label>
                <input id="pseudo" name="pseudo" type="text" class="form-control" value=<?= $user['pseudo'] ?> >
            </div>
            <div class="form-group">
                <label for="email">Email : </label>
                <input id="email" name="email" type="text" class="form-control" value=<?= $user['email'] ?> >
            </div>
            <div class="form-group">
                <label for="phone">Numéros téléphone : </label>
                <input id="phone" name="phone" type="tel" class="form-control" value=<?= $user['phone'] ?> >
            </div>
            <div class="form-group">
                <label for="password">Mot de passe : </label>
                <input id="password" name="password" type="password" class="form-control"  >
            </div>
            <div class="form-group">
                <label for="password-confirmation">Confirmer votre mot de passe : </label>
                <input id="password-confirmation"  type="password" class="form-control" >
            </div>
            <div class="form-group">
                <label for="enabled">Type utilisateur : </label>
                <select name="enabled" class="form-control">
                    <option value="1" selected>disponible</option>
                    <option value="0">Non disponible</option>
                </select>
            </div>
            <div class="form-group">
                <label for="type">Type utilisateur : </label>
                <select name="role" class="form-control">
                    <option value="admin">Admin</option>
                    <option value="user" selected>User</option>
                </select>
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="terms-and-conditions" value="1" name="terms-and-conditions">
                <label class="form-check-label" for="terms-and-conditions">J'accepte les <a href="#" style="color:#2c8300;">Termes et conditions</a></label>
            </div>
            <input class="button-connection" type="submit" value="MODIFER" name="updateuser">
            <button class="button-connection" type="reset">RÉINITIALISER</button>

        </form>
        <p class="text-center" style="margin-top:15px;">VOUS avez déjà un compte ?<a href="member_area_login_page.html" style="color:#2c8300;"> Connectez-vous</a>
        </p>
    </div>
</section>
<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>



