<?php

namespace Ivoz\Provider\Domain\Model\IvrExcludedExtension;

/**
 * IvrExcludedExtension
 */
class IvrExcludedExtension extends IvrExcludedExtensionAbstract implements IvrExcludedExtensionInterface
{
    use IvrExcludedExtensionTrait;

    /**
     * @codeCoverageIgnore
     * @return array<string, mixed>
     */
    public function getChangeSet(): array
    {
        return parent::getChangeSet();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId(): ?int
    {
        return $this->id;
    }
}
