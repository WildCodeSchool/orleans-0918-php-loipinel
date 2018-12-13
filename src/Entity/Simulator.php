<?php
/**
 * Created by PhpStorm.
 * User: jovanela
 * Date: 23/11/18
 * Time: 11:17
 */

namespace App\Entity;

use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\Validator\Constraints as Assert;

class Simulator
{
    // ***************************************************Etat Civil***************************************************
    /**
     * @var string
     * @Assert\NotBlank
     * @Assert\Type("string")
     * @Assert\Choice(choices={"Monsieur", "Madame", "M./Mme", "M./M.", "Mme/Mme"}, message="Veuillez sélectionner
     * un genre parmi ceux proposés")
     */
    private $civility;

    /**
     * @var string
     * @Assert\NotBlank
     * @Assert\Type("string")
     * @Assert\Length(min = 1)
     * @Assert\Length(max = 80, maxMessage = "Ce champ ne peux contenir plus de 80 caractères.")
     */
    private $firstName;

    /**
     * @var string
     * @Assert\NotBlank
     * @Assert\Type("string")
     * @Assert\Length(min = 1)
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
     * @Assert\Length(min = 5)
     * @Assert\Length(max = 5, maxMessage = "Ce champ ne peux contenir plus de 5 chiffres.")
     */
    private $customerZipCode;

    /**
     * @var string
     * @Assert\NotBlank
     * @Assert\Type("string")
     */
    private $customerCity;

    // ***************************************************Fiscalité***************************************************
    /**
     * @var string
     * @Assert\NotBlank
     * @Assert\Type("string")
     * @Assert\Choice(choices={"célibataire", "en concubinage", "mariés", "pacsés", "divorcé(e)"},
     *     message="Veuillez sélectionner une situation familiale parmi celles proposées")
     */
    private $familySituation;

    /**
     * @var int
     * @Assert\NotBlank
     * @Assert\Type("int")
     * * @Assert\Regex("/[0-9]{1,2}/")
     */
    private $numberOfChildren;

    /**
     * @var float
     * @Assert\NotBlank
     * @Assert\Type("float")
     * @Assert\GreaterThan(0)
     */
    private $numberOfTaxShares;

    /**
     * @var float
     * @Assert\NotBlank
     * @Assert\GreaterThan(0)
     * @Assert\Type("float")
     */
    private $salaryDeclared;

    /**
     * @var int
     * @Assert\NotBlank
     * @Assert\Type("int")
     */
    private $landIncomes;

    /**
     * @var int
     * @Assert\NotBlank
     * @Assert\Type("int")
     */
    private $bic;

    /**
     * @var int
     * @Assert\NotBlank
     * @Assert\Type("int")
     */
    private $bnc;

    /**
     * @var int
     * @Assert\NotBlank
     * @Assert\Type("int")
     */
    private $ba;

    /**
     * @var int
     * @Assert\NotBlank
     * @Assert\Type("int")
     */
    private $incomeTax;

    // ***************************************************Investissement***********************************************
    /**
     * @var string
     * @Assert\NotBlank
     * @Assert\Regex("/[0-9]/")
     * @Assert\Length(min = 5)
     * @Assert\Length(max = 5, maxMessage = "Ce champ ne peux contenir plus de 5 chiffres.")
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
     * @var float
     * @Assert\NotBlank
     * @Assert\GreaterThan(0)
     * @Assert\Type("float")
     */
    private $surfaceArea;

    /**
     * @var int
     * @Assert\NotBlank
     * @Assert\GreaterThan(0)
     * @Assert\Type("int")
     */
    private $purchasePrice;

    /**
     * @var int
     * @Assert\NotBlank
     * @Assert\Type("int")
     */
    private $parkingAmount;

    /**
     * @var int
     * @Assert\NotBlank
     * @Assert\Type("int")
     * @Assert\GreaterThan(0)
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
     * @Assert\GreaterThan(0)
     */
    private $totalAmountAcquisition;

    /**
     * @var int
     * @Assert\NotBlank
     * @Assert\Type("int")
     * @Assert\GreaterThan(0)
     */
    private $monthlyRent;

    // ***************************************************Financement*************************************************
    /**
     * @var int
     * @Assert\NotBlank
     * @Assert\Type("int")
     * @Assert\GreaterThan(0)
     */
    private $borrowedAmount;

    /**
     * @var int
     * @Assert\NotBlank
     * @Assert\Type("int")
     */
    private $inflow;

    /**
     * @var int
     * @Assert\NotBlank
     * @Assert\Type("int")
     * @Assert\GreaterThan(0)
     */
    private $fundingPeriod;

    /**
     * @var int
     * @Assert\NotBlank
     * @Assert\Type("int")
     */
    private $adi;

    // ***************************************************Frais***************************************************
    /**
     * @var float
     * @Assert\NotBlank
     * @Assert\Type("float")
     * @Assert\GreaterThan(0)
     */
    private $managementFees;

    /**
     * @var float
     * @Assert\NotBlank
     * @Assert\Type("float")
     * @Assert\GreaterThan(0)
     */
    private $rentalFee;

    /**
     * @var float
     * @Assert\NotBlank
     * @Assert\Type("float")
     * @Assert\GreaterThan(0)
     */
    private $rentInsurance;

    /**
     * @var float
     * @Assert\NotBlank
     * @Assert\Type("float")
     * @Assert\GreaterThan(0)
     */
    private $coownershipCharges;

    /**
     * @var int
     * @Assert\NotBlank
     * @Assert\Type("int")
     * @Assert\GreaterThan(0)
     */
    private $propertyTax;

    // ***************************************************GETTER & SETTER**********************************************
    // ***************************************************Etat Civil***************************************************
    /**
     * @return string
     */
    public function getCivility(): ?string
    {
        return $this->civility;
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

    // ***************************************************Fiscalité***************************************************
    /**
     * @return string
     */
    public function getFamilySituation(): ?string
    {
        return $this->familySituation;
    }

    /**
     * @param string $familySituation
     */
    public function setFamilySituation(string $familySituation): void
    {
        $this->familySituation = $familySituation;
    }

    /**
     * @return int
     */
    public function getNumberOfChildren(): ?int
    {
        return $this->numberOfChildren;
    }

    /**
     * @param int $numberOfChildren
     */
    public function setNumberOfChildren(int $numberOfChildren): void
    {
        $this->numberOfChildren = $numberOfChildren;
    }

    /**
     * @return float
     */
    public function getNumberOfTaxShares(): ?float
    {
        return $this->numberOfTaxShares;
    }

    /**
     * @param float $numberOfTaxShares
     */
    public function setNumberOfTaxShares(float $numberOfTaxShares): void
    {
        $this->numberOfTaxShares = $numberOfTaxShares;
    }

    /**
     * @return float
     */
    public function getSalaryDeclared(): ?float
    {
        return $this->salaryDeclared;
    }

    /**
     * @param float $salaryDeclared
     */
    public function setSalaryDeclared(float $salaryDeclared): void
    {
        $this->salaryDeclared = $salaryDeclared;
    }

    /**
     * @return int
     */
    public function getLandIncomes(): ?int
    {
        return $this->landIncomes;
    }

    /**
     * @param int $landIncomes
     */
    public function setLandIncomes(int $landIncomes): void
    {
        $this->landIncomes = $landIncomes;
    }

    /**
     * @return int
     */
    public function getBic(): ?int
    {
        return $this->bic;
    }

    /**
     * @param int $bic
     */
    public function setBic(int $bic): void
    {
        $this->bic = $bic;
    }

    /**
     * @return int
     */
    public function getBnc(): ?int
    {
        return $this->bnc;
    }

    /**
     * @param int $bnc
     */
    public function setBnc(int $bnc): void
    {
        $this->bnc = $bnc;
    }

    /**
     * @return int
     */
    public function getBa(): ?int
    {
        return $this->ba;
    }

    /**
     * @param int $ba
     */
    public function setBa(int $ba): void
    {
        $this->ba = $ba;
    }

    /**
     * @return int
     */
    public function getIncomeTax(): ?int
    {
        return $this->incomeTax;
    }

    /**
     * @param int $incomeTax
     */
    public function setIncomeTax(int $incomeTax): void
    {
        $this->incomeTax = $incomeTax;
    }

// ***************************************************Investissement***********************************************
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
        if ($surfaceArea <= 0) {
            throw new Exception('La surface ne peut être égale à 0');
        }
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
     * @return int
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
}
