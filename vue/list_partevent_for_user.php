<?php
session_start();
    include_once '../control/controllerParticipation.php';
include_once '../control/controllerEvent.php';
if (isset($_SESSION['login'])) {
    true;
}
else
header('Location: ../vue/index.php');
?>
<?php ob_start(); ?>
<?php $title = "Liste des participations" ?>
    <section class="container list-users">
        <?php
        if (isset($_SESSION['deleteparticicp'])){
            echo "<div class='modal fade' id='modal-infos' data-backdrop='false'>
                <div class='modal-dialog'>
                    <div class='modal-content'>
                        <div class='modal-body'>
                            <button type='button' class='close' data-dismiss='modal'>x</button>
                            <h3 class='modal-title title-message-error'>",$_SESSION['deleteparticicp'],"</h3>
                        </div>
                    </div>
                </div>
            </div>";
            unset($_SESSION['deleteparticicp']);
        }
        if (isset($_SESSION['error'])){
            echo "<div class='modal fade' id='modal-infos' data-backdrop='false'>
                <div class='modal-dialog'>
                    <div class='modal-content'>
                        <div class='modal-body'>
                            <button type='button' class='close' data-dismiss='modal'>x</button>
                            <h3 class='modal-title title-message-error'>",$_SESSION['error'],"</h3>
                        </div>
                    </div>
                </div>
            </div>";
            unset($_SESSION['error']);
        }
        ?>
        <table class="table table-bordered table-striped table-condensed table-responsive">
            <caption>
                <h2>Liste des participations :</h2>
            </caption>
            <thead>
            <tr>
                <th>Nom évenement</th>
                <th>Date début</th>
                <th>Date fin</th>
                <th>Position</th>
                <th>État</th>
                <th>Supprimer</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $id_user = $_SESSION['login']['id'];
            $list = listPartEventControllerbyid($id_user);
            if ($list !=null){
                foreach ( $list as $value){
                    $id_event = $value['id_event'];
                    $event = getEventbyid($id_event);
                    echo "<tr>";
                    echo "<td>",$event['nameevent'],"</td>";
                    echo "<td>",$event['date_begin'],"</td>";
                    echo "<td>",$event['date_end'],"</td>";
                    echo "<td>",$event['position'],"</td>";
                    echo "<td>",$value['confirmation'],"</td>";
                    echo "<td><a href='../routeur/index.php?deleteparteventiduser=",$id_event,"&deletepartusersiduser=",$id_user,"'><i class='glyphicon glyphicon-trash'></i></a></td>";
                    echo "</tr>";
                }
            }
            ?>
            </tbody>
        </table>
    </section>

<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>



