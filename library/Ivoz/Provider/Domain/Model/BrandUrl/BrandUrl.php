<?php

namespace Ivoz\Provider\Domain\Model\BrandUrl;

use Assert\Assertion;
use Ivoz\Core\Domain\Model\TempFileContainnerTrait;
use Ivoz\Core\Domain\Service\FileContainerInterface;

/**
 * BrandUrl
 */
class BrandUrl extends BrandUrlAbstract implements BrandUrlInterface, FileContainerInterface
{
    use BrandUrlTrait;
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
    public function getFileObjects()
    {
        return [
            'Logo'
        ];
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
     * {@inheritDoc}
     */
    public function setUrl($url)
    {
        Assertion::regex($url, '#^https://.*$#');
        return parent::setUrl($url);
    }
}

