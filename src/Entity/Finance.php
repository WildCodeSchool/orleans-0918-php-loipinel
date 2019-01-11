<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Finance
 * @package App\Entity
 */
class Finance
{
    /**
     * @var int
     */
    private $id;

    // ***************************************************Investissement***********************************************
    /**
     * @var string
     * @Assert\NotBlank(message="Veuillez remplir ce Champ")
     * @Assert\Regex("/[0-9]/")
     * @Assert\Length(min = 5)
     * @Assert\Length(max = 5, maxMessage = "Ce champ ne peux contenir plus de 5 chiffres.")
     */
    private $zipCode;

    /**
     * @var string
     * @Assert\NotBlank(message="Veuillez remplir ce Champ")
     * @Assert\Type("string")
     */
    private $city;

    /**
     * @var string
     * @Assert\NotBlank(message="Veuillez remplir ce Champ")
     */
    private $zone;

    /**
     * @var \DateTime
     * @Assert\NotBlank(message="Veuillez remplir ce Champ")
     * @Assert\Type("\DateTime")
     */
    private $acquisitionDate;

    /**
     * @var int
     * @Assert\NotBlank(message="Veuillez remplir ce Champ")
     * @Assert\Choice(callback="getDurations")
     */
    private $duration;

    /**
     * @var float
     * @Assert\GreaterThan(
     *     value="0",
     *     message="La valeur renseignée doit être supérieure à {{ compared_value }}")
     * @Assert\NotBlank(message="Veuillez remplir ce Champ")
     * @Assert\Type("float")
     */
    private $surfaceArea;

    /**
     * @var int
     * @Assert\GreaterThan(
     *     value="0",
     *     message="La valeur renseignée doit être supérieure à {{ compared_value }}")
     * @Assert\NotBlank(message="Veuillez remplir ce Champ")
     * @Assert\Type("int")
     */
    private $purchasePrice;

    /**
     * @var int
     * @Assert\Type("int")
     * @Assert\GreaterThanOrEqual(
     *     value="0",
     *     message="La valeur renseignée doit être égale ou supérieure à {{ compared_value }}")
     */
    private $parkingAmount;

    /**
     * @var int
     * @Assert\NotBlank(message="Veuillez remplir ce Champ")
     * @Assert\Type("int")
     * @Assert\GreaterThan(
     *     value="0",
     *     message="La valeur renseignée doit être supérieure à {{ compared_value }}")
     */
    private $notaryFees;

    /**
     * @var int
     * @Assert\Type("int")
     * @Assert\GreaterThanOrEqual(
     *     value="0",
     *     message="La valeur renseignée doit être égale ou supérieure à {{ compared_value }}")
     */
    private $otherFeesAcquisition;

    /**
     * @var int
     * @Assert\NotBlank(message="Veuillez remplir ce Champ")
     * @Assert\Type("int")
     * @Assert\GreaterThan(
     *     value="0",
     *     message="La valeur renseignée doit être supérieure à {{ compared_value }}")
     */
    private $monthlyRent;

    // ***************************************************Financement*************************************************
    /**
     * @var int
     * @Assert\NotBlank(message="Veuillez remplir ce Champ")
     * @Assert\Type("int")
     * @Assert\GreaterThanOrEqual(
     *     value="0",
     *     message="La valeur renseignée doit être égale ou supérieure à {{ compared_value }}")
     */
    private $borrowedAmount;

    /**
     * @var int
     * @Assert\NotBlank(message="Veuillez remplir ce Champ")
     * @Assert\Type("int")
     * @Assert\GreaterThanOrEqual(
     *     value="0",
     *     message="La valeur renseignée doit être égale ou supérieure à {{ compared_value }}")
     */
    private $inflow;

    /**
     * @var int
     * @Assert\NotBlank(message="Veuillez remplir ce Champ")
     * @Assert\Type("int")
     * @Assert\GreaterThanOrEqual(
     *     value="0",
     *     message="La valeur renseignée doit être égale ou supérieure à {{ compared_value }}")
     */
    private $fundingPeriod;

    /**
     * @var int
     * @Assert\NotBlank(message="Veuillez remplir ce Champ")
     * @Assert\Type("int")
     * @Assert\GreaterThan(
     *     value="0",
     *     message="La valeur renseignée doit être supérieure à {{ compared_value }}")
     */
    private $adi;

    // ***************************************************Frais***************************************************
    /**
     * @var float
     * @Assert\NotBlank(message="Veuillez remplir ce Champ")
     * @Assert\Type("float")
     * @Assert\GreaterThan(
     *     value="0",
     *     message="La valeur renseignée doit être supérieure à {{ compared_value }}")
     */
    private $managementFees;

    /**
     * @var float
     * @Assert\NotBlank(message="Veuillez remplir ce Champ")
     * @Assert\Type("float")
     * @Assert\GreaterThan(
     *     value="0",
     *     message="La valeur renseignée doit être supérieure à {{ compared_value }}")
     */
    private $rentalFee;

    /**
     * @var float
     * @Assert\NotBlank(message="Veuillez remplir ce Champ")
     * @Assert\Type("float")
     * @Assert\GreaterThan(
     *     value="0",
     *     message="La valeur renseignée doit être supérieure à {{ compared_value }}")
     */
    private $rentInsurance;

    /**
     * @var float
     * @Assert\NotBlank(message="Veuillez remplir ce Champ")
     * @Assert\Type("float")
     * @Assert\GreaterThan(
     *     value="0",
     *     message="La valeur renseignée doit être supérieure à {{ compared_value }}")
     */
    private $coownershipCharges;

    /**
     * @var int
     * @Assert\NotBlank(message="Veuillez remplir ce Champ")
     * @Assert\Type("int")
     * @Assert\GreaterThan(
     *     value="0",
     *     message="La valeur renseignée doit être supérieure à {{ compared_value }}")
     */
    private $propertyTax;

    // ***************************************************Getter/Setters***********************************************
    // ***************************************************Investissement***********************************************
    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getZipCode(): ?string
    {
        return $this->zipCode;
    }

    /**
     * @param string $zipCode
     */
    public function setZipCode(string $zipCode): void
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
    public function setCity(string $city = null): void
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
    public function setAcquisitionDate(?\DateTime $acquisitionDate): void
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
     * @return float
     */
    public function getSurfaceArea(): ?float
    {
        return $this->surfaceArea;
    }

    /**
     * @param float $surfaceArea
     */
    public function setSurfaceArea(float $surfaceArea): void
    {
        $this->surfaceArea = $surfaceArea;
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
    public function getParkingAmount(): ?int
    {
        return $this->parkingAmount;
    }

    /**
     * @param int $parkingAmount
     */
    public function setParkingAmount(int $parkingAmount): void
    {
        $this->parkingAmount = $parkingAmount;
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

    /**
     * @return int
     */
    public function getMonthlyRent(): ?int
    {
        return $this->monthlyRent;
    }

    /**
     * @param int $monthlyRent
     */
    public function setMonthlyRent(int $monthlyRent): void
    {
        $this->monthlyRent = $monthlyRent;
    }

    // ***************************************************Financement*************************************************

    /**
     * @return int
     */
    public function getBorrowedAmount(): ?int
    {
        return $this->borrowedAmount;
    }

    /**
     * @param int $borrowedAmount
     */
    public function setBorrowedAmount(int $borrowedAmount): void
    {
        $this->borrowedAmount = $borrowedAmount;
    }

    /**
     * @return int
     */
    public function getInflow(): ?int
    {
        return $this->inflow;
    }

    /**
     * @param int $inflow
     */
    public function setInflow(int $inflow): void
    {
        $this->inflow = $inflow;
    }

    /**
     * @return int
     */
    public function getFundingPeriod(): ?int
    {
        return $this->fundingPeriod;
    }

    /**
     * @param int $fundingPeriod
     */
    public function setFundingPeriod(int $fundingPeriod): void
    {
        $this->fundingPeriod = $fundingPeriod;
    }

    /**
     * @return int
     */
    public function getAdi(): ?int
    {
        return $this->adi;
    }

    /**
     * @param int $adi
     */
    public function setAdi(int $adi): void
    {
        $this->adi = $adi;
    }

    // ***************************************************Frais***************************************************

    /**
     * @return float
     */
    public function getManagementFees(): ?float
    {
        return $this->managementFees;
    }

    /**
     * @param float $managementFees
     */
    public function setManagementFees(float $managementFees): void
    {
        $this->managementFees = $managementFees;
    }

    /**
     * @return float
     */
    public function getRentalFee(): ?float
    {
        return $this->rentalFee;
    }

    /**
     * @param float $rentalFee
     */
    public function setRentalFee(float $rentalFee): void
    {
        $this->rentalFee = $rentalFee;
    }

    /**
     * @return float
     */
    public function getRentInsurance(): ?float
    {
        return $this->rentInsurance;
    }

    /**
     * @param float $rentInsurance
     */
    public function setRentInsurance(float $rentInsurance): void
    {
        $this->rentInsurance = $rentInsurance;
    }

    /**
     * @return float
     */
    public function getCoownershipCharges(): ?float
    {
        return $this->coownershipCharges;
    }

    /**
     * @param float $coownershipCharges
     */
    public function setCoownershipCharges(float $coownershipCharges): void
    {
        $this->coownershipCharges = $coownershipCharges;
    }

    /**
     * @return int
     */
    public function getPropertyTax(): ?int
    {
        return $this->propertyTax;
    }

    /**
     * @param int $propertyTax
     */
    public function setPropertyTax(int $propertyTax): void
    {
        $this->propertyTax = $propertyTax;
    }

    /**
     * @return array
     */
    public function getDurations(): array
    {
        return ['6 ans' => 6, '9 ans' => 9, '12 ans' => 12];
    }
}
