<?php
session_start();
include_once '../control/controllerEvent.php';
include_once '../control/controllerParticipation.php';
?>
<?php ob_start(); ?>
<title><?= $title='PARTICIPEZ' ?></title>
<section class="container list-users">
    <?php
    if (isset($_SESSION['participuserevent'])){
        echo "<div class='modal fade' id='modal-infos' data-backdrop='false'>
            <div class='modal-dialog'>
                <div class='modal-content'>
                    <div class='modal-body'>
                        <button type='button' class='close' data-dismiss='modal'>x</button>
                        <h3 class='modal-title title-message-error'>",$_SESSION['participuserevent'],"</h3>
                    </div>
                </div>
            </div>
        </div>";
        unset($_SESSION['participuserevent']);
    }
    ?>
    <table class="table table-bordered table-striped table-condensed table-responsive">
        <caption>
            <h2>PARTICIPEZ À UN ÉVÉNEMENT :</h2>
        </caption>
        <thead>
        <tr>
            <th>nom</th>
            <th>Date début</th>
            <th>Date fin</th>
            <th>position</th>
            <th>Participation</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $list = listEventController();
        if ($list !=null){
            foreach ( $list as $value){
                $id = $value['id'];
                echo "<tr>";
                echo "<td>",$value['nameevent'],"</td>";
                echo "<td>",$value['date_begin'],"</td>";
                echo "<td>",$value['date_end'],"</td>";
                echo "<td>",$value['position'],"</td>";
                if (isset($_SESSION['login'])){
                    $iduser = $_SESSION['login']['id'];
                    $userparticip = userParticipControl($id,$iduser);
                    if($userparticip==false){
                        if ($value['number_place']>0){
                            echo "<td><a href='../routeur/index.php?part=",$id,"'>Participer</a></td>";
                        }else{
                            echo "<td>Pas de place disponible</td>";
                        }
                    }else{
                        echo "<td>Participé </td>";
                    }
                }else{
                    echo "<td><a href='../routeur/index.php?part=",$id,"'>Participer</a></td>";
                }
                echo "</tr>";
            }
        }
        ?>
        </tbody>
    </table>
</section>

<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>