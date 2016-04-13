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
 * Data Mapper implementation for IvozProvider\Model\ProxyTrunks
 *
 * @package IvozProvider\Mapper\Sql
 * @subpackage Raw
 * @author Luis Felipe Garcia
 */

namespace IvozProvider\Mapper\Sql\Raw;
class ProxyTrunks extends MapperAbstract
{
    protected $_modelName = 'IvozProvider\\Model\\ProxyTrunks';


    protected $_urlIdentifiers = array();

    /**
     * Returns an array, keys are the field names.
     *
     * @param IvozProvider\Model\Raw\ProxyTrunks $model
     * @return array
     */
    public function toArray($model, $fields = array())
    {

        if (!$model instanceof \IvozProvider\Model\Raw\ProxyTrunks) {
            if (is_object($model)) {
                $message = get_class($model) . " is not a \IvozProvider\Model\Raw\ProxyTrunks object in toArray for " . get_class($this);
            } else {
                $message = "$model is not a \\IvozProvider\Model\\ProxyTrunks object in toArray for " . get_class($this);
            }

            $this->_logger->log($message, \Zend_Log::ERR);
            throw new \Exception('Unable to create array: invalid model passed to mapper', 2000);
        }

        if (empty($fields)) {
            $result = array(
                'id' => $model->getId(),
                'TerminalModelId' => $model->getTerminalModelId(),
                'name' => $model->getName(),
                'sorcery_id' => $model->getSorceryId(),
                'aors' => $model->getAors(),
                'auth' => $model->getAuth(),
                'context' => $model->getContext(),
                'disallow' => $model->getDisallow(),
                'allow' => $model->getAllow(),
                'direct_media' => $model->getDirectMedia(),
                'mailboxes_aors' => $model->getMailboxesAors(),
                'outbound_proxy' => $model->getOutboundProxy(),
                'send_pai' => $model->getSendPai(),
                'send_rpid' => $model->getSendRpid(),
                'contact' => $model->getContact(),
                'default_expiration' => $model->getDefaultExpiration(),
                'max_contacts' => $model->getMaxContacts(),
                'minimum_expiration' => $model->getMinimumExpiration(),
                'remove_existing' => $model->getRemoveExisting(),
                'qualify_frequency' => $model->getQualifyFrequency(),
                'authenticate_qualify' => $model->getAuthenticateQualify(),
                'maximum_expiration' => $model->getMaximumExpiration(),
                'support_path' => $model->getSupportPath(),
                'password' => $model->getPassword(),
                'subscribecontext' => $model->getSubscribecontext(),
                'direct_media_method' => $model->getDirectMediaMethod(),
                'ip' => $model->getIp(),
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
     * @return IvozProvider\\Mapper\\Sql\\DbTable\\ProxyTrunks
     */
    public function getDbTable()
    {
        if (is_null($this->_dbTable)) {
            $this->setDbTable('IvozProvider\\Mapper\\Sql\\DbTable\\ProxyTrunks');
        }

        return $this->_dbTable;
    }

    /**
     * Deletes the current model
     *
     * @param IvozProvider\Model\Raw\ProxyTrunks $model The model to delete
     * @see IvozProvider\Mapper\DbTable\TableAbstract::delete()
     * @return int
     */
    public function delete(\IvozProvider\Model\Raw\ModelAbstract $model)
    {
        if (!$model instanceof \IvozProvider\Model\Raw\ProxyTrunks) {
            if (is_object($model)) {
                $message = get_class($model) . " is not a \\IvozProvider\\Model\\ProxyTrunks object in delete for " . get_class($this);
            } else {
                $message = "$model is not a \\IvozProvider\\Model\\ProxyTrunks object in delete for " . get_class($this);
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
                            $references = $relDbAdapter->getReference('IvozProvider\\Mapper\\Sql\\DbTable\\ProxyTrunks', $capitalizedFk);

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
                            $references = $relDbAdapter->getReference('IvozProvider\\Mapper\\Sql\\DbTable\\ProxyTrunks', $capitalizedFk);

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


        return $result;

    }

    /**
     * Saves current row
     * @return integer primary key for autoincrement fields if the save action was successful
     */
    public function save(\IvozProvider\Model\Raw\ProxyTrunks $model, $forceInsert = false)
    {
        return $this->_save($model, false, false, null, $forceInsert);
    }

    /**
     * Saves current and all dependent rows
     *
     * @param \IvozProvider\Model\Raw\ProxyTrunks $model
     * @param boolean $useTransaction Flag to indicate if save should be done inside a database transaction
     * @return integer primary key for autoincrement fields if the save action was successful
     */
    public function saveRecursive(\IvozProvider\Model\Raw\ProxyTrunks $model, $useTransaction = true,
            $transactionTag = null, $forceInsert = false)
    {
        return $this->_save($model, true, $useTransaction, $transactionTag, $forceInsert);
    }

    protected function _save(\IvozProvider\Model\Raw\ProxyTrunks $model,
        $recursive = false, $useTransaction = true, $transactionTag = null, $forceInsert = false
    )
    {
        $this->_setCleanUrlIdentifiers($model);

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

        $data = $model->sanitize()->toArray();

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
                    $uuid = new \Iron\Utils\UUID();
                    $model->setId($uuid->generate());
                    $data['id'] = $model->getId();
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


        if ($success === true) {
            return $primaryKey;
        }

        return $success;
    }

    /**
     * Loads the model specific data into the model object
     *
     * @param \Zend_Db_Table_Row_Abstract|array $data The data as returned from a \Zend_Db query
     * @param IvozProvider\Model\Raw\ProxyTrunks|null $entry The object to load the data into, or null to have one created
     * @return IvozProvider\Model\Raw\ProxyTrunks The model with the data provided
     */
    public function loadModel($data, $entry = null)
    {
        if (!$entry) {
            $entry = new \IvozProvider\Model\ProxyTrunks();
        }

        // We don't need to log changes as we will reset them later...
        $entry->stopChangeLog();

        if (is_array($data)) {
            $entry->setId($data['id'])
                  ->setTerminalModelId($data['TerminalModelId'])
                  ->setName($data['name'])
                  ->setSorceryId($data['sorcery_id'])
                  ->setAors($data['aors'])
                  ->setAuth($data['auth'])
                  ->setContext($data['context'])
                  ->setDisallow($data['disallow'])
                  ->setAllow($data['allow'])
                  ->setDirectMedia($data['direct_media'])
                  ->setMailboxesAors($data['mailboxes_aors'])
                  ->setOutboundProxy($data['outbound_proxy'])
                  ->setSendPai($data['send_pai'])
                  ->setSendRpid($data['send_rpid'])
                  ->setContact($data['contact'])
                  ->setDefaultExpiration($data['default_expiration'])
                  ->setMaxContacts($data['max_contacts'])
                  ->setMinimumExpiration($data['minimum_expiration'])
                  ->setRemoveExisting($data['remove_existing'])
                  ->setQualifyFrequency($data['qualify_frequency'])
                  ->setAuthenticateQualify($data['authenticate_qualify'])
                  ->setMaximumExpiration($data['maximum_expiration'])
                  ->setSupportPath($data['support_path'])
                  ->setPassword($data['password'])
                  ->setSubscribecontext($data['subscribecontext'])
                  ->setDirectMediaMethod($data['direct_media_method'])
                  ->setIp($data['ip']);
        } else if ($data instanceof \Zend_Db_Table_Row_Abstract || $data instanceof \stdClass) {
            $entry->setId($data->{'id'})
                  ->setTerminalModelId($data->{'TerminalModelId'})
                  ->setName($data->{'name'})
                  ->setSorceryId($data->{'sorcery_id'})
                  ->setAors($data->{'aors'})
                  ->setAuth($data->{'auth'})
                  ->setContext($data->{'context'})
                  ->setDisallow($data->{'disallow'})
                  ->setAllow($data->{'allow'})
                  ->setDirectMedia($data->{'direct_media'})
                  ->setMailboxesAors($data->{'mailboxes_aors'})
                  ->setOutboundProxy($data->{'outbound_proxy'})
                  ->setSendPai($data->{'send_pai'})
                  ->setSendRpid($data->{'send_rpid'})
                  ->setContact($data->{'contact'})
                  ->setDefaultExpiration($data->{'default_expiration'})
                  ->setMaxContacts($data->{'max_contacts'})
                  ->setMinimumExpiration($data->{'minimum_expiration'})
                  ->setRemoveExisting($data->{'remove_existing'})
                  ->setQualifyFrequency($data->{'qualify_frequency'})
                  ->setAuthenticateQualify($data->{'authenticate_qualify'})
                  ->setMaximumExpiration($data->{'maximum_expiration'})
                  ->setSupportPath($data->{'support_path'})
                  ->setPassword($data->{'password'})
                  ->setSubscribecontext($data->{'subscribecontext'})
                  ->setDirectMediaMethod($data->{'direct_media_method'})
                  ->setIp($data->{'ip'});

        } else if ($data instanceof \IvozProvider\Model\Raw\ProxyTrunks) {
            $entry->setId($data->getId())
                  ->setTerminalModelId($data->getTerminalModelId())
                  ->setName($data->getName())
                  ->setSorceryId($data->getSorceryId())
                  ->setAors($data->getAors())
                  ->setAuth($data->getAuth())
                  ->setContext($data->getContext())
                  ->setDisallow($data->getDisallow())
                  ->setAllow($data->getAllow())
                  ->setDirectMedia($data->getDirectMedia())
                  ->setMailboxesAors($data->getMailboxesAors())
                  ->setOutboundProxy($data->getOutboundProxy())
                  ->setSendPai($data->getSendPai())
                  ->setSendRpid($data->getSendRpid())
                  ->setContact($data->getContact())
                  ->setDefaultExpiration($data->getDefaultExpiration())
                  ->setMaxContacts($data->getMaxContacts())
                  ->setMinimumExpiration($data->getMinimumExpiration())
                  ->setRemoveExisting($data->getRemoveExisting())
                  ->setQualifyFrequency($data->getQualifyFrequency())
                  ->setAuthenticateQualify($data->getAuthenticateQualify())
                  ->setMaximumExpiration($data->getMaximumExpiration())
                  ->setSupportPath($data->getSupportPath())
                  ->setPassword($data->getPassword())
                  ->setSubscribecontext($data->getSubscribecontext())
                  ->setDirectMediaMethod($data->getDirectMediaMethod())
                  ->setIp($data->getIp());

        }

        $entry->resetChangeLog()->initChangeLog()->setMapper($this);

        return $entry;
    }
}