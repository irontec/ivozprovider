<?php

namespace Ivoz\Core\Domain\Model;

use Ivoz\Core\Domain\Service\TempFile;

trait TempFileContainnerTrait
{
    /**
     * @var TempFile[]
     */
    protected $tmpFiles = [];

    /**
     * @param string $fldName
     * @param \Ivoz\Core\Domain\Service\TempFile $file
     *
     * @return void
     */
    public function addTmpFile($fldName, TempFile $file)
    {
        $this->tmpFiles[$fldName]  = $file;
    }

    /**
     * @param \Ivoz\Core\Domain\Service\TempFile $file
     *
     * @throws \Exception
     *
     * @return void
     */
    public function removeTmpFile(TempFile $file)
    {
        $position = array_search($file, $this->tmpFiles);
        if ($position === false) {
            throw new \Exception('File not found');
        }

        unset($this->tmpFiles[$position]);
    }

    /**
     * @return \Ivoz\Core\Domain\Service\TempFile[]
     */
    public function getTempFiles()
    {
        return $this->tmpFiles;
    }

    /**
     * @var string $fldName
     * @return null | \Ivoz\Core\Domain\Service\TempFile
     */
    public function getTempFileByFieldName($fldName)
    {
        if (array_key_exists($fldName, $this->tmpFiles)) {
            return $this->tmpFiles[$fldName];
        }

        return null;
    }

    protected function filterFileObjects(array $fileObjects, int $filter = null): array
    {
        if (is_null($filter)) {
            return array_keys($fileObjects);
        }

        $filteredObjects = array_filter(
            $fileObjects,
            function (array $flags) use ($filter) {
                return in_array($filter, $flags, true);
            }
        );

        return array_keys($filteredObjects);
    }
}
