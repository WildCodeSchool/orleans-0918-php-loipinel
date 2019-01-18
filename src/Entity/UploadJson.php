<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class UploadJson
{
    /**
     * @Assert\File
     *
     *
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
