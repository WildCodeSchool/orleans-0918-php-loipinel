<?php

namespace App\Entity;

class UploadJson
{

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
