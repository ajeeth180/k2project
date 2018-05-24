<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Person
 *
 * @ORM\Table(name="person")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PersonRepository")
 */
class Person
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="Registration", mappedBy="person")
     */
    private $registrations;

    public function __construct()
    {
        $this->registrations = new ArrayCollection();
        $this->lessons = new ArrayCollection();
    }

    /**
     * @ORM\OneToMany(targetEntity="Lesson", mappedBy="person")
     */
    private $lessons;

    /**
     * @var string
     *
     * @ORM\Column(name="loginname", type="string", length=255, unique=true)
     */
    private $loginname;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="firstname", type="string", length=255)
     */
    private $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="preprovision", type="string", length=255, nullable=true)
     */
    private $preprovision;

    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=255)
     */
    private $lastname;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateofbirth", type="date")
     */
    private $dateofbirth;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="hiringdate", type="date", nullable=true)
     */
    private $hiringdate;

    /**
     * @var string
     *
     * @ORM\Column(name="salary", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $salary;

    /**
     * @var int
     *
     * @ORM\Column(name="socialsecnumber", type="integer", nullable=true, unique=true)
     */
    private $socialsecnumber;

    /**
     * @var string
     *
     * @ORM\Column(name="street", type="string", length=255, nullable=true)
     */
    private $street;

    /**
     * @var string
     *
     * @ORM\Column(name="postalcode", type="string", length=255, nullable=true)
     */
    private $postalcode;

    /**
     * @var string
     *
     * @ORM\Column(name="place", type="string", length=255, nullable=true)
     */
    private $place;

    /**
     * @var array
     *
     * @ORM\Column(name="role", type="json_array")
     */
    private $role;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set loginname
     *
     * @param string $loginname
     *
     * @return Person
     */
    public function setLoginname($loginname)
    {
        $this->loginname = $loginname;

        return $this;
    }

    /**
     * Get loginname
     *
     * @return string
     */
    public function getLoginname()
    {
        return $this->loginname;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return Person
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set firstname
     *
     * @param string $firstname
     *
     * @return Person
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set preprovision
     *
     * @param string $preprovision
     *
     * @return Person
     */
    public function setPreprovision($preprovision)
    {
        $this->preprovision = $preprovision;

        return $this;
    }

    /**
     * Get preprovision
     *
     * @return string
     */
    public function getPreprovision()
    {
        return $this->preprovision;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     *
     * @return Person
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set dateofbirth
     *
     * @param \DateTime $dateofbirth
     *
     * @return Person
     */
    public function setDateofbirth($dateofbirth)
    {
        $this->dateofbirth = $dateofbirth;

        return $this;
    }

    /**
     * Get dateofbirth
     *
     * @return \DateTime
     */
    public function getDateofbirth()
    {
        return $this->dateofbirth;
    }

    /**
     * Set hiringdate
     *
     * @param \DateTime $hiringdate
     *
     * @return Person
     */
    public function setHiringdate($hiringdate)
    {
        $this->hiringdate = $hiringdate;

        return $this;
    }

    /**
     * Get hiringdate
     *
     * @return \DateTime
     */
    public function getHiringdate()
    {
        return $this->hiringdate;
    }

    /**
     * Set salary
     *
     * @param string $salary
     *
     * @return Person
     */
    public function setSalary($salary)
    {
        $this->salary = $salary;

        return $this;
    }

    /**
     * Get salary
     *
     * @return string
     */
    public function getSalary()
    {
        return $this->salary;
    }

    /**
     * Set socialsecnumber
     *
     * @param integer $socialsecnumber
     *
     * @return Person
     */
    public function setSocialsecnumber($socialsecnumber)
    {
        $this->socialsecnumber = $socialsecnumber;

        return $this;
    }

    /**
     * Get socialsecnumber
     *
     * @return int
     */
    public function getSocialsecnumber()
    {
        return $this->socialsecnumber;
    }

    /**
     * Set street
     *
     * @param string $street
     *
     * @return Person
     */
    public function setStreet($street)
    {
        $this->street = $street;

        return $this;
    }

    /**
     * Get street
     *
     * @return string
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * Set postalcode
     *
     * @param string $postalcode
     *
     * @return Person
     */
    public function setPostalcode($postalcode)
    {
        $this->postalcode = $postalcode;

        return $this;
    }

    /**
     * Get postalcode
     *
     * @return string
     */
    public function getPostalcode()
    {
        return $this->postalcode;
    }

    /**
     * Set place
     *
     * @param string $place
     *
     * @return Person
     */
    public function setPlace($place)
    {
        $this->place = $place;

        return $this;
    }

    /**
     * Get place
     *
     * @return string
     */
    public function getPlace()
    {
        return $this->place;
    }

    /**
     * Set role
     *
     * @param array $role
     *
     * @return Person
     */
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get role
     *
     * @return array
     */
    public function getRole()
    {
        return $this->role;
    }
}

