<?php

namespace Ivoz\Provider\Domain\Model\IvrExcludedExtension;

/**
 * IvrExcludedExtension
 */
class IvrExcludedExtension extends IvrExcludedExtensionAbstract implements IvrExcludedExtensionInterface
{
    use IvrExcludedExtensionTrait;

    public function getChangeSet(): array
    {
        return parent::getChangeSet();
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
