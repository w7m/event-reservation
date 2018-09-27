<?php
function my_autoloaderforevent($class)
{
    include '../model/' . $class . '.php';
}
spl_autoload_register('my_autoloaderforevent');
//use Tester_vos_connaissances_avec_select\model\User as User;
//use Tester_vos_connaissances_avec_select\model\Manager as Manager;
function connectbdEvent()
{
    try {
        $db = new PDO('mysql:host=localhost;dbname=select_test;charset=utf8', 'root', '');
        //echo 'Connexion réussie !';
    } catch (PDOException $e) {
        echo 'La connexion a échoué.<br />';
        echo 'Informations : [', $e->getCode(), '] ', $e->getMessage();
    }

    return  ManagerEvent::getInstanceEvent($db);
}

function addevent()
{
    $manager = connectbdEvent();
    $error = true;

    $name=$_POST["name"]??$error = false;
    $date_begin=$_POST["date_begin"]??$error = false;
    $date_end=$_POST["date_end"]??$error = false;
    $number_place=$_POST["number_place"]??$error = false;
    $position=$_POST["position"]??$error = false;

    if ($error == false){
        $_SESSION["erreur"] = "Verifier vos coordonnées ";
        return header('Location: ../vue/member_area_registration_page.php');
    }
    if ( $name=="" || $date_begin=="" || $date_end=="" || $number_place=="" || $position=="" ){
        $_SESSION["erreur"] = "Verifier vos coordonnées ";
        return header('Location: ../vue/list_users.php');
    }
    $event = new Event([
        'name' => $name,
        'datebegin' => $date_begin,
        'dateend' => $date_end,
        'numberplace' => $number_place,
        'position' => $position,
    ]);
    $event_search = $manager->selectEventWithname($name);
    if ($event_search == false) {
        $datebegin = new DateTime($date_begin);
        $dateend = new DateTime($date_end);
        if ($dateend > $datebegin) {
            $manager->addEvent($event);
            $_SESSION['add-event-succ']="Evenement ajouté avec succés";
            header('Location: ../vue/list_event.php');
        } else {
            $_SESSION["eventnotupdate"] = "Vérifier les dates";
            header('Location: ../vue/addevent_page.php');
        }
    } else {
        $_SESSION["event_exist"] = "évenement exist ! ";
        header('Location: ../vue/addevent_page.php');
    }
}
function numberevent()
{
    $manager = connectbdEvent();
    return $manager->numberEventManager();
}
function listEventController()
{
    $manager = connectbdEvent();
    return $manager->listEventManager();
}
function deleteEventController($id)
{
    $manager = connectbdEvent();
    $event_searchbyid = $manager->selectEventById($id);
    if ($event_searchbyid == true) {
        $manager->deleteEventManager($id);
        //$manager->deleteparticipationevent($id);
        $_SESSION["event_delete"] = "Evenement supprimé avec succés ! ";
        header('Location: ../vue/list_event.php');
    } else
        $_SESSION["event-undefined"] = "Evenement n'exist pas ! ";
        header('Location: ../vue/list_event.php');
}
function updateEventController($id)
{
    $manager = connectbdEvent();
    $event_searchbyid = $manager->selectEventById($id);
    if ($event_searchbyid == true) {
        return $manager->getEventbyManager($id);
    } else
        $_SESSION["event-undefined"] = "Evenement n'exist pas ! ";
        header('Location: ../vue/list_event.php');
}
function updateevent()
{
    $manager = connectbdEvent();
    $error = true;
    $id=$_POST["id"]??$error = false;
    $name=$_POST["name"]??$error = false;
    $date_begin=$_POST["date_begin"]??$error = false;
    $date_end=$_POST["date_end"]??$error = false;
    $number_place=$_POST["number_place"]??$error = false;
    $position=$_POST["position"]??$error = false;
    if ($error == false){
        $_SESSION["erreur"] = "Verifier vos coordonnées ";
        header('Location: ../vue/list_event.php');
    }

    if ($id=="" || $name=="" || $date_begin=="" || $date_end=="" || $number_place=="" || $position=="" ){
        $_SESSION["erreur"] = "Verifier vos coordonnées ";
        header('Location: ../vue/list_users.php');
    }

    $event = new Event([
        'id' => $id,
        'name' => $name,
        'datebegin' => $date_begin,
        'dateend' => $date_end,
        'numberplace' => $number_place,
        'position' => $position,
    ]);
    $event_search = $manager->selectEventWithname($name);
    if ($event_search == true) {
        $datebegin = new DateTime($date_begin);
        $dateend = new DateTime($date_end);
        if ($dateend > $datebegin) {
            $manager->updateEvent($event);
            $_SESSION["eventupdate"] = "Evenement a bien été modifié ";
            header('Location: ../vue/list_event.php');
        } else {
            $_SESSION["eventnotupdate"] = "Vérifier les dates";
            header('Location: ../vue/list_event.php');
        }
    } else {
        $_SESSION["event-undefined"] = "Evenement n'exist pas ! ";
        header('Location: ../vue/list_event.php');
    }
}
function listForThreeEventController()
{
    $manager = connectbdEvent();
    return $manager->listForThreeEventManager();
}
function getEventbyid($id_event)
{
    $manager = connectbdEvent();
    $id = $id_event;
    return $manager->getEventbyManager($id);
}
