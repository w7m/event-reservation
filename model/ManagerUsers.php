<?php
//namespace Tester_vos_connaissances_avec_select\model\User;
class ManagerUsers
{

    protected static $instance; // Contiendra l'instance de notre classe.
    protected  static $db;
    protected function __construct() { } // Constructeur en privé.
    protected function __clone() { } // Méthode de clonage en privé aussi.
    public static function getInstanceUsers($db)
    {
        self::$db = $db;
        if (!isset(self::$instance)) // Si on n'a pas encore instancié notre classe.
        {
            self::$instance = new managerUsers($db); // On s'instancie nous-mêmes. :)
        }
        return self::$instance;
    }
    public function selectUserWithPseudoAndEmail($user){
        $q = self::$db->prepare('SELECT * FROM users WHERE pseudo = :pseudo OR email= :email');
        $q->execute(['pseudo' => $user->getPseudo(),
                     'email'=>$user->getEmail()]);
        return $q->fetchColumn();
    }
    public function selectUserWithpseudopassword(User $user){
        $q = self::$db->prepare('SELECT * FROM users WHERE pseudo = :pseudo AND password =:password');
        $q->execute(['pseudo' => $user->getPseudo(),'password'=>$user->getPassword()]);
        return $q->fetch(PDO::FETCH_ASSOC);
    }
    public function selectUser(User $user){
        $q = self::$db->prepare('SELECT * FROM users WHERE pseudo = :pseudo AND password =:password');
        $q->execute(['pseudo' => $user->getPseudo(),'password'=>$user->getPassword()]);
        return $q->fetch(PDO::FETCH_ASSOC);
    }
    public function selectUserById($id){
        $q = self::$db->prepare('SELECT * FROM users WHERE id = :id');
        $q->execute(['id' => $id]);
        return $q->fetchColumn();
    }
    public function listUserManager(){
        $q = self::$db->query('SELECT * FROM users ORDER BY name1,date_registration DESC');
        while($donnees = $q->fetch(PDO::FETCH_ASSOC)){
            $list_user[] = $donnees;
        }
        if (!isset($list_user)){
            return null;
        }
        return $list_user;
    }
    public function deleteUserManager($id){
        $q = self::$db->prepare('DELETE FROM users WHERE id =:id');
        $q->execute(array('id'=>$id));

    }
    public function addUser(User $user)
    {

        $q = self::$db->prepare('INSERT INTO users(pseudo,name1,first_name,date_birth,email,password,termsconditions,phone,date_registration,enabled,role,confirmation_token,date_add_confirmation_token) 
                                VALUES(:pseudo,:name1,:first_name,:date_birth,:email,:password,:termsconditions,:phone,:date_registration,:enabled,:role,:confirmation_token,:date_add_confirmation_token)');

        $q->execute(array('pseudo'=>$user->getPseudo(),
            'name1'=>$user->getname1(),
            'first_name'=>$user->getFirst_name(),
            'date_birth'=>$user->getDate_birth(),
            'email'=>$user->getEmail(),
            'password'=>$user->getPassword(),
            'termsconditions'=>$user->getTermsCondition(),
            'phone'=>$user->getPhone(),
            'date_registration'=>$user->getDate_registration(),
            'enabled'=>$user->getEnabled(),
            'confirmation_token'=>$user->getToken(),
            'date_add_confirmation_token'=>$user->getDateAddToken(),
            'role'=>$user->getRole()));
        $user->hydrate(['id' => self::$db->lastInsertId()]);
    }
    public function getUserbyManager($id)
    {
        $q = self::$db->prepare('SELECT * FROM users WHERE id = :id');
        $q->execute(['id' => $id]);
        return $q->fetch(PDO::FETCH_ASSOC);
    }
    public function updateUser($user)
    {
        $q = self::$db->prepare('UPDATE users SET  pseudo=:pseudo,name1 = :name1,first_name = :first_name,date_birth = :date_birth
                        ,email = :email,password = :password,phone = :phone,date_registration = :date_registration,enabled= :enabled,role= :role  WHERE id = :id ');
        $q->execute(array(
            'pseudo'=>$user->getPseudo(),
            'name1'=>$user->getName1(),
            'first_name'=>$user->getFirst_name(),
            'date_birth'=>$user->getDate_birth(),
            'email'=>$user->getEmail(),
            'password'=>$user->getPassword(),
            'phone'=>$user->getPhone(),
            'date_registration'=>date('Y-m-d H:i:s'),
            'id'=>$user->getId(),
            'enabled'=>$user->getEnabled(),
            'role'=>$user->getRole()));
        $user->hydrate(['date_registration' => date('Y-m-d H:i:s')]);
    }
    public function updateMyAcount($user)
    {
        $q = self::$db->prepare('UPDATE users SET  pseudo=:pseudo,name1 = :name1,first_name = :first_name,date_birth = :date_birth
                        ,email = :email,password = :password,phone = :phone,date_registration = :date_registration  WHERE id = :id ');
        $q->execute(array(
            'pseudo'=>$user->getPseudo(),
            'name1'=>$user->getName1(),
            'first_name'=>$user->getFirst_name(),
            'date_birth'=>$user->getDate_birth(),
            'email'=>$user->getEmail(),
            'password'=>$user->getPassword(),
            'phone'=>$user->getPhone(),
            'date_registration'=>date('Y-m-d H:i:s'),
            'id'=>$user->getId()));
        $user->hydrate(['date_registration' => date('Y-m-d H:i:s')]);
    }
    public function updateTokenForgetPassword($token,$email)
    {
        $q = self::$db->prepare('UPDATE users SET confirmation_token=:token  WHERE email = :email');
        $q->execute(array(
            'token'=>$token,
            'email'=>$email));

    }
    public function changePassword($token,$password)
    {
        $q = self::$db->prepare('UPDATE users SET password=:password  WHERE confirmation_token = :token');
        $q->execute(array(
            'password'=>$password,
            'token'=>$token));
    }
    public function selectUserWithEmail($email)
    {
        $q = self::$db->prepare('SELECT * FROM users WHERE email = :email');
        $q->execute(['email' => $email]);
        return $q->fetch(PDO::FETCH_ASSOC);
    }
    public function numberUserManager()
    {
        $q = self::$db->query('SELECT COUNT(*) FROM users');
        return $q->fetchColumn();
    }
    public function updateAccountEnableManager($id,$token)
    {
        self::$db->query("UPDATE users SET  enabled='1'  WHERE id = '$id' AND confirmation_token = '$token' ");
    }
}

