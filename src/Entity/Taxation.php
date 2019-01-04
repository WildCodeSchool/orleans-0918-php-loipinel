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
     * @Assert\Choice(callback="getFamilySituations",
     *     message="Veuillez sélectionner une situation familiale parmi celles proposées")
     */
    private $familySituation;

    /**
     * @var int
     * @Assert\NotBlank
     * @Assert\Type("int")
     * @Assert\GreaterThanOrEqual(0)
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
     * @Assert\Type("int")
     * @Assert\GreaterThanOrEqual(0)
     */
    private $landIncomes;

    /**
     * @var int
     * @Assert\Type("int")
     * @Assert\GreaterThanOrEqual(0)
     */
    private $bic;

    /**
     * @var int
     * @Assert\Type("int")
     * @Assert\GreaterThanOrEqual(0)
     */
    private $bnc;

    /**
     * @var int
     * @Assert\Type("int")
     * @Assert\GreaterThanOrEqual(0)
     */
    private $ba;

    /**
     * @var int
     * @Assert\NotBlank
     * @Assert\GreaterThanOrEqual(0)
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
    public static function getFamilySituations(): array
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
