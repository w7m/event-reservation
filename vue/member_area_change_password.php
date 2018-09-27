<?php
session_start();
if (isset($_SESSION['login'])) {
    header('Location: ../vue/index.php');
}else{
    true;
}
?>
        <?php ob_start(); ?>
        <?php $title = 'INSCRIPTION'; ?>
        <?php
        if(isset($_SESSION['erreur'])){
            echo "<div class='modal fade' id='modal-infos'data-backdrop='false'>
                        <div class='modal-dialog'>
                            <div class='modal-content'>
                                <div class='modal-body'>
                                    <button type='button' class='close' data-dismiss='modal'>x</button>
                                    <h3 class='modal-title title-message-error'>",$_SESSION['erreur'],"</h3>
                                </div>
                            </div>
                        </div>
                    </div>";
            unset($_SESSION['erreur']);
        }
        ?>
        <section class="container section-login-signup">

            <div class="col-lg-3 col-md-3"></div>
            <div class="col-lg-5 col-md-5 col-xs-12 col-sm-12 form-connection">
                <form action="../routeur/index.php" method="POST" id="form-registration" >
                    <legend>Changer votre mot de passe :</legend>
                    <input type="hidden" name="token" value=<?php echo $_GET['token'] ?> />
                    <div class="form-group">
                        <label for="password">Nouveau mot de passe : </label>
                        <input id="password" name="password" type="password" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="password-confirmation">Confirmer nouveau mot de passe : </label>
                        <input id="password-confirmation"  type="password" class="form-control">
                    </div>
                    <input class="button-connection" type="submit" value="MODIFIER" name="updatemotdepasse">
                    <button class="button-connection" type="reset">RÉINITIALISER</button>
                </form>
            </div>
        </section>
        <?php $content = ob_get_clean(); ?>
        <?php require('template.php'); ?>


	