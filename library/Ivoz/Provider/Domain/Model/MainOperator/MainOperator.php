<?php
namespace Ivoz\Provider\Domain\Model\MainOperator;

/**
 * MainOperator
 */
class MainOperator extends MainOperatorAbstract implements MainOperatorInterface
{
    use MainOperatorTrait;

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

