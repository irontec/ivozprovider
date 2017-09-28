<?php

namespace Ivoz\Provider\Domain\Model\ChangeHistory;

use Ivoz\Core\Domain\Model\EntityInterface;

interface ChangeHistoryInterface extends EntityInterface
{
    /**
     * Set user
     *
     * @param string $user
     *
     * @return self
     */
    public function setUser($user);

    /**
     * Get user
     *
     * @return string
     */
    public function getUser();

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return self
     */
    public function setDate($date);

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate();

    /**
     * Set action
     *
     * @param string $action
     *
     * @return self
     */
    public function setAction($action);

    /**
     * Get action
     *
     * @return string
     */
    public function getAction();

    /**
     * Set table
     *
     * @param string $table
     *
     * @return self
     */
    public function setTable($table);

    /**
     * Get table
     *
     * @return string
     */
    public function getTable();

    /**
     * Set objid
     *
     * @param integer $objid
     *
     * @return self
     */
    public function setObjid($objid);

    /**
     * Get objid
     *
     * @return integer
     */
    public function getObjid();

    /**
     * Set field
     *
     * @param string $field
     *
     * @return self
     */
    public function setField($field);

    /**
     * Get field
     *
     * @return string
     */
    public function getField();

    /**
     * Set oldValue
     *
     * @param string $oldValue
     *
     * @return self
     */
    public function setOldValue($oldValue = null);

    /**
     * Get oldValue
     *
     * @return string
     */
    public function getOldValue();

    /**
     * Set newValue
     *
     * @param string $newValue
     *
     * @return self
     */
    public function setNewValue($newValue = null);

    /**
     * Get newValue
     *
     * @return string
     */
    public function getNewValue();

}

