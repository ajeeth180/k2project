<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Registration
 *
 * @ORM\Table(name="registration")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\RegistrationRepository")
 */
class Registration
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
     * @ORM\ManyToOne(targetEntity="Lesson", inversedBy="registrations")
     * @ORM\JoinColumn(name="lesson_id", referencedColumnName="id")
     */
    private $lesson;

    /**
     * @ORM\ManyToOne(targetEntity="Person", inversedBy="persons")
     * @ORM\JoinColumn(name="person_id", referencedColumnName="id")
     */
    private $persons;

    /**
     * @var string
     *
     * @ORM\Column(name="payment", type="string", length=255, nullable=true)
     */
    private $payment;


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
     * Set payment
     *
     * @param string $payment
     *
     * @return Registration
     */
    public function setPayment($payment)
    {
        $this->payment = $payment;

        return $this;
    }

    /**
     * Get payment
     *
     * @return string
     */
    public function getPayment()
    {
        return $this->payment;
    }
}
