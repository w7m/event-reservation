<?php
session_start();
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
        <?php $title = 'Ajouter évenement'; ?>
        <section class="container section-login-signup">
            <div class="col-lg-3 col-md-3"></div>
            <div class="col-lg-5 col-md-5 col-xs-12 col-sm-12 form-connection">
                <?php
                if(isset($_SESSION['erreur'])){
                    echo "<div class='modal fade' id='modal-infos' data-backdrop='false'>
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
                if(isset($_SESSION['eventnotupdate'])){
                    echo "<div class='modal fade' id='modal-infos' data-backdrop='false'>
                        <div class='modal-dialog'>
                            <div class='modal-content'>
                                <div class='modal-body'>
                                    <button type='button' class='close' data-dismiss='modal'>x</button>
                                    <h3 class='modal-title title-message-error'>",$_SESSION['eventnotupdate'],"</h3>
                                </div>
                            </div>
                        </div>
                    </div>";
                    unset($_SESSION['eventnotupdate']);
                }
                if(isset($_SESSION["event_exist"])){
                    echo "<div class='modal fade' id='modal-infos' data-backdrop='false'>
                        <div class='modal-dialog'>
                            <div class='modal-content'>
                                <div class='modal-body'>
                                    <button type='button' class='close' data-dismiss='modal'>x</button>
                                    <h3 class='modal-title title-message-error'>",$_SESSION["event_exist"],"</h3>
                                </div>
                            </div>
                        </div>
                    </div>";
                    unset($_SESSION["event_exist"]);
                }

                ?>
                <form action="../routeur/index.php" method="POST" id="form-registration-event" >
                    <legend>AJOUTER UN EVENEMENT :</legend>
                    <div class="form-group">
                        <label for="name">Nom de l'evévement : </label>
                        <input id="name" type="text" name="name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="date_begin">Date début  : </label>
                        <input id="date_begin" name="date_begin" type="datetime-local" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="date_end">Date fin  : </label>
                        <input id="date_end" name="date_end" type="datetime-local" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="number_place">Nombre des places : </label>
                        <input id="number_place" name="number_place" min="1" type="number" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="number_place">Position : </label>
                        <textarea name="position" id="position" class="form-control"></textarea>
                    </div>
                    <input class="button-connection" type="submit" value="AJOUTER" name="addevent">
                    <button class="button-connection" type="reset">RÉINITIALISER</button>

                </form>
            </div>
        </section>
        <?php $content = ob_get_clean(); ?>
        <?php require('template.php'); ?>



	