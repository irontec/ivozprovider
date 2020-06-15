<?php

namespace Ivoz\Kam\Domain\Model\UsersXcap;

use Ivoz\Core\Domain\Model\EntityInterface;

interface UsersXcapInterface extends EntityInterface
{
    /**
     * Get username
     *
     * @return string
     */
    public function getUsername(): string;

    /**
     * Get domain
     *
     * @return string
     */
    public function getDomain(): string;

    /**
     * Get doc
     *
     * @return string
     */
    public function getDoc(): string;

    /**
     * Get docType
     *
     * @return integer
     */
    public function getDocType(): int;

    /**
     * Get etag
     *
     * @return string
     */
    public function getEtag(): string;

    /**
     * Get source
     *
     * @return integer
     */
    public function getSource(): int;

    /**
     * Get docUri
     *
     * @return string
     */
    public function getDocUri(): string;

    /**
     * Get port
     *
     * @return integer
     */
    public function getPort(): int;

    /**
     * @return bool
     */
    public function isInitialized(): bool;
}
