<?php
//namespace Tester_vos_connaissances_avec_select\model\User;
class ManagerEvent
{

    protected static $instance; // Contiendra l'instance de notre classe.
    protected  static $db;
    protected function __construct() { } // Constructeur en privé.
    protected function __clone() { } // Méthode de clonage en privé aussi.
    public static function getInstanceEvent($db)
    {
        self::$db = $db;
        if (!isset(self::$instance)) // Si on n'a pas encore instancié notre classe.
        {
            self::$instance = new managerEvent($db); // On s'instancie nous-mêmes. :)
        }
        return self::$instance;
    }
    public function addEvent(Event $event)
    {
        $q = self::$db->prepare('INSERT INTO event(nameevent,date_begin,date_end,number_place,position) 
                                VALUES(:nameevent,:date_begin,:date_end,:number_place,:position)');

        $q->execute(array('nameevent'=>$event->getName(),
            'date_begin'=>$event->getDateBegin(),
            'date_end'=>$event->getDateEnd(),
            'number_place'=>$event->getNumberPlace(),
            'position'=>$event->getPosition(),
            ));
        $event->hydrate(['id' => self::$db->lastInsertId()]);
    }
    public function numberEventManager()
    {
        $q = self::$db->query('SELECT COUNT(*) FROM event');
        return $q->fetchColumn();
    }
    public function listEventManager(){
        $q = self::$db->query('SELECT * FROM event ORDER BY date_begin DESC');
        while($donnees = $q->fetch(PDO::FETCH_ASSOC)){
            $list_event[] = $donnees;
        }
        if(!isset($list_event)){
            return null ;
        }
        return $list_event;
    }
    public function selectEventById($id){
        $q = self::$db->prepare('SELECT * FROM event WHERE id = :id');
        $q->execute(['id' => $id]);
        return $q->fetchColumn();
    }
    public function deleteEventManager($id){
        $q = self::$db->prepare('DELETE FROM event WHERE id =:id');
        $q->execute(array('id'=>$id));

    }
    public function getEventbyManager($id)
    {
        $q = self::$db->prepare('SELECT * FROM event WHERE id = :id');
        $q->execute(['id' => $id]);
        return $q->fetch(PDO::FETCH_ASSOC);
    }
    public function updateEvent($event)
    {
        $q = self::$db->prepare('UPDATE event SET  nameevent=:nameevent,date_begin = :date_begin,date_end=:date_end
                        ,number_place = :number_place,	position = :position   WHERE id = :id ');
        $q->execute(array('nameevent'=>$event->getName(),
            'date_begin'=>$event->getDateBegin(),
            'date_end'=>$event->getDateEnd(),
            'number_place'=>$event->getNumberPlace(),
            'position'=>$event->getPosition(),
            'id'=>$event->getId(),
        ));
    }
    public function listForThreeEventManager()
    {
        $q = self::$db->query('SELECT * FROM event ORDER BY date_begin DESC LIMIT 3');
        while($donnees = $q->fetch(PDO::FETCH_ASSOC)){
            $list_event[] = $donnees;
        }
        if(!isset($list_event)){
            return null ;
        }
        return $list_event;
    }
    public function updateNumberParticipantManager($id_event,$number)
    {
        self::$db->query("UPDATE event SET  number_place ='$number'   WHERE id ='$id_event' ");
    }
    public function selectEventWithname($name){
        $q = self::$db->prepare('SELECT * FROM event  WHERE nameevent = :nameevent ');
        $q->execute(['nameevent' =>$name]);
        return $q->fetch(PDO::FETCH_ASSOC);
    }
}

