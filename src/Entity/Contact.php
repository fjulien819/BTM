<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;


class Contact
{
    const OBJECT_QUOTE_CHOICE = "Demande de devis";
    const OBJECT_INFO_CHOICE = "Demande d'informations";
    const OBJECT_OTHER_CHOICE = "Autre";

    /**
     * @Assert\NotBlank(message="Cette valeur ne doit pas être vide")
     * @Assert\Type("string", message="La valeur {{ value }} n'est pas un {{ type }} valide")
     * @Assert\Length(
     *      min = 2,
     *      max = 51,
     *      minMessage = "Votre prénom doit comporter au moins {{ limit }} caractères",
     *      maxMessage = "Votre prénom ne peut pas contenir plus de {{ limit }} caractères"
     * )
     */
    private $name;

    /**
     * @Assert\NotBlank(message="Cette valeur ne doit pas être vide")
     * @Assert\Type("string", message="La valeur {{ value }} n'est pas un {{ type }} valide")
     * @Assert\Length(
     *      min = 2,
     *      max = 51,
     *      minMessage = "Votre nom doit comporter au moins {{ limit }} caractères",
     *      maxMessage = "Votre nom ne peut pas contenir plus de {{ limit }} caractères"
     * )
     */
    private $lastName;

    /**
     * @Assert\NotBlank(message="Cette valeur ne doit pas être vide")
     * @Assert\Email(
     *     message = "L'email '{{ value }}' n'est pas un email valide",
     *     checkMX = true
     * )
     */
    private $email;

    /**
     * @Assert\NotBlank(message="Cette valeur ne doit pas être vide")
     * @Assert\Choice(choices={Contact::OBJECT_QUOTE_CHOICE, Contact::OBJECT_INFO_CHOICE, Contact::OBJECT_OTHER_CHOICE}, message="Choix non valide")
     */
    private $Object;

    /**
     * @Assert\NotBlank(message="Cette valeur ne doit pas être vide")
     * @Assert\Type("string", message="La valeur {{ value }} n'est pas un {{ type }} valide")
     * @Assert\Length(
     *      min = 10,
     *      minMessage = "Le message doit comporter au moins {{ limit }} caractères",
     *
     * )
     */
    private $message;

    /**
     * @Assert\Type("bool", message="La valeur {{ value }} n'est pas un {{ type }} valide")
     * @Assert\IsTrue(message="Cette case doit être cochée")
     */
    private $rgpd;


    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getObject(): ?string
    {
        return $this->Object;
    }

    public function setObject(string $Object): self
    {
        $this->Object = $Object;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function getRgpd(): ?bool
    {
        return $this->rgpd;
    }

    public function setRgpd(?bool $rgpd): self
    {
        $this->rgpd = $rgpd;

        return $this;
    }
}
