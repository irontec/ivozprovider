<?php

/**
 * Application Model Mapper
 *
 * @package IvozProvider\Mapper\Sql
 * @subpackage Raw
 * @author Luis Felipe Garcia
 * @copyright ZF model generator
 * @license http://framework.zend.com/license/new-bsd     New BSD License
 */

/**
 * Data Mapper implementation for IvozProvider\Model\Users
 *
 * @package IvozProvider\Mapper\Sql
 * @subpackage Raw
 * @author Luis Felipe Garcia
 */

namespace IvozProvider\Mapper\Sql\Raw;
class Users extends MapperAbstract
{
    protected $_modelName = 'IvozProvider\\Model\\Users';


    protected $_urlIdentifiers = array();

    /**
     * Returns an array, keys are the field names.
     *
     * @param IvozProvider\Model\Raw\Users $model
     * @return array
     */
    public function toArray($model, $fields = array())
    {

        if (!$model instanceof \IvozProvider\Model\Raw\Users) {
            if (is_object($model)) {
                $message = get_class($model) . " is not a \IvozProvider\Model\Raw\Users object in toArray for " . get_class($this);
            } else {
                $message = "$model is not a \\IvozProvider\Model\\Users object in toArray for " . get_class($this);
            }

            $this->_logger->log($message, \Zend_Log::ERR);
            throw new \Exception('Unable to create array: invalid model passed to mapper', 2000);
        }

        if (empty($fields)) {
            $result = array(
                'id' => $model->getId(),
                'companyId' => $model->getCompanyId(),
                'name' => $model->getName(),
                'lastname' => $model->getLastname(),
                'email' => $model->getEmail(),
                'pass' => $model->getPass(),
                'timezoneId' => $model->getTimezoneId(),
                'terminalId' => $model->getTerminalId(),
                'extensionId' => $model->getExtensionId(),
                'outgoingDDIId' => $model->getOutgoingDDIId(),
                'outgoingDDIRuleId' => $model->getOutgoingDDIRuleId(),
                'callACLId' => $model->getCallACLId(),
                'doNotDisturb' => $model->getDoNotDisturb(),
                'isBoss' => $model->getIsBoss(),
                'bossAssistantId' => $model->getBossAssistantId(),
                'exceptionBoosAssistantRegExp' => $model->getExceptionBoosAssistantRegExp(),
                'active' => $model->getActive(),
                'maxCalls' => $model->getMaxCalls(),
                'externalIpCalls' => $model->getExternalIpCalls(),
                'voicemailEnabled' => $model->getVoicemailEnabled(),
                'voicemailSendMail' => $model->getVoicemailSendMail(),
                'voicemailAttachSound' => $model->getVoicemailAttachSound(),
                'tokenKey' => $model->getTokenKey(),
                'countryId' => $model->getCountryId(),
                'languageId' => $model->getLanguageId(),
                'areaCode' => $model->getAreaCode(),
            );
        } else {
            $result = array();
            foreach ($fields as $fieldData) {
                $trimField = trim($fieldData);
                if (!empty($trimField)) {
                    if (strpos($trimField, ":") !== false) {
                        list($field,$params) = explode(":", $trimField, 2);
                    } else {
                        $field = $trimField;
                        $params = null;
                    }
                    $get = 'get' . ucfirst($field);
                    $value = $model->$get($params);

                    if (is_array($value) || is_object($value)) {
                        if (is_array($value) || $value instanceof Traversable) {
                            foreach ($value as $key => $item) {
                                if ($item instanceof \IvozProvider\Model\Raw\ModelAbstract) {
                                    $value[$key] = $item->toArray();
                                }
                            }
                        } else if ($value instanceof \IvozProvider\Model\Raw\ModelAbstract) {
                            $value = $value->toArray();
                        }
                    }
                    $result[lcfirst($field)] = $value;
                }
            }
        }

        return $result;

    }

    /**
     * Returns the DbTable class associated with this mapper
     *
     * @return IvozProvider\\Mapper\\Sql\\DbTable\\Users
     */
    public function getDbTable()
    {
        if (is_null($this->_dbTable)) {
            $this->setDbTable('IvozProvider\\Mapper\\Sql\\DbTable\\Users');
        }

        return $this->_dbTable;
    }

    /**
     * Deletes the current model
     *
     * @param IvozProvider\Model\Raw\Users $model The model to delete
     * @see IvozProvider\Mapper\DbTable\TableAbstract::delete()
     * @return int
     */
    public function delete(\IvozProvider\Model\Raw\ModelAbstract $model)
    {
        if (!$model instanceof \IvozProvider\Model\Raw\Users) {
            if (is_object($model)) {
                $message = get_class($model) . " is not a \\IvozProvider\\Model\\Users object in delete for " . get_class($this);
            } else {
                $message = "$model is not a \\IvozProvider\\Model\\Users object in delete for " . get_class($this);
            }

            $this->_logger->log($message, \Zend_Log::ERR);
            throw new \Exception('Unable to delete: invalid model passed to mapper', 2000);
        }

        $useTransaction = true;

        $dbTable = $this->getDbTable();
        $dbAdapter = $dbTable->getAdapter();

        try {

            $dbAdapter->beginTransaction();

        } catch (\Exception $e) {

            //Transaction already started
            $useTransaction = false;
        }

        try {

            //onDeleteCascades emulation
            if ($this->_simulateReferencialActions && count($deleteCascade = $model->getOnDeleteCascadeRelationships()) > 0) {

                $depList = $model->getDependentList();

                foreach ($deleteCascade as $fk) {

                    $capitalizedFk = '';
                    foreach (explode("_", $fk) as $part) {

                        $capitalizedFk .= ucfirst($part);
                    }

                    if (!isset($depList[$capitalizedFk])) {

                        continue;

                    } else {

                        $relDbAdapName = 'IvozProvider\\Mapper\\Sql\\DbTable\\' . $depList[$capitalizedFk]["table_name"];
                        $depMapperName = 'IvozProvider\\Mapper\\Sql\\' . $depList[$capitalizedFk]["table_name"];
                        $depModelName = 'IvozProvider\\Model\\' . $depList[$capitalizedFk]["table_name"];

                        if ( class_exists($relDbAdapName) && class_exists($depModelName) ) {

                            $relDbAdapter = new $relDbAdapName;
                            $references = $relDbAdapter->getReference('IvozProvider\\Mapper\\Sql\\DbTable\\Users', $capitalizedFk);

                            $targetColumn = array_shift($references["columns"]);
                            $where = $relDbAdapter->getAdapter()->quoteInto($targetColumn . ' = ?', $model->getPrimaryKey());

                            $depMapper = new $depMapperName;
                            $depObjects = $depMapper->fetchList($where);

                            if (count($depObjects) === 0) {

                                continue;
                            }

                            foreach ($depObjects as $item) {

                                $item->delete();
                            }
                        }
                    }
                }
            }

            //onDeleteSetNull emulation
            if ($this->_simulateReferencialActions && count($deleteSetNull = $model->getOnDeleteSetNullRelationships()) > 0) {

                $depList = $model->getDependentList();

                foreach ($deleteSetNull as $fk) {

                    $capitalizedFk = '';
                    foreach (explode("_", $fk) as $part) {

                        $capitalizedFk .= ucfirst($part);
                    }

                    if (!isset($depList[$capitalizedFk])) {

                        continue;

                    } else {

                        $relDbAdapName = 'IvozProvider\\Mapper\\Sql\\DbTable\\' . $depList[$capitalizedFk]["table_name"];
                        $depMapperName = 'IvozProvider\\Mapper\\Sql\\' . $depList[$capitalizedFk]["table_name"];
                        $depModelName = 'IvozProvider\\Model\\' . $depList[$capitalizedFk]["table_name"];

                        if ( class_exists($relDbAdapName) && class_exists($depModelName) ) {

                            $relDbAdapter = new $relDbAdapName;
                            $references = $relDbAdapter->getReference('IvozProvider\\Mapper\\Sql\\DbTable\\Users', $capitalizedFk);

                            $targetColumn = array_shift($references["columns"]);
                            $where = $relDbAdapter->getAdapter()->quoteInto($targetColumn . ' = ?', $model->getPrimaryKey());

                            $depMapper = new $depMapperName;
                            $depObjects = $depMapper->fetchList($where);

                            if (count($depObjects) === 0) {

                                continue;
                            }

                            foreach ($depObjects as $item) {

                                $setterName = 'set' . ucfirst($targetColumn);
                                $item->$setterName(null);
                                $item->save();
                            } //end foreach

                        } //end if
                    } //end else

                }//end foreach ($deleteSetNull as $fk)
            } //end if

            $where = $dbAdapter->quoteInto($dbAdapter->quoteIdentifier('id') . ' = ?', $model->getId());
            $result = $dbTable->delete($where);

            if ($this->_cache) {

                $this->_cache->remove(get_class($model) . "_" . $model->getPrimarykey());
            }

            $fileObjects = array();
            $availableObjects = $model->getFileObjects();

            foreach ($availableObjects as $fso) {

                $removeMethod = 'remove' . $fso;
                $model->$removeMethod();
            }


            if ($useTransaction) {
                $dbAdapter->commit();
            }
        } catch (\Exception $exception) {

            $message = 'Exception encountered while attempting to delete ' . get_class($this);
            if (!empty($where)) {
                $message .= ' Where: ';
                $message .= $where;
            } else {
                $message .= ' with an empty where';
            }

            $message .= ' Exception: ' . $exception->getMessage();
            $this->_logger->log($message, \Zend_Log::ERR);
            $this->_logger->log($exception->getTraceAsString(), \Zend_Log::DEBUG);

            if ($useTransaction) {

                $dbAdapter->rollback();
            }

            throw $exception;
        }

        $this->_etagChange();
        // Save Changelog if requested
        $model->logDelete();
        $model->saveChangeLog();

        return $result;

    }

    /**
     * Saves current row
     * @return integer primary key for autoincrement fields if the save action was successful
     */
    public function save(\IvozProvider\Model\Raw\Users $model, $forceInsert = false)
    {
        return $this->_save($model, false, false, null, $forceInsert);
    }

    /**
     * Saves current and all dependent rows
     *
     * @param \IvozProvider\Model\Raw\Users $model
     * @param boolean $useTransaction Flag to indicate if save should be done inside a database transaction
     * @return integer primary key for autoincrement fields if the save action was successful
     */
    public function saveRecursive(\IvozProvider\Model\Raw\Users $model, $useTransaction = true,
            $transactionTag = null, $forceInsert = false)
    {
        return $this->_save($model, true, $useTransaction, $transactionTag, $forceInsert);
    }

    protected function _save(\IvozProvider\Model\Raw\Users $model,
        $recursive = false, $useTransaction = true, $transactionTag = null, $forceInsert = false
    )
    {
        $this->_setCleanUrlIdentifiers($model);

        $fieldsChanged = array();
        if ($this->_saveOnlyChangedFields) {
            // Save which files are changed, if updateOnlyChangedFields is enabled
            $fieldsChanged = $model->fetchChangelog();
        }

        $fileObjects = array();

        $availableObjects = $model->getFileObjects();

        foreach ($availableObjects as $item) {

            $objectMethod = 'fetch' . $item;
            $fso = $model->$objectMethod(false);
            $specMethod = 'get' . $item . 'Specs';
            $fileSpects = $model->$specMethod();

            $fileSizeSetter = 'set' . $fileSpects['sizeName'];
            $baseNameSetter = 'set' . $fileSpects['baseNameName'];
            $mimeTypeSetter = 'set' . $fileSpects['mimeName'];

            if (!is_null($fso) && $fso->mustFlush()) {

                $fileObjects[$item] = $fso;

                $model->$fileSizeSetter($fso->getSize())
                      ->$baseNameSetter($fso->getBaseName())
                      ->$mimeTypeSetter($fso->getMimeType());
            }

            if (is_null($fso)) {
                $model->$fileSizeSetter(null)
                ->$baseNameSetter(null)
                ->$mimeTypeSetter(null);
            }
        }

        $data = $model->sanitize()->toArray($fieldsChanged);

        $primaryKey = $model->getId();
        $success = true;

        if ($useTransaction) {

            try {

                if ($recursive && is_null($transactionTag)) {

                    //$this->getDbTable()->getAdapter()->query('SET transaction_allow_batching = 1');
                }

                $this->getDbTable()->getAdapter()->beginTransaction();

            } catch (\Exception $e) {

                //transaction already started
            }


            $transactionTag = 't_' . rand(1, 999) . str_replace(array('.', ' '), '', microtime());
        }

        if (!$forceInsert) {
            unset($data['id']);
        }

        try {
            if (is_null($primaryKey) || empty($primaryKey) || $forceInsert) {
                if (is_null($primaryKey) || empty($primaryKey)) {
                }
                $primaryKey = $this->getDbTable()->insert($data);

                if ($primaryKey) {
                    $model->setId($primaryKey);
                } else {
                    throw new \Exception("Insert sentence did not return a valid primary key", 9000);
                }

                if ($this->_cache) {

                    $parentList = $model->getParentList();

                    foreach ($parentList as $constraint => $values) {

                        $refTable = $this->getDbTable();

                        $ref = $refTable->getReference('IvozProvider\\Mapper\\Sql\\DbTable\\' . $values["table_name"], $constraint);
                        $column = array_shift($ref["columns"]);

                        $cacheHash = 'IvozProvider\\Model\\' . $values["table_name"] . '_' . $data[$column] .'_' . $constraint;

                        if ($this->_cache->test($cacheHash)) {

                            $cachedRelations = $this->_cache->load($cacheHash);
                            $cachedRelations->results[] = $primaryKey;

                            if ($useTransaction) {

                                $this->_cache->save($cachedRelations, $cacheHash, array($transactionTag));

                            } else {

                                $this->_cache->save($cachedRelations, $cacheHash);
                            }
                        }
                    }
                }
            } else {
                $this->getDbTable()
                     ->update(
                         $data,
                         array(
                             $this->getDbTable()->getAdapter()->quoteIdentifier('id') . ' = ?' => $primaryKey
                         )
                     );
            }

            if (!empty($primaryKey) && !empty($fileObjects)) {

                foreach ($fileObjects as $key => $fso) {

                    $baseName = $fso->getBaseName();
                    if (!empty($baseName)) {
                        $fso->flush($primaryKey);
                    }
                }
            }


            if ($recursive) {
                if ($model->getCallForwardSettingsByUser(null, null, true) !== null) {
                    $callForwardSettings = $model->getCallForwardSettingsByUser();

                    if (!is_array($callForwardSettings)) {

                        $callForwardSettings = array($callForwardSettings);
                    }

                    foreach ($callForwardSettings as $value) {
                        $value->setUserId($primaryKey)
                              ->saveRecursive(false, $transactionTag);
                    }
                }

                if ($model->getCallForwardSettingsByVoiceMailUser(null, null, true) !== null) {
                    $callForwardSettings = $model->getCallForwardSettingsByVoiceMailUser();

                    if (!is_array($callForwardSettings)) {

                        $callForwardSettings = array($callForwardSettings);
                    }

                    foreach ($callForwardSettings as $value) {
                        $value->setVoiceMailUserId($primaryKey)
                              ->saveRecursive(false, $transactionTag);
                    }
                }

                if ($model->getDDIs(null, null, true) !== null) {
                    $dDIs = $model->getDDIs();

                    if (!is_array($dDIs)) {

                        $dDIs = array($dDIs);
                    }

                    foreach ($dDIs as $value) {
                        $value->setUserId($primaryKey)
                              ->saveRecursive(false, $transactionTag);
                    }
                }

                if ($model->getExtensions(null, null, true) !== null) {
                    $extensions = $model->getExtensions();

                    if (!is_array($extensions)) {

                        $extensions = array($extensions);
                    }

                    foreach ($extensions as $value) {
                        $value->setUserId($primaryKey)
                              ->saveRecursive(false, $transactionTag);
                    }
                }

                if ($model->getExternalCallFiltersByHolidayVoiceMailUser(null, null, true) !== null) {
                    $externalCallFilters = $model->getExternalCallFiltersByHolidayVoiceMailUser();

                    if (!is_array($externalCallFilters)) {

                        $externalCallFilters = array($externalCallFilters);
                    }

                    foreach ($externalCallFilters as $value) {
                        $value->setHolidayVoiceMailUserId($primaryKey)
                              ->saveRecursive(false, $transactionTag);
                    }
                }

                if ($model->getExternalCallFiltersByOutOfScheduleVoiceMailUser(null, null, true) !== null) {
                    $externalCallFilters = $model->getExternalCallFiltersByOutOfScheduleVoiceMailUser();

                    if (!is_array($externalCallFilters)) {

                        $externalCallFilters = array($externalCallFilters);
                    }

                    foreach ($externalCallFilters as $value) {
                        $value->setOutOfScheduleVoiceMailUserId($primaryKey)
                              ->saveRecursive(false, $transactionTag);
                    }
                }

                if ($model->getHuntGroups(null, null, true) !== null) {
                    $huntGroups = $model->getHuntGroups();

                    if (!is_array($huntGroups)) {

                        $huntGroups = array($huntGroups);
                    }

                    foreach ($huntGroups as $value) {
                        $value->setNoAnswerVoiceMailUserId($primaryKey)
                              ->saveRecursive(false, $transactionTag);
                    }
                }

                if ($model->getHuntGroupsRelUsers(null, null, true) !== null) {
                    $huntGroupsRelUsers = $model->getHuntGroupsRelUsers();

                    if (!is_array($huntGroupsRelUsers)) {

                        $huntGroupsRelUsers = array($huntGroupsRelUsers);
                    }

                    foreach ($huntGroupsRelUsers as $value) {
                        $value->setUserId($primaryKey)
                              ->saveRecursive(false, $transactionTag);
                    }
                }

                if ($model->getIVRCommonByTimeoutVoiceMailUser(null, null, true) !== null) {
                    $iVRCommon = $model->getIVRCommonByTimeoutVoiceMailUser();

                    if (!is_array($iVRCommon)) {

                        $iVRCommon = array($iVRCommon);
                    }

                    foreach ($iVRCommon as $value) {
                        $value->setTimeoutVoiceMailUserId($primaryKey)
                              ->saveRecursive(false, $transactionTag);
                    }
                }

                if ($model->getIVRCommonByErrorVoiceMailUser(null, null, true) !== null) {
                    $iVRCommon = $model->getIVRCommonByErrorVoiceMailUser();

                    if (!is_array($iVRCommon)) {

                        $iVRCommon = array($iVRCommon);
                    }

                    foreach ($iVRCommon as $value) {
                        $value->setErrorVoiceMailUserId($primaryKey)
                              ->saveRecursive(false, $transactionTag);
                    }
                }

                if ($model->getIVRCustomByTimeoutVoiceMailUser(null, null, true) !== null) {
                    $iVRCustom = $model->getIVRCustomByTimeoutVoiceMailUser();

                    if (!is_array($iVRCustom)) {

                        $iVRCustom = array($iVRCustom);
                    }

                    foreach ($iVRCustom as $value) {
                        $value->setTimeoutVoiceMailUserId($primaryKey)
                              ->saveRecursive(false, $transactionTag);
                    }
                }

                if ($model->getIVRCustomByErrorVoiceMailUser(null, null, true) !== null) {
                    $iVRCustom = $model->getIVRCustomByErrorVoiceMailUser();

                    if (!is_array($iVRCustom)) {

                        $iVRCustom = array($iVRCustom);
                    }

                    foreach ($iVRCustom as $value) {
                        $value->setErrorVoiceMailUserId($primaryKey)
                              ->saveRecursive(false, $transactionTag);
                    }
                }

                if ($model->getIVRCustomEntries(null, null, true) !== null) {
                    $iVRCustomEntries = $model->getIVRCustomEntries();

                    if (!is_array($iVRCustomEntries)) {

                        $iVRCustomEntries = array($iVRCustomEntries);
                    }

                    foreach ($iVRCustomEntries as $value) {
                        $value->setTargetVoiceMailUserId($primaryKey)
                              ->saveRecursive(false, $transactionTag);
                    }
                }

                if ($model->getPickUpRelUsers(null, null, true) !== null) {
                    $pickUpRelUsers = $model->getPickUpRelUsers();

                    if (!is_array($pickUpRelUsers)) {

                        $pickUpRelUsers = array($pickUpRelUsers);
                    }

                    foreach ($pickUpRelUsers as $value) {
                        $value->setUserId($primaryKey)
                              ->saveRecursive(false, $transactionTag);
                    }
                }

                if ($model->getQueueMembers(null, null, true) !== null) {
                    $queueMembers = $model->getQueueMembers();

                    if (!is_array($queueMembers)) {

                        $queueMembers = array($queueMembers);
                    }

                    foreach ($queueMembers as $value) {
                        $value->setUserId($primaryKey)
                              ->saveRecursive(false, $transactionTag);
                    }
                }

                if ($model->getQueuesByTimeoutVoiceMailUser(null, null, true) !== null) {
                    $queues = $model->getQueuesByTimeoutVoiceMailUser();

                    if (!is_array($queues)) {

                        $queues = array($queues);
                    }

                    foreach ($queues as $value) {
                        $value->setTimeoutVoiceMailUserId($primaryKey)
                              ->saveRecursive(false, $transactionTag);
                    }
                }

                if ($model->getQueuesByFullVoiceMailUser(null, null, true) !== null) {
                    $queues = $model->getQueuesByFullVoiceMailUser();

                    if (!is_array($queues)) {

                        $queues = array($queues);
                    }

                    foreach ($queues as $value) {
                        $value->setFullVoiceMailUserId($primaryKey)
                              ->saveRecursive(false, $transactionTag);
                    }
                }

                if ($model->getUsers(null, null, true) !== null) {
                    $users = $model->getUsers();

                    if (!is_array($users)) {

                        $users = array($users);
                    }

                    foreach ($users as $value) {
                        $value->setBossAssistantId($primaryKey)
                              ->saveRecursive(false, $transactionTag);
                    }
                }

                if ($model->getAstVoicemail(null, null, true) !== null) {
                    $astVoicemail = $model->getAstVoicemail();

                    if (!is_array($astVoicemail)) {

                        $astVoicemail = array($astVoicemail);
                    }

                    foreach ($astVoicemail as $value) {
                        $value->setUserId($primaryKey)
                              ->saveRecursive(false, $transactionTag);
                    }
                }

            }

            if ($success === true) {

                foreach ($model->getOrphans() as $itemToDelete) {

                    $itemToDelete->delete();
                }

                $model->resetOrphans();
            }

            if ($useTransaction && $success) {

                $this->getDbTable()->getAdapter()->commit();

            } elseif ($useTransaction) {

                $this->getDbTable()->getAdapter()->rollback();

                if ($this->_cache) {

                    $this->_cache->clean(\Zend_Cache::CLEANING_MODE_MATCHING_TAG, array($transactionTag));
                }
            }

        } catch (\Exception $e) {
            $message = 'Exception encountered while attempting to save ' . get_class($this);
            if (!empty($primaryKey)) {
                $message .= ' id: ' . $primaryKey;
            } else {
                $message .= ' with an empty primary key ';
            }

            $message .= ' Exception: ' . $e->getMessage();
            $this->_logger->log($message, \Zend_Log::ERR);
            $this->_logger->log($e->getTraceAsString(), \Zend_Log::DEBUG);

            if ($useTransaction) {
                $this->getDbTable()->getAdapter()->rollback();

                if ($this->_cache) {

                    if ($transactionTag) {

                        $this->_cache->clean(\Zend_Cache::CLEANING_MODE_MATCHING_TAG, array($transactionTag));

                    } else {

                        $this->_cache->clean(\Zend_Cache::CLEANING_MODE_MATCHING_TAG);
                    }
                }
            }

            throw $e;
        }

        if ($success && $this->_cache) {

            if ($useTransaction) {

                $this->_cache->save($model->toArray(), get_class($model) . "_" . $model->getPrimaryKey(), array($transactionTag));

            } else {

                $this->_cache->save($model->toArray(), get_class($model) . "_" . $model->getPrimaryKey());
            }
        }

        if ($model->mustUpdateEtag()) {
            $this->_etagChange();
        }

        if ($model->hasChange()) {
            $model->saveChangeLog();
        }

        if ($success === true) {
            return $primaryKey;
        }

        return $success;
    }

    /**
     * Loads the model specific data into the model object
     *
     * @param \Zend_Db_Table_Row_Abstract|array $data The data as returned from a \Zend_Db query
     * @param IvozProvider\Model\Raw\Users|null $entry The object to load the data into, or null to have one created
     * @return IvozProvider\Model\Raw\Users The model with the data provided
     */
    public function loadModel($data, $entry = null)
    {
        if (!$entry) {
            $entry = new \IvozProvider\Model\Users();
        }

        // We don't need to log changes as we will reset them later...
        $entry->stopChangeLog();

        if (is_array($data)) {
            $entry->setId($data['id'])
                  ->setCompanyId($data['companyId'])
                  ->setName($data['name'])
                  ->setLastname($data['lastname'])
                  ->setEmail($data['email'])
                  ->setPass($data['pass'])
                  ->setTimezoneId($data['timezoneId'])
                  ->setTerminalId($data['terminalId'])
                  ->setExtensionId($data['extensionId'])
                  ->setOutgoingDDIId($data['outgoingDDIId'])
                  ->setOutgoingDDIRuleId($data['outgoingDDIRuleId'])
                  ->setCallACLId($data['callACLId'])
                  ->setDoNotDisturb($data['doNotDisturb'])
                  ->setIsBoss($data['isBoss'])
                  ->setBossAssistantId($data['bossAssistantId'])
                  ->setExceptionBoosAssistantRegExp($data['exceptionBoosAssistantRegExp'])
                  ->setActive($data['active'])
                  ->setMaxCalls($data['maxCalls'])
                  ->setExternalIpCalls($data['externalIpCalls'])
                  ->setVoicemailEnabled($data['voicemailEnabled'])
                  ->setVoicemailSendMail($data['voicemailSendMail'])
                  ->setVoicemailAttachSound($data['voicemailAttachSound'])
                  ->setTokenKey($data['tokenKey'])
                  ->setCountryId($data['countryId'])
                  ->setLanguageId($data['languageId'])
                  ->setAreaCode($data['areaCode']);
        } else if ($data instanceof \Zend_Db_Table_Row_Abstract || $data instanceof \stdClass) {
            $entry->setId($data->{'id'})
                  ->setCompanyId($data->{'companyId'})
                  ->setName($data->{'name'})
                  ->setLastname($data->{'lastname'})
                  ->setEmail($data->{'email'})
                  ->setPass($data->{'pass'})
                  ->setTimezoneId($data->{'timezoneId'})
                  ->setTerminalId($data->{'terminalId'})
                  ->setExtensionId($data->{'extensionId'})
                  ->setOutgoingDDIId($data->{'outgoingDDIId'})
                  ->setOutgoingDDIRuleId($data->{'outgoingDDIRuleId'})
                  ->setCallACLId($data->{'callACLId'})
                  ->setDoNotDisturb($data->{'doNotDisturb'})
                  ->setIsBoss($data->{'isBoss'})
                  ->setBossAssistantId($data->{'bossAssistantId'})
                  ->setExceptionBoosAssistantRegExp($data->{'exceptionBoosAssistantRegExp'})
                  ->setActive($data->{'active'})
                  ->setMaxCalls($data->{'maxCalls'})
                  ->setExternalIpCalls($data->{'externalIpCalls'})
                  ->setVoicemailEnabled($data->{'voicemailEnabled'})
                  ->setVoicemailSendMail($data->{'voicemailSendMail'})
                  ->setVoicemailAttachSound($data->{'voicemailAttachSound'})
                  ->setTokenKey($data->{'tokenKey'})
                  ->setCountryId($data->{'countryId'})
                  ->setLanguageId($data->{'languageId'})
                  ->setAreaCode($data->{'areaCode'});

        } else if ($data instanceof \IvozProvider\Model\Raw\Users) {
            $entry->setId($data->getId())
                  ->setCompanyId($data->getCompanyId())
                  ->setName($data->getName())
                  ->setLastname($data->getLastname())
                  ->setEmail($data->getEmail())
                  ->setPass($data->getPass())
                  ->setTimezoneId($data->getTimezoneId())
                  ->setTerminalId($data->getTerminalId())
                  ->setExtensionId($data->getExtensionId())
                  ->setOutgoingDDIId($data->getOutgoingDDIId())
                  ->setOutgoingDDIRuleId($data->getOutgoingDDIRuleId())
                  ->setCallACLId($data->getCallACLId())
                  ->setDoNotDisturb($data->getDoNotDisturb())
                  ->setIsBoss($data->getIsBoss())
                  ->setBossAssistantId($data->getBossAssistantId())
                  ->setExceptionBoosAssistantRegExp($data->getExceptionBoosAssistantRegExp())
                  ->setActive($data->getActive())
                  ->setMaxCalls($data->getMaxCalls())
                  ->setExternalIpCalls($data->getExternalIpCalls())
                  ->setVoicemailEnabled($data->getVoicemailEnabled())
                  ->setVoicemailSendMail($data->getVoicemailSendMail())
                  ->setVoicemailAttachSound($data->getVoicemailAttachSound())
                  ->setTokenKey($data->getTokenKey())
                  ->setCountryId($data->getCountryId())
                  ->setLanguageId($data->getLanguageId())
                  ->setAreaCode($data->getAreaCode());

        }

        $entry->resetChangeLog()->initChangeLog()->setMapper($this);

        return $entry;
    }

    protected function _etagChange()
    {

        $date = new \Zend_Date();
        $date->setTimezone('UTC');
        $nowUTC = $date->toString('yyyy-MM-dd HH:mm:ss');

        $etags = new \IvozProvider\Mapper\Sql\EtagVersions();
        $etag = $etags->findOneByField('table', 'Users');

        if (empty($etag)) {
            $etag = new \IvozProvider\Model\EtagVersions();
            $etag->setTable('Users');
        }

        $random = substr(
            str_shuffle(
                str_repeat(
                    'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789',
                    5
                )
            ), 0, 5
        );

        $etag->setEtag(md5($nowUTC . $random));
        $etag->setLastChange($nowUTC);
        $etag->save();

    }

}