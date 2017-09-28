<?php
namespace Ivoz\Provider\Domain\Model\Locution;

/**
 * Locution
 */
class Locution extends LocutionAbstract implements LocutionInterface
{
    use LocutionTrait;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    public function getLocutionPath ()
    {
        return 'FSO not implemented yet';
        throw new \Exception('FSO not implemented yet');
        return substr($this->fetchEncodedFile()->getFilePath(), 0, - 4);
    }
}

