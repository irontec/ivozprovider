<?php

namespace Ivoz\Kam\Domain\Model\UsersXcap;

use Ivoz\Core\Domain\Model\EntityInterface;

/**
* UsersXcapInterface
*/
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
     * @return 
     */
    public function getDoc();

    /**
     * Get docType
     *
     * @return int
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
     * @return int
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
     * @return int
     */
    public function getPort(): int;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

}
