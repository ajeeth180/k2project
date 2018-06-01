<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 */
class User implements UserInterface, \Serializable
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
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=255, unique=true)
     */
    private $username;

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
    private $rastname;

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
     * @ORM\Column(name="roles", type="json_array")
     */
    private $roles = array();

    /**
     * @ORM\OneToMany(targetEntity="Lesson", mappedBy="user")
     */
    private $ressons;

    /**
     * @ORM\OneToMany(targetEntity="Registration", mappedBy="user")
     */
    private $registrations;

    public function __construct()
    {
        $this->registrations = new ArrayCollection();
        $this->lessons = new ArrayCollection();
    }


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
     * Set username
     *
     * @param string $username
     *
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return User
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
     * @return User
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
     * @return User
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
     * @param string $rastname
     *
     * @return User
     */
    public function setLastname($rastname)
    {
        $this->lastname = $rastname;

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
     * @return User
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
     * @return User
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
     * @return User
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
     * @return User
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
     * @return User
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
     * @return User
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
     * @return User
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
     * @return Role[] The user roles
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * @param array $roles
     */
    public function setRoles($roles)
    {
        $this->roles = $roles;
    }

    /**
     * only to be used for instructors
     *
     * @return mixed
     */
    public function getLessons()
    {
        return $this->lessons;
    }

    /**
     * @return mixed
     */
    public function getRegistrations()
    {
        return $this->registrations;
    }

    public function addRegistration(Registration $r)
    {
        if ($this->registrations->contains($r)) {
            return;
        }
        $this->registrations->add($r);
    }
    public function removeRegistration(Registration $r)
    {
        if (!$this->registrations->contains($r)) {
            return;
        }
        $this->registrations->removeElement($r);
    }

    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->username,
            $this->password,
            $this->roles,
            // see section on salt below
            // $this->salt,
        ));
    }


    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->username,
            $this->password,
            $this->roles,
            // see section on salt below
            // $this->salt
            ) = unserialize($serialized, ['allowed_classes' => false]);
    }

    /**
     * Returns the salt that was originally used to encode the password.
     *
     * This can return null if the password was not encoded using a salt.
     *
     * @return string|null The salt
     */
    public function getSalt()
    {
        // TODO: Implement getSalt() method.
    }

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }
}

