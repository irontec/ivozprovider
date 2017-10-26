<?php

namespace Ivoz\Provider\Domain\Model\ChangeHistory;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Application\CollectionTransformerInterface;

/**
 * @codeCoverageIgnore
 */
class ChangeHistoryDTO implements DataTransferObjectInterface
{
    /**
     * @var string
     */
    private $user;

    /**
     * @var \DateTime
     */
    private $date = 'CURRENT_TIMESTAMP';

    /**
     * @var string
     */
    private $action;

    /**
     * @var string
     */
    private $table;

    /**
     * @var integer
     */
    private $objid;

    /**
     * @var string
     */
    private $field;

    /**
     * @var string
     */
    private $oldValue;

    /**
     * @var string
     */
    private $newValue;

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
     * @param string $user
     *
     * @return ChangeHistoryDTO
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return string
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param \DateTime $date
     *
     * @return ChangeHistoryDTO
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param string $action
     *
     * @return ChangeHistoryDTO
     */
    public function setAction($action)
    {
        $this->action = $action;

        return $this;
    }

    /**
     * @return string
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @param string $table
     *
     * @return ChangeHistoryDTO
     */
    public function setTable($table)
    {
        $this->table = $table;

        return $this;
    }

    /**
     * @return string
     */
    public function getTable()
    {
        return $this->table;
    }

    /**
     * @param integer $objid
     *
     * @return ChangeHistoryDTO
     */
    public function setObjid($objid)
    {
        $this->objid = $objid;

        return $this;
    }

    /**
     * @return integer
     */
    public function getObjid()
    {
        return $this->objid;
    }

    /**
     * @param string $field
     *
     * @return ChangeHistoryDTO
     */
    public function setField($field)
    {
        $this->field = $field;

        return $this;
    }

    /**
     * @return string
     */
    public function getField()
    {
        return $this->field;
    }

    /**
     * @param string $oldValue
     *
     * @return ChangeHistoryDTO
     */
    public function setOldValue($oldValue = null)
    {
        $this->oldValue = $oldValue;

        return $this;
    }

    /**
     * @return string
     */
    public function getOldValue()
    {
        return $this->oldValue;
    }

    /**
     * @param string $newValue
     *
     * @return ChangeHistoryDTO
     */
    public function setNewValue($newValue = null)
    {
        $this->newValue = $newValue;

        return $this;
    }

    /**
     * @return string
     */
    public function getNewValue()
    {
        return $this->newValue;
    }

    /**
     * @param integer $id
     *
     * @return ChangeHistoryDTO
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


