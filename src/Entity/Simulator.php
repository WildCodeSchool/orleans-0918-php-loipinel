<?php
/**
 * Created by PhpStorm.
 * User: jovanela
 * Date: 23/11/18
 * Time: 11:17
 */

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class Simulator
{
    /**
     * @var string
     * @Assert\NotBlank
     * @Assert\Type("string")
     * @Assert\Length(min = 2)
     * @Assert\Length(max = 25, maxMessage = "Ce champs ne peux contenir plus de 25 caractères.");
     */
    private $firstName;
    /**
     * @var string
     * @Assert\NotBlank
     * @Assert\Type("string")
     * @Assert\Length(min = 2)
     * @Assert\Length(max = 25,  maxMessage = "Ce champs ne peux contenir plus de 25 caractères.")
     */
    private $lastName;
    /**
     * @var string
     * @Assert\NotBlank
     * @Assert\Type("string")
     */
    private $address;
    /**
     * @var int
     * @Assert\NotBlank
     * @Assert\Length(min = 5)
     * @Assert\Length(max = 5, maxMessage = "Ce champs ne peux contenir plus de 5 chiffres.")
     */
    private $zipCode;
    /**
     * @var string
     * @Assert\NotBlank
     * @Assert\Type("string")
     */
    private $city;
    /**
     * @var string
     * @Assert\NotBlank
     */
    private $zone;
    /**
     * @var \DateTime
     * @Assert\NotBlank
     * @Assert\Type("\DateTime")
     */
    private $acquisitionDate;
    /**
     * @var int
     * @Assert\Type("int")
     */
    private $duration;
    /**
     * @var int
     * @Assert\NotBlank
     * @Assert\Type("int")
     *
     */
    private $purchasePrice;
    /**
     * @var int
     * @Assert\NotBlank
     * @Assert\Type("int")
     */
    private $notaryFees;
    /**
     * @var int
     * @Assert\NotBlank
     * @Assert\Type("int")
     */
    private $otherFeesAcquisition;
    /**
     * @var int
     * @Assert\NotBlank
     * @Assert\Type("int")
     */
    private $totalAmountAcquisition;

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
    public function getAddress(): ?string
    {
        return $this->address;
    }

    /**
     * @param string $address
     */
    public function setAddress(string $address): void
    {
        $this->address = $address;
    }

    /**
     * @return int
     */
    public function getZipCode(): ?int
    {
        return $this->zipCode;
    }

    /**
     * @param int $zipCode
     */
    public function setZipCode(int $zipCode): void
    {
        $this->zipCode = $zipCode;
    }

    /**
     * @return string
     */
    public function getCity(): ?string
    {
        return $this->city;
    }

    /**
     * @param string $city
     */
    public function setCity(string $city): void
    {
        $this->city = $city;
    }

    /**
     * @return string
     */
    public function getZone(): ?string
    {
        return $this->zone;
    }

    /**
     * @param string $zone
     */
    public function setZone(string $zone): void
    {
        $this->zone = $zone;
    }

    /**
     * @return \DateTime
     */
    public function getAcquisitionDate(): ?\DateTime
    {
        return $this->acquisitionDate;
    }

    /**
     * @param \DateTime $acquisitionDate
     */
    public function setAcquisitionDate(\DateTime $acquisitionDate): void
    {
        $this->acquisitionDate = $acquisitionDate;
    }

    /**
     * @return int
     */
    public function getDuration(): ?int
    {
        return $this->duration;
    }

    /**
     * @param int $duration
     */
    public function setDuration(int $duration): void
    {
        $this->duration = $duration;
    }

    /**
     * @return int
     */
    public function getPurchasePrice(): ?int
    {
        return $this->purchasePrice;
    }

    /**
     * @param int $purchasePrice
     */
    public function setPurchasePrice(int $purchasePrice): void
    {
        $this->purchasePrice = $purchasePrice;
    }

    /**
     * @return int
     */
    public function getNotaryFees(): ?int
    {
        return $this->notaryFees;
    }

    /**
     * @param int $notaryFees
     */
    public function setNotaryFees(int $notaryFees): void
    {
        $this->notaryFees = $notaryFees;
    }

    /**
     * @return int
     */
    public function getOtherFeesAcquisition(): ?int
    {
        return $this->otherFeesAcquisition;
    }

    /**
     * @param int $otherFeesAcquisition
     */
    public function setOtherFeesAcquisition(int $otherFeesAcquisition): void
    {
        $this->otherFeesAcquisition = $otherFeesAcquisition;
    }

    /**
     * @return int
     */
    public function getTotalAmountAcquisition(): ?int
    {
        return $this->totalAmountAcquisition;
    }

    /**
     * @param int $totalAmountAcquisition
     */
    public function setTotalAmountAcquisition(int $totalAmountAcquisition): void
    {
        $this->totalAmountAcquisition = $totalAmountAcquisition;
    }
}
