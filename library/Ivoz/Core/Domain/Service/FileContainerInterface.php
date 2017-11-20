<?php

namespace Ivoz\Core\Domain\Service;

interface FileContainerInterface
{
    /**
     * @return array
     */
    public function getFileObjects();


    /**
     * @return TempFile[]
     */
    public function getTempFiles();
}