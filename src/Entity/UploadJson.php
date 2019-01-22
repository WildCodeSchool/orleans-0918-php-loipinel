<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class UploadJson
{
    /**
     * @Assert\NotBlank
     * @Assert\File(
     *     mimeTypes = {"application/json", "text/plain"},
     *     mimeTypesMessage = "Votre fichier n'est pas au format .json")
     */
    private $jsonFile;


    /**
     * @return mixed
     */
    public function getJsonFile()
    {
        return $this->jsonFile;
    }

    /**
     * @param mixed $jsonFile
     */
    public function setJsonFile($jsonFile): void
    {
        $this->jsonFile = $jsonFile;
    }
}
