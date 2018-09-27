<?php
function my_autoloaderforparticipation($class)
{
    include '../model/' . $class . '.php';
}
spl_autoload_register('my_autoloaderforparticipation');
//use Tester_vos_connaissances_avec_select\model\User as User;
//use Tester_vos_connaissances_avec_select\model\Manager as Manager;
function connectbdParticipation()
{
    try {
        $db = new PDO('mysql:host=localhost;dbname=select_test;charset=utf8', 'root', '');
        //echo 'Connexion réussie !';
    } catch (PDOException $e) {
        echo 'La connexion a échoué.<br />';
        echo 'Informations : [', $e->getCode(), '] ', $e->getMessage();
    }

    return  ManagerParticipation::getInstanceParticipation($db);


}
function userParticipControl($id,$iduser){
    $manager = connectbdParticipation();
    return $manager->userPartEventByIDManager($id,$iduser);
}
function partUserInEvent($id_event, $id_user)
{
    $manager = connectbdParticipation();
    $manager->addPartUserInEventManager($id_event, $id_user);
    $_SESSION['participuserevent']="Participation ajoutée  avec succés";
    header('Location: ../vue/participer_event.php');
}
function listPartEventController()
{
    $manager = connectbdParticipation();
    return $manager->listPartEventManager();
}
function updatepartevent($id_event, $id_user)
{
    $manager = connectbdParticipation();
    $id = $id_event;
    $event = $manager->getEventbyManager($id);
    $number = $event['number_place'];
    if ($number > 0) {
        $manager->updateparteventManager($id_event, $id_user);
        $number = $event['number_place'] - 1;
        $manager->updateNumberParticipantManager($id_event, $number);
        $user = $manager->getUserbyManager($id_user);
        $to = $user['email'];
        $subject = "Confirmation de participation";
        $headers = 'From: mhdwhm88@gmail.com' . "\r\n" .
            'Reply-To: mhdwhm88@gmail.com' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
        $message ="<html>
                      <head>
                        <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>
                        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
                        <meta charset='UTF-8'>
                      <style>
                        .div-message-email{
                          margin-top:20px;
                          background-image: url('https://i.imgur.com/Sk6wIxM.jpg');
                          height: 200px;
                          margin-bottom: 30px;
                        }
                        .title{
                          padding-top: 10%;
                          color: #ee0303;
                          font-weight: bold;
                          text-align: center;
                        }
                        .nameevent{
                          color: #1dd800;
                        }
                      </style>
                      <body>
                        <div class='container'>
                          <div class='col-lg-offset-3 col-lg-5 col-md-offset-3 col-md-6 col-xs-12 col-sm-12 div-message-email'><h1 class='title'>Confirmation de participation</h1></div>
                          <h4>Bonjuor ".$user['name1'].".</h4>
                          <h3>votre participation  à l'événement <span class='nameevent'>".$event['nameevent']."</span> est confirmé qui aura lieu le ".$event['date_begin']." à ".$event['position'].".</h3>
                        </div>
                      </body>
                    </html>";
        mail($to,$subject,$message,$headers);
        $_SESSION["confirmationpartuser"] = "Confirmation participation à  l'événement est éffectué avec succé, E-mail de confirmation a été envoyé au utilisateur.";
        header('Location: ../vue/list_partevent.php');
    } else {
        $_SESSION['numberplacelower']="Pas de place disponible";
        header('Location: ../vue/list_partevent.php');
    }
}
function deletepartevent($id_event, $id_user)
{
    $manager = connectbdParticipation();
    $manager->updatePartEventForNonConfirmeManager($id_event, $id_user);
    $id = $id_event;
    $event = $manager->getEventbyManager($id);
    $number = $event['number_place'] + 1;
    $manager->updateNumberParticipantManager($id_event, $number);
    $user = $manager->getUserbyManager($id_user);
    $to = $user['email'];
    $subject = "Confirmation de participation";
    $headers = 'From: mhdwhm88@gmail.com' . "\r\n" .
        'Reply-To: mhdwhm88@gmail.com' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
    $message ="<html>
                      <head>
                        <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>
                        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
                        <meta charset='UTF-8'>
                      <style>
                        .div-message-email{
                          margin-top:20px;
                          background-image: url('http://localhost/gomycode/poo-pdo/vue/css_js/evenement.jpg');
                          height: 200px;
                          margin-bottom: 30px;
                        }
                        .title{
                          padding-top: 10%;
                          color: #ee0303;
                          font-weight: bold;
                          text-align: center;
                        }
                        .nameevent{
                          color: #1dd800;
                        }
                      </style>
                      <body>
                        <div class='container'>
                          <div class='col-lg-offset-3 col-lg-5 col-md-offset-3 col-md-6 col-xs-12 col-sm-12 div-message-email'><h1 class='title'>Supprission de participation</h1></div>
                          <h4>Bonjuor ".$user['name1'].".</h4>
                          <h3>votre participation au évenement <span class='nameevent'>".$event['nameevent']."</span> a été supprimée.</h3>
                        </div>
                      </body>
                    </html>";
    mail($to,$subject,$message,$headers);
    $_SESSION['deletenumberpart']="supprission participation au évenement est éffectué avec succé, E-mail de confirmation a été envoyé au utilisateur.";
    header('Location: ../vue/list_partevent.php');
}
function listPartEventControllerbyid($id_user)
{
    $manager = connectbdParticipation();
    return $manager->listPartEventByIDManager($id_user);
}
function deleteparteventforuser($id_event,$id_user){
    $manager = connectbdParticipation();
    $id = $_SESSION['login']['id'];
    if ($id_user==$id){
        $part = $manager->partUserByIdEventIdUser($id_event,$id_user);
        if ($part["confirmation"]=="Confirmer") {
            $id = $id_event;
            $event = $manager->getEventbyManager($id);
            $number = $event['number_place'] + 1;
            $manager->updateNumberParticipantManager($id_event, $number);
            $manager->deletePartEventForUser($id_user, $id_event);
            $_SESSION['deleteparticicp'] = "Participation supprimé avec succés";
            header('Location: ../vue/list_partevent_for_user.php');
        }else{
            $manager->deletePartEventForUser($id_user, $id_event);
            $_SESSION['deleteparticicp'] = "Participation supprimé avec succés";
            header('Location: ../vue/list_partevent_for_user.php');
        }
    }else{
        $_SESSION['error']="Vérifier vos coordonnée";
        header('Location: ../vue/list_partevent_for_user.php');
    }


}
function deleteparteventforadmin($id_event,$id_user){
    $manager = connectbdParticipation();

    if ($_SESSION['login']['role']=="admin"){
        $part = $manager->partUserByIdEventIdUser($id_event,$id_user);
        if ($part["confirmation"]=="Confirmer"){
            $id = $id_event;
            $event = $manager->getEventbyManager($id);
            $number = $event['number_place'] + 1;
            $manager->updateNumberParticipantManager($id_event, $number);
            $manager->deletePartEventForUser($id_user,$id_event);
            $_SESSION['deleteparticicp']="Participation supprimé avec succés";
            header('Location: ../vue/list_partevent.php');
        }else{
            $manager->deletePartEventForUser($id_user,$id_event);
            $_SESSION['deleteparticicp']="Participation supprimé avec succés";
            header('Location: ../vue/list_partevent.php');
        }
    }else{
        $_SESSION['error']="Vérifier vos coordonnée";
        header('Location: ../vue/list_partevent.php');
    }


}