<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     */
    private $maximumPricePerSquareMeter;

    /**
     * @ORM\Column(type="integer")
     */
    private $maximumTaxBase;

    /**
     * @ORM\Column(type="float")
     */
    private $rateFor6Years;

    /**
     * @ORM\Column(type="float")
     */
    private $rateFor9Years;

    /**
     * @ORM\Column(type="float")
     */
    private $rateFor12Years;

    /**
     * @ORM\Column(type="float")
     */
    private $percentForEqualOrUnderNine;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMaximumPricePerSquareMeter(): ?int
    {
        return $this->maximumPricePerSquareMeter;
    }

    public function setMaximumPricePerSquareMeter(int $maximumPricePerSquareMeter): self
    {
        $this->maximumPricePerSquareMeter = $maximumPricePerSquareMeter;

        return $this;
    }

    public function getMaximumTaxBase(): ?int
    {
        return $this->maximumTaxBase;
    }

    public function setMaximumTaxBase(int $maximumTaxBase): self
    {
        $this->maximumTaxBase = $maximumTaxBase;

        return $this;
    }

    public function getRateFor6Years(): ?float
    {
        return $this->rateFor6Years;
    }

    public function setRateFor6Years(float $rateFor6Years): self
    {
        $this->rateFor6Years = $rateFor6Years;

        return $this;
    }

    public function getRateFor9Years(): ?float
    {
        return $this->rateFor9Years;
    }

    public function setRateFor9Years(float $rateFor9Years): self
    {
        $this->rateFor9Years = $rateFor9Years;

        return $this;
    }

    public function getRateFor12Years(): ?float
    {
        return $this->rateFor12Years;
    }

    public function setRateFor12Years(float $rateFor12Years): self
    {
        $this->rateFor12Years = $rateFor12Years;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPercentForEqualOrUnderNine()
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
