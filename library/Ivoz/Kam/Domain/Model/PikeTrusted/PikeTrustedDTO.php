<?php

namespace Ivoz\Kam\Domain\Model\PikeTrusted;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Application\CollectionTransformerInterface;

/**
 * @codeCoverageIgnore
 */
class PikeTrustedDTO implements DataTransferObjectInterface
{
    /**
     * @var string
     */
    private $srcIp;

    /**
     * @var string
     */
    private $proto;

    /**
     * @var string
     */
    private $fromPattern;

    /**
     * @var string
     */
    private $ruriPattern;

    /**
     * @var string
     */
    private $tag;

    /**
     * @var integer
     */
    private $priority = '0';

    /**
     * @var integer
     */
    private $id;

    /**
     * {@inheritDoc}
     */
    public function transformForeignKeys(ForeignKeyTransformerInterface $transformer)
    {

    }

    /**
     * {@inheritDoc}
     */
    public function transformCollections(CollectionTransformerInterface $transformer)
    {

    }

    /**
     * @param string $srcIp
     *
     * @return PikeTrustedDTO
     */
    public function setSrcIp($srcIp = null)
    {
        $this->srcIp = $srcIp;

        return $this;
    }

    /**
     * @return string
     */
    public function getSrcIp()
    {
        return $this->srcIp;
    }

    /**
     * @param string $proto
     *
     * @return PikeTrustedDTO
     */
    public function setProto($proto = null)
    {
        $this->proto = $proto;

        return $this;
    }

    /**
     * @return string
     */
    public function getProto()
    {
        return $this->proto;
    }

    /**
     * @param string $fromPattern
     *
     * @return PikeTrustedDTO
     */
    public function setFromPattern($fromPattern = null)
    {
        $this->fromPattern = $fromPattern;

        return $this;
    }

    /**
     * @return string
     */
    public function getFromPattern()
    {
        return $this->fromPattern;
    }

    /**
     * @param string $ruriPattern
     *
     * @return PikeTrustedDTO
     */
    public function setRuriPattern($ruriPattern = null)
    {
        $this->ruriPattern = $ruriPattern;

        return $this;
    }

    /**
     * @return string
     */
    public function getRuriPattern()
    {
        return $this->ruriPattern;
    }

    /**
     * @param string $tag
     *
     * @return PikeTrustedDTO
     */
    public function setTag($tag = null)
    {
        $this->tag = $tag;

        return $this;
    }

    /**
     * @return string
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * @param integer $priority
     *
     * @return PikeTrustedDTO
     */
    public function setPriority($priority)
    {
        $this->priority = $priority;

        return $this;
    }

    /**
     * @return integer
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * @param integer $id
     *
     * @return PikeTrustedDTO
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}


