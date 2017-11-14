<?php

namespace Ivoz\Provider\Domain\Model\BrandUrl;

use Ivoz\Core\Domain\Model\TempFileContainnerTrait;
use Ivoz\Core\Domain\Service\FileContainerInterface;

/**
 * BrandUrl
 */
class BrandUrl extends BrandUrlAbstract implements BrandUrlInterface, FileContainerInterface
{
    use BrandUrlTrait;
    use TempFileContainnerTrait;

    public function getChangeSet()
    {
        return parent::getChangeSet();
    }

    /**
     * @return array
     */
    public function getFileObjects()
    {
        return [
            'Logo'
        ];
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}

