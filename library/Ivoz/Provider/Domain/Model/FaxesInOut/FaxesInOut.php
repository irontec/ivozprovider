<?php

namespace Ivoz\Provider\Domain\Model\FaxesInOut;

use Ivoz\Core\Domain\Model\TempFileContainnerTrait;
use Ivoz\Core\Domain\Service\FileContainerInterface;

/**
 * FaxesInOut
 */
class FaxesInOut extends FaxesInOutAbstract implements FileContainerInterface, FaxesInOutInterface
{
    use FaxesInOutTrait;
    use TempFileContainnerTrait;

    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet()
    {
        return parent::getChangeSet();
    }

    /**
     * @return array
     */
    public function getFileObjects(int $filter = null)
    {
        $fileObjects = [
            'file' => [
                FileContainerInterface::DOWNLOADABLE_FILE,
                FileContainerInterface::UPDALOADABLE_FILE,
            ]
        ];

        return $this->filterFileObjects(
            $fileObjects,
            $filter
        );
    }

    /**
     * Get id
     * @codeCoverageIgnore
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set calldate
     *
     * @param \DateTime | null $calldate
     *
     * @return self
     */
    public function setCalldate($calldate = null)
    {
        if (!$calldate) {
            $calldate = new \DateTime(null, new \DateTimeZone('UTC'));
        }

        return parent::setCalldate($calldate);
    }

    /**
     * Get the numberValue in E.164 format when routing to 'number'
     *
     * @return string
     */
    public function getDstE164()
    {
        if (!$this->getDstCountry()) {
            return "";
        }

        return
            $this->getDstCountry()->getCountryCode() .
            $this->getDst();
    }
}
