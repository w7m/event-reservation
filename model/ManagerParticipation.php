<?php
//namespace Tester_vos_connaissances_avec_select\model\User;
class ManagerParticipation
{

    protected static $instance; // Contiendra l'instance de notre classe.
    protected  static $db;
    protected function __construct() { } // Constructeur en privé.
    protected function __clone() { } // Méthode de clonage en privé aussi.
    public static function getInstanceParticipation($db)
    {
        self::$db = $db;
        if (!isset(self::$instance)) // Si on n'a pas encore instancié notre classe.
        {
            self::$instance = new managerParticipation($db); // On s'instancie nous-mêmes. :)
        }
        return self::$instance;
    }
    public function addPartUserInEventManager($id_event,$id_user)
    {
        $q = self::$db->prepare('INSERT INTO participation (id_event,id_user,confirmation) 
                                VALUES(:id_event,:id_user,:confirmation)');
        $q->execute(array('id_event'=>$id_event,
            'id_user'=>$id_user,
            'confirmation'=>"Non confirmer"
        ));
    }
    public function listPartEventManager()
    {
        $q = self::$db->query('SELECT * FROM participation');
        while($donnees = $q->fetch(PDO::FETCH_ASSOC)){
            $list_event_part[] = $donnees;
        }
        if(!isset($list_event_part)){
            return null ;
        }
        return $list_event_part;
    }
    public function updateparteventManager($id_event,$id_user)
    {
        $q = self::$db->prepare('UPDATE participation SET confirmation=:confirmation   WHERE id_event = :id_event AND id_user = :id_user ');
        $q->execute(array('confirmation'=>"Confirmer",
            'id_event'=>$id_event,
            'id_user'=>$id_user,
        ));
    }
    public function updatePartEventForNonConfirmeManager($id_event,$id_user)
    {
        $q = self::$db->prepare('UPDATE participation SET confirmation=:confirmation   WHERE id_event = :id_event AND id_user = :id_user ');
        $q->execute(array('confirmation'=>"Non confirmer",
            'id_event'=>$id_event,
            'id_user'=>$id_user,
        ));
    }
    public function updateNumberParticipantManager($id_event,$number)
    {
        self::$db->query("UPDATE event SET  number_place ='$number'   WHERE id ='$id_event' ");
    }
    public function listPartEventByIDManager($id_user)
    {
        $q = self::$db->query("SELECT * FROM participation WHERE id_user = $id_user ");
        while($donnees = $q->fetch(PDO::FETCH_ASSOC)){
            $list_event_part[] = $donnees;
        }
        if(!isset($list_event_part)){
            return null ;
        }
        return $list_event_part;
    }
    public function userPartEventByIDManager($id,$iduser)
    {
        $q = self::$db->query("SELECT * FROM participation WHERE id_user = $iduser AND id_event = $id ");
        return   $q->fetch(PDO::FETCH_ASSOC);
    }
    public function deleteparticipationevent($id)
    {
        $q = self::$db->prepare('DELETE FROM participation WHERE id_event =:id');
        $q->execute(array('id'=>$id));
    }
    public function deleteparticipationuser($id)
    {
        $q = self::$db->prepare('DELETE FROM participation WHERE id_user =:id');
        $q->execute(array('id'=>$id));
    }
    public function deletePartEventForUser($id_user,$id_event)
    {
        $q = self::$db->prepare('DELETE FROM participation WHERE id_event =:id_event AND id_user=:id_user');
        $q->execute(array('id_event'=>$id_event,
                          'id_user'=>$id_user));
    }
    public function partUserByIdEventIdUser($id_event,$id_user)
    {
        $q = self::$db->query("SELECT * FROM participation WHERE id_user = $id_user AND id_event = $id_event");
        return $q->fetch(PDO::FETCH_ASSOC);
    }
    public function getEventbyManager($id)
    {
        $q = self::$db->prepare('SELECT * FROM event WHERE id = :id');
        $q->execute(['id' => $id]);
        return $q->fetch(PDO::FETCH_ASSOC);
    }
    public function getUserbyManager($id)
    {
        $q = self::$db->prepare('SELECT * FROM users WHERE id = :id');
        $q->execute(['id' => $id]);
        return $q->fetch(PDO::FETCH_ASSOC);
    }
}

