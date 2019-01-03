<?php
/**
 * Created by PhpStorm.
 * User: jovanela
 * Date: 17/12/18
 * Time: 11:56
 */

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class CivilStatus
{
    /**
     * @var string
     * @Assert\NotBlank
     * @Assert\Type("string")
     * @Assert\Choice(callback="getCivilities",
     *      message="Veuillez sélectionner un genre parmi ceux proposés")
     */
    private $civility;

    /**
     * @var string
     * @Assert\NotBlank
     * @Assert\Type("string")
     * @Assert\Length(max = 80, maxMessage = "Ce champ ne peux contenir plus de 80 caractères.")
     */
    private $firstName;

    /**
     * @var string
     * @Assert\NotBlank
     * @Assert\Type("string")
     * @Assert\Length(max = 80,  maxMessage = "Ce champ ne peux contenir plus de 80 caractères.")
     */
    private $lastName;

    /**
     * @var string
     * @Assert\NotBlank
     * @Assert\Type("string")
     */
    private $customerAddress;

    /**
     * @var string
     * @Assert\NotBlank
     * @Assert\Regex("/[0-9]/")
     * @Assert\Length(min = 5, maxMessage = "Ce champ ne peux contenir moins de 5 chiffres.")
     * @Assert\Length(max = 5, maxMessage = "Ce champ ne peux contenir plus de 5 chiffres.")
     */
    private $customerZipCode;

    /**
     * @var string
     * @Assert\NotBlank
     * @Assert\Type("string")
     */
    private $customerCity;

    /**
     * @return string
     */
    public function getCivility(): ?string
    {
        return $this->civility;
    }

    /**
     * @return array
     */
    public static function getCivilities(): array
    {
        return ['Monsieur' => 'Monsieur',
            'Madame' => 'Madame',
            'M./Mme' => 'M./Mme',
            'M./M.' => 'M./M.',
            'Mme/Mme' => 'Mme/Mme'];
    }

    /**
     * @param string $civility
     */
    public function setCivility(string $civility): void
    {
        $this->civility = $civility;
    }

    /**
     * @return string
     */
    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string
     */
    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    /**
     * @return string
     */
    public function getCustomerAddress(): ?string
    {
        return $this->customerAddress;
    }

    /**
     * @param string $customerAddress
     */
    public function setCustomerAddress(string $customerAddress): void
    {
        $this->customerAddress = $customerAddress;
    }

    /**
     * @return string
     */
    public function getCustomerZipCode(): ?string
    {
        return $this->customerZipCode;
    }

    /**
     * @param string $customerZipCode
     */
    public function setCustomerZipCode(string $customerZipCode): void
    {
        $this->customerZipCode = $customerZipCode;
    }

    /**
     * @return string
     */
    public function getCustomerCity(): ?string
    {
        return $this->customerCity;
    }

    /**
     * @param string $customerCity
     */
    public function setCustomerCity(string $customerCity): void
    {
        $this->customerCity = $customerCity;
    }
}
