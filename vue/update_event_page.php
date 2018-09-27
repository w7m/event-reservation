<?php
session_start();
include_once '../control/controllerEvent.php';
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
                if(isset($_SESSION["event_exist"])){
                    echo "<h3 class='erreur'>",$_SESSION["event_exist"],"</h3>";
                    unset($_SESSION["event_exist"]);
                }
                ?>
                <?php
                if (isset($_GET['updateevent'])){
                    $vent = updateEventController($_GET['updateevent']) ;
                }

                ?>
                <form action="../routeur/index.php" method="POST" id="form-registration-event" >
                    <legend>MODIFIER L'EVENEMENT :<b> <?= $vent['nameevent'] ?> </b></legend>
                        <input id="id" type="hidden" name="id" class="form-control" value=<?php echo $vent["id"] ?> >
                        <input id="name" type="hidden" name="name" class="form-control" value=<?php echo "\"" ,$vent['nameevent'], "\"";  ?> >
                    <div class="form-group">
                        <label for="date_begin">Date début  : </label>
                        <input id="date_begin" name="date_begin" type="datetime-local" class="form-control" value=<?php echo "\"" ,substr($vent["date_begin"],0,10)."T".substr($vent["date_begin"],11,-3), "\"" ; ?> >
                    </div>
                    <div class="form-group">
                        <label for="date_end">Date fin  : </label>
                        <input id="date_end" name="date_end" type="datetime-local" class="form-control" value=<?php echo "\"",substr($vent["date_end"],0,10)."T".substr($vent["date_end"],11,-3), "\"" ; ?> >
                    </div>
                    <div class="form-group">
                        <label for="number_place">Nombre des places : </label>
                        <input id="number_place" name="number_place" type="number" class="form-control" min="1" value=<?php echo $vent["number_place"]; ?> >
                    </div>
                    <div class="form-group">
                        <label for="number_place">Position : </label>
                        <textarea name="position" id="position" class="form-control"><?php echo $vent["position"]; ?></textarea>
                    </div>
                    <input class="button-connection" type="submit" value="MODIFIER" name="updateevent">
                    <button class="button-connection" type="reset">RÉINITIALISER</button>

                </form>
            </div>
        </section>
        <?php $content = ob_get_clean(); ?>
        <?php require('template.php'); ?>



	