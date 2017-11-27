<?php

namespace Ivoz\Kam\Domain\Model\UsersXcap;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;

interface UsersXcapInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    /**
     * Set username
     *
     * @param string $username
     *
     * @return self
     */
    public function setUsername($username);

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername();

    /**
     * Set domain
     *
     * @param string $domain
     *
     * @return self
     */
    public function setDomain($domain);

    /**
     * Get domain
     *
     * @return string
     */
    public function getDomain();

    /**
     * Set doc
     *
     * @param string $doc
     *
     * @return self
     */
    public function setDoc($doc);

    /**
     * Get doc
     *
     * @return string
     */
    public function getDoc();

    /**
     * Set docType
     *
     * @param integer $docType
     *
     * @return self
     */
    public function setDocType($docType);

    /**
     * Get docType
     *
     * @return integer
     */
    public function getDocType();

    /**
     * Set etag
     *
     * @param string $etag
     *
     * @return self
     */
    public function setEtag($etag);

    /**
     * Get etag
     *
     * @return string
     */
    public function getEtag();

    /**
     * Set source
     *
     * @param integer $source
     *
     * @return self
     */
    public function setSource($source);

    /**
     * Get source
     *
     * @return integer
     */
    public function getSource();

    /**
     * Set docUri
     *
     * @param string $docUri
     *
     * @return self
     */
    public function setDocUri($docUri);

    /**
     * Get docUri
     *
     * @return string
     */
    public function getDocUri();

    /**
     * Set port
     *
     * @param integer $port
     *
     * @return self
     */
    public function setPort($port);

    /**
     * Get port
     *
     * @return integer
     */
    public function getPort();

}

