<?php

namespace Ivoz\Core\Domain\Model;

trait ChangelogTrait
{
    /**
     * @var bool
     */
    public $__isInitialized__ = true;

    /**
     * Changelog tracking purpose
     * @var array
     */
    protected $_initialValues = [];

    /**
     * @var bool
     */
    protected $isPersisted = false;

    abstract public function getId();
    abstract protected function __toArray();

    /**
     * @return bool
     */
    public function isNew()
    {
        return !$this->isPersisted();
    }

    /**
     * @return bool
     */
    public function isPersisted()
    {
        return $this->isPersisted;
    }

    /**
     * @return void
     */
    public function markAsPersisted()
    {
        $this->isPersisted = true;
    }

    /**
     * @return bool
     */
    public function hasBeenDeleted()
    {
        $id = $this->getId();
        if ($id !== null) {
            return false;
        }

        $initialId = $this->getInitialValue('id');
        $hasInitialValue = !is_null($initialId);

        return $hasInitialValue;
    }

    /**
     * @return void
     * @throws \Exception
     */
    public function initChangelog()
    {
        $values = $this->__toArray();
        if (!$this->getId()) {
            // Empty values for entities with no Id
            foreach ($values as $key => $val) {
                $values[$key] = null;
            }
        }

        $this->isPersisted = $this->getId() !== null
            ? true
            : false;

        $this->_initialValues = $values;
    }

    /**
     * @param string $dbFieldName
     * @return bool
     * @throws \Exception
     */
    public function hasChanged($dbFieldName)
    {
        if (!array_key_exists($dbFieldName, $this->_initialValues)) {
            throw new \Exception($dbFieldName . ' field was not found');
        }
        $currentValues = $this->__toArray();

        return $currentValues[$dbFieldName] != $this->_initialValues[$dbFieldName];
    }

    /**
     * @param string $dbFieldName
     * @return mixed
     * @throws \Exception
     */
    public function getInitialValue($dbFieldName)
    {
        if (!array_key_exists($dbFieldName, $this->_initialValues)) {
            throw new \Exception($dbFieldName . ' field was not found');
        }

        return $this->_initialValues[$dbFieldName];
    }

    /**
     * @return array
     */
    protected function getChangeSet()
    {
        $changes = [];
        $currentValues = $this->__toArray();
        foreach ($currentValues as $key => $value) {
            $isDateTime =
                $value instanceof \DateTimeInterface
                || $this->_initialValues[$key] instanceof \DateTimeInterface;

            $strictCompare = !$isDateTime;

            $notChanged = $strictCompare
                ? $this->_initialValues[$key] === $currentValues[$key]
                : $this->_initialValues[$key] == $currentValues[$key];

            if ($notChanged) {
                continue;
            }
            $value = $currentValues[$key];
            if ($value instanceof \DateTime) {
                $value = $value->format('Y-m-d H:i:s');
            }

            $changes[$key] = $value;
        }

        return $changes;
    }

    /**
     * @return string[]
     */
    public function getChangedFields()
    {
        $changes = $this->getChangeSet();

        return array_keys(
            $changes
        );
    }
}
