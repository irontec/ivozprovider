<?php

namespace Ivoz\Provider\Domain\Model\RoutingTag;

use Ivoz\Core\Domain\Assert\Assertion;

/**
 * RoutingTag
 */
class RoutingTag extends RoutingTagAbstract implements RoutingTagInterface
{
    use RoutingTagTrait;

    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet()
    {
        return parent::getChangeSet();
    }

    protected function setTag(string $tag): self
    {
        Assertion::regex(
            $tag,
            '/^[0-9]{1,3}#$/'
        );

        return parent::setTag($tag);
    }

    /**
     * @codeCoverageIgnore
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getCgrSubject()
    {
        return sprintf("rt%d", $this->getId());
    }
}
