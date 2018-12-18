<?php
/**
 * Created by PhpStorm.
 * User: jovanela
 * Date: 17/12/18
 * Time: 12:02
 */

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class Taxation
{
    /**
     * @var string
     * @Assert\NotBlank
     * @Assert\Type("string")
     * @Assert\Choice(choices={"célibataire", "en concubinage", "mariés", "pacsés", "divorcé(e)"},
     *     message="Veuillez sélectionner une situation familiale parmi celles proposées")
     * @Assert\Choice(callback="getFamilySituations")
     */
    private $familySituation;

    /**
     * @var int
     * @Assert\NotBlank
     * @Assert\Type("int")
     * @Assert\GreaterThan(0)
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
     * @return array
     */
    public function getFamilySituations(): array
    {
        return ['célibataire' => 'célibataire',
            'en concubinage' => 'en concubinage',
            'mariés' => 'mariés',
            'pacsés' => 'pacsés',
            'divorcé(e)' => 'divorcé(e)'];
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
}
