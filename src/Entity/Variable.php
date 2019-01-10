<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VariableRepository")
 */
class Variable
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank
     * @Assert\NotNull
     * @Assert\Type("integer")
     * @Assert\GreaterThan(0)
     */
    private $maximumPricePerSquareMeter;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank
     * @Assert\NotNull
     * @Assert\Type("integer")
     * @Assert\GreaterThan(0)
     */
    private $maximumTaxBase;

    /**
     * @ORM\Column(type="float")
     * @Assert\NotBlank
     * @Assert\NotNull
     * @Assert\Type("float")
     * @Assert\GreaterThan(0)
     */
    private $rateFor6Years;

    /**
     * @ORM\Column(type="float")
     * @Assert\NotBlank
     * @Assert\NotNull
     * @Assert\Type("float")
     * @Assert\GreaterThan(0)
     */
    private $rateFor9Years;

    /**
     * @ORM\Column(type="float")
     * @Assert\NotBlank
     * @Assert\NotNull
     * @Assert\Type("float")
     * @Assert\GreaterThan(0)
     */
    private $rateFor12Years;

    /**
     * @ORM\Column(type="float")
     */
    private $percentForEqualOrUnderNine;


    /**
     * @return mixed
     */
    public function getId()

    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getMaximumPricePerSquareMeter()
    {
        return $this->maximumPricePerSquareMeter;
    }

    /**
     * @param mixed $maximumPricePerSquareMeter
     */
    public function setMaximumPricePerSquareMeter($maximumPricePerSquareMeter): void
    {
        $this->maximumPricePerSquareMeter = $maximumPricePerSquareMeter;
    }

    /**
     * @return mixed
     */
    public function getMaximumTaxBase()
    {
        return $this->maximumTaxBase;
    }

    /**
     * @param mixed $maximumTaxBase
     */
    public function setMaximumTaxBase($maximumTaxBase): void
    {
        $this->maximumTaxBase = $maximumTaxBase;
    }

    /**
     * @return mixed
     */
    public function getRateFor6Years()
    {
        return $this->rateFor6Years;
    }

    /**
     * @param mixed $rateFor6Years
     */
    public function setRateFor6Years($rateFor6Years): void
    {
        $this->rateFor6Years = $rateFor6Years;
    }

    /**
     * @return mixed
     */
    public function getRateFor9Years()
    {
        return $this->rateFor9Years;
    }

    /**
     * @param mixed $rateFor9Years
     */
    public function setRateFor9Years($rateFor9Years): void
    {
        $this->rateFor9Years = $rateFor9Years;
    }

    /**
     * @return mixed
     */
    public function getRateFor12Years()
    {
        return $this->rateFor12Years;
    }

    /**
     * @param mixed $rateFor12Years
     */
    public function setRateFor12Years($rateFor12Years): void
    {
        $this->rateFor12Years = $rateFor12Years;
    }

    /**
     * @return mixed
     */
    public function getPercentForEqualOrUnderNine(): ?float
    {
        return $this->percentForEqualOrUnderNine;
    }

    /**
     * @param mixed $percentForEqualOrUnderNine
     */
    public function setPercentForEqualOrUnderNine($percentForEqualOrUnderNine): void
    {
        $this->percentForEqualOrUnderNine = $percentForEqualOrUnderNine;
    }
}
