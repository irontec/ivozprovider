<?php

namespace Ivoz\Kam\Domain\Model\TrunksDialplan;

trait TrunksDialplanDTOTrait
{
    /**
     * @var string
     */
    private $parentReferenceField;

    public function setParentReferenceField($parentReferenceField)
    {
        $this->parentReferenceField = $parentReferenceField;
    }

    public function getParentReferenceField()
    {
        return $this->parentReferenceField;
    }
}
