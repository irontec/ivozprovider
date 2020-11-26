<?php

namespace Ivoz\Kam\Domain\Model\UsersLocationAttr;

use Ivoz\Core\Domain\Model\EntityInterface;

/**
* UsersLocationAttrInterface
*/
interface UsersLocationAttrInterface extends EntityInterface
{
    /**
     * Get ruid
     *
     * @return string
     */
    public function getRuid(): string;

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername(): string;

    /**
     * Get domain
     *
     * @return string | null
     */
    public function getDomain(): ?string;

    /**
     * Get aname
     *
     * @return string
     */
    public function getAname(): string;

    /**
     * Get atype
     *
     * @return int
     */
    public function getAtype(): int;

    /**
     * Get avalue
     *
     * @return string
     */
    public function getAvalue(): string;

    /**
     * Get lastModified
     *
     * @return \DateTimeInterface
     */
    public function getLastModified(): \DateTimeInterface;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

}
