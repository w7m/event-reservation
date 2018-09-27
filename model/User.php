<?php
//namespace Tester_vos_connaissances_avec_select\model\Manager;
class  User
{
	protected $id;
    protected $pseudo;
	protected $name1;
    protected $first_name;
	protected $date_birth;
	protected $email;
	protected $password;
	protected $phone;
	protected $date_registration;
	protected $enabled;
	protected $role;
	protected $token;
	protected $termsCondition;
	protected $dateAddToken;

    /**
     * @return mixed
     */
    public function getDateAddToken()
    {
        return $this->dateAddToken;
    }

    /**
     * @param mixed $dateAddToken
     */
    public function setDateAddToken($dateAddToken)
    {
        $this->dateAddToken = $dateAddToken;
    }

    /**
     * @return mixed
     */
    public function getTermsCondition()
    {
        return $this->termsCondition;
    }

    /**
     * @param mixed $termsCondition
     */
    public function setTermsCondition($termsCondition)
    {
        $this->termsCondition = $termsCondition;
    }

    public function getToken()
    {
        return $this->token;
    }
    public function setToken($token)
    {
        $this->token = $token;
    }
	public function __construct(array $donnees)
	{
        $this->hydrate($donnees);
	}

	public function getPseudo()
	{
		return $this->pseudo;
	}
    public function getId()
    {
        return $this->id;
    }
	public function getName1()
	{
		return $this->name1;
	}
    public function getFirst_name()
    {
        return $this->first_name;
    }
	public function getDate_birth()
	{
		return $this->date_birth;
	}
	public function getEmail()
	{
		return $this->email;
	}
	public function getPassword()
	{
		return $this->password;
	}
	public function getPhone()
	{
		return $this->phone;
	}
	public function getDate_registration()
	{
		return $this->date_registration;
	}
	public function getEnabled()
	{
		return $this->enabled;
	}
    public function getRole()
    {
        return $this->role;
    }
    public function setId($id)
    {
        return $this->id = $id;
    }
	public function setPseudo($pseudo)
	{
		return $this->pseudo = $pseudo;
	}
    public function setName1($name1)
    {
        return $this->name1 = $name1;
    }
    public function setFirst_name($first_name)
    {
        return $this->first_name = $first_name;
    }
	public function setDate_birth($date_birth)
	{
		return $this->date_birth = $date_birth;
	}
	public function setEmail($email)
	{
		return $this->email = $email;
	}
	public function setPassword($password)
	{
		return $this->password = $password;
	}
	public function setPhone($phone)
	{
		return $this->phone = $phone;
	}
	public function setDate_registration($date_registration)
	{
		return $this->date_registration = $date_registration;
	}
	public function setEnabled($enabled)
	{
		return $this->enabled = $enabled;
	}
    public function setRole($role)
    {
        return $this->role = $role;
    }
    public function hydrate(array $donnees)
    {
        foreach ($donnees as $key => $value)
        {
            $method = 'set'.ucfirst($key);

            if (method_exists($this, $method))
            {
                $this->$method($value);
            }
        }
    }
}