<?php

/**
 * Application Model Mapper
 *
 * @package Oasis\Mapper\Sql
 * @subpackage Raw
 * @author Luis Felipe Garcia
 * @copyright ZF model generator
 * @license http://framework.zend.com/license/new-bsd     New BSD License
 */

/**
 * Data Mapper implementation for Oasis\Model\AstQueues
 *
 * @package Oasis\Mapper\Sql
 * @subpackage Raw
 * @author Luis Felipe Garcia
 */

namespace Oasis\Mapper\Sql\Raw;
class AstQueues extends MapperAbstract
{
    protected $_modelName = 'Oasis\\Model\\AstQueues';


    protected $_urlIdentifiers = array();

    /**
     * Returns an array, keys are the field names.
     *
     * @param Oasis\Model\Raw\AstQueues $model
     * @return array
     */
    public function toArray($model)
    {
        if (!$model instanceof \Oasis\Model\Raw\AstQueues) {
            if (is_object($model)) {
                $message = get_class($model) . " is not a \Oasis\Model\Raw\AstQueues object in toArray for " . get_class($this);
            } else {
                $message = "$model is not a \\Oasis\Model\\AstQueues object in toArray for " . get_class($this);
            }

            $this->_logger->log($message, \Zend_Log::ERR);
            throw new \Exception('Unable to create array: invalid model passed to mapper', 2000);
        }

        $result = array(
            'name' => $model->getName(),
            'ast_musiconhold' => $model->getAstMusiconhold(),
            'announce' => $model->getAnnounce(),
            'context' => $model->getContext(),
            'timeout' => $model->getTimeout(),
            'ringinuse' => $model->getRinginuse(),
            'setinterfacevar' => $model->getSetinterfacevar(),
            'setqueuevar' => $model->getSetqueuevar(),
            'setqueueentryvar' => $model->getSetqueueentryvar(),
            'monitor_format' => $model->getMonitorFormat(),
            'membermacro' => $model->getMembermacro(),
            'membergosub' => $model->getMembergosub(),
            'queue_youarenext' => $model->getQueueYouarenext(),
            'queue_thereare' => $model->getQueueThereare(),
            'queue_callswaiting' => $model->getQueueCallswaiting(),
            'queue_quantity1' => $model->getQueueQuantity1(),
            'queue_quantity2' => $model->getQueueQuantity2(),
            'queue_holdtime' => $model->getQueueHoldtime(),
            'queue_minutes' => $model->getQueueMinutes(),
            'queue_minute' => $model->getQueueMinute(),
            'queue_seconds' => $model->getQueueSeconds(),
            'queue_thankyou' => $model->getQueueThankyou(),
            'queue_callerannounce' => $model->getQueueCallerannounce(),
            'queue_reporthold' => $model->getQueueReporthold(),
            'announce_frequency' => $model->getAnnounceFrequency(),
            'announce_to_first_user' => $model->getAnnounceToFirstUser(),
            'min_announce_frequency' => $model->getMinAnnounceFrequency(),
            'announce_round_seconds' => $model->getAnnounceRoundSeconds(),
            'announce_holdtime' => $model->getAnnounceHoldtime(),
            'announce_position' => $model->getAnnouncePosition(),
            'announce_position_limit' => $model->getAnnouncePositionLimit(),
            'periodic_announce' => $model->getPeriodicAnnounce(),
            'periodic_announce_frequency' => $model->getPeriodicAnnounceFrequency(),
            'relative_periodic_announce' => $model->getRelativePeriodicAnnounce(),
            'random_periodic_announce' => $model->getRandomPeriodicAnnounce(),
            'retry' => $model->getRetry(),
            'wrapuptime' => $model->getWrapuptime(),
            'penaltymemberslimit' => $model->getPenaltymemberslimit(),
            'autofill' => $model->getAutofill(),
            'monitor_type' => $model->getMonitorType(),
            'autopause' => $model->getAutopause(),
            'autopausedelay' => $model->getAutopausedelay(),
            'autopausebusy' => $model->getAutopausebusy(),
            'autopauseunavail' => $model->getAutopauseunavail(),
            'maxlen' => $model->getMaxlen(),
            'servicelevel' => $model->getServicelevel(),
            'strategy' => $model->getStrategy(),
            'joinempty' => $model->getJoinempty(),
            'leavewhenempty' => $model->getLeavewhenempty(),
            'reportholdtime' => $model->getReportholdtime(),
            'memberdelay' => $model->getMemberdelay(),
            'weight' => $model->getWeight(),
            'timeoutrestart' => $model->getTimeoutrestart(),
            'defaultrule' => $model->getDefaultrule(),
            'timeoutpriority' => $model->getTimeoutpriority(),
        );

        return $result;
    }

    /**
     * Returns the DbTable class associated with this mapper
     *
     * @return Oasis\\Mapper\\Sql\\DbTable\\AstQueues
     */
    public function getDbTable()
    {
        if (is_null($this->_dbTable)) {
            $this->setDbTable('Oasis\\Mapper\\Sql\\DbTable\\AstQueues');
        }

        return $this->_dbTable;
    }

    /**
     * Deletes the current model
     *
     * @param Oasis\Model\Raw\AstQueues $model The model to delete
     * @see Oasis\Mapper\DbTable\TableAbstract::delete()
     * @return int
     */
    public function delete(\Oasis\Model\Raw\ModelAbstract $model)
    {
        if (!$model instanceof \Oasis\Model\Raw\AstQueues) {
            if (is_object($model)) {
                $message = get_class($model) . " is not a \\Oasis\\Model\\AstQueues object in delete for " . get_class($this);
            } else {
                $message = "$model is not a \\Oasis\\Model\\AstQueues object in delete for " . get_class($this);
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

                        $relDbAdapName = 'Oasis\\Mapper\\Sql\\DbTable\\' . $depList[$capitalizedFk]["table_name"];
                        $depMapperName = 'Oasis\\Mapper\\Sql\\' . $depList[$capitalizedFk]["table_name"];
                        $depModelName = 'Oasis\\Model\\' . $depList[$capitalizedFk]["table_name"];

                        if ( class_exists($relDbAdapName) && class_exists($depModelName) ) {

                            $relDbAdapter = new $relDbAdapName;
                            $references = $relDbAdapter->getReference('Oasis\\Mapper\\Sql\\DbTable\\AstQueues', $capitalizedFk);

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

                        $relDbAdapName = 'Oasis\\Mapper\\Sql\\DbTable\\' . $depList[$capitalizedFk]["table_name"];
                        $depMapperName = 'Oasis\\Mapper\\Sql\\' . $depList[$capitalizedFk]["table_name"];
                        $depModelName = 'Oasis\\Model\\' . $depList[$capitalizedFk]["table_name"];

                        if ( class_exists($relDbAdapName) && class_exists($depModelName) ) {

                            $relDbAdapter = new $relDbAdapName;
                            $references = $relDbAdapter->getReference('Oasis\\Mapper\\Sql\\DbTable\\AstQueues', $capitalizedFk);

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

            $where = $dbAdapter->quoteInto($dbAdapter->quoteIdentifier('name') . ' = ?', $model->getName());
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
     * @return boolean If the save action was successful
     */
    public function save(\Oasis\Model\Raw\AstQueues $model)
    {
        return $this->_save($model, false, false);
    }

    /**
     * Saves current and all dependent rows
     *
     * @param \Oasis\Model\Raw\AstQueues $model
     * @param boolean $useTransaction Flag to indicate if save should be done inside a database transaction
     * @return boolean If the save action was successful
     */
    public function saveRecursive(\Oasis\Model\Raw\AstQueues $model, $useTransaction = true, $transactionTag = null)
    {
        return $this->_save($model, true, $useTransaction, $transactionTag);
    }

    protected function _save(\Oasis\Model\Raw\AstQueues $model,
        $recursive = false, $useTransaction = true, $transactionTag = null
    )
    {
        $this->_setCleanUrlIdentifiers($model);

        $fileObjects = array();

        $availableObjects = $model->getFileObjects();
        $fileSpects = array();

        foreach ($availableObjects as $item) {

            $objectMethod = 'fetch' . $item;
            $fso = $model->$objectMethod(false);

            if (!is_null($fso) && $fso->mustFlush()) {

                $fileObjects[$item] = $fso;
                $specMethod = 'get' . $item . 'Specs';
                $fileSpects[$item] = $model->$specMethod();

                $fileSizeSetter = 'set' . $fileSpects[$item]['sizeName'];
                $baseNameSetter = 'set' . $fileSpects[$item]['baseNameName'];
                $mimeTypeSetter = 'set' . $fileSpects[$item]['mimeName'];

                $model->$fileSizeSetter($fso->getSize())
                      ->$baseNameSetter($fso->getBaseName())
                      ->$mimeTypeSetter($fso->getMimeType());
            }
        }

        $data = $model->sanitize()->toArray();

        $primaryKey = $model->getName();
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

        unset($data['name']);

        try {
            if (is_null($primaryKey) || empty($primaryKey)) {

                $primaryKey = $this->getDbTable()->insert($data);

                if ($primaryKey) {
                    $model->setName($primaryKey);
                } else {
                    throw new \Exception("Insert sentence did not return a valid primary key", 9000);
                }

                if ($this->_cache) {

                    $parentList = $model->getParentList();

                    foreach ($parentList as $constraint => $values) {

                        $refTable = $this->getDbTable();

                        $ref = $refTable->getReference('Oasis\\Mapper\\Sql\\DbTable\\' . $values["table_name"], $constraint);
                        $column = array_shift($ref["columns"]);

                        $cacheHash = 'Oasis\\Model\\' . $values["table_name"] . '_' . $data[$column] .'_' . $constraint;

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
                             $this->getDbTable()->getAdapter()->quoteIdentifier('name') . ' = ?' => $primaryKey
                         )
                     );
            }

            if (is_numeric($primaryKey) && !empty($fileObjects)) {

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
     * @param Oasis\Model\Raw\AstQueues|null $entry The object to load the data into, or null to have one created
     * @return Oasis\Model\Raw\AstQueues The model with the data provided
     */
    public function loadModel($data, $entry = null)
    {
        if (!$entry) {
            $entry = new \Oasis\Model\AstQueues();
        }

        // We don't need to log changes as we will reset them later...
        $entry->stopChangeLog();

        if (is_array($data)) {
            $entry->setName($data['name'])
                  ->setAstMusiconhold($data['ast_musiconhold'])
                  ->setAnnounce($data['announce'])
                  ->setContext($data['context'])
                  ->setTimeout($data['timeout'])
                  ->setRinginuse($data['ringinuse'])
                  ->setSetinterfacevar($data['setinterfacevar'])
                  ->setSetqueuevar($data['setqueuevar'])
                  ->setSetqueueentryvar($data['setqueueentryvar'])
                  ->setMonitorFormat($data['monitor_format'])
                  ->setMembermacro($data['membermacro'])
                  ->setMembergosub($data['membergosub'])
                  ->setQueueYouarenext($data['queue_youarenext'])
                  ->setQueueThereare($data['queue_thereare'])
                  ->setQueueCallswaiting($data['queue_callswaiting'])
                  ->setQueueQuantity1($data['queue_quantity1'])
                  ->setQueueQuantity2($data['queue_quantity2'])
                  ->setQueueHoldtime($data['queue_holdtime'])
                  ->setQueueMinutes($data['queue_minutes'])
                  ->setQueueMinute($data['queue_minute'])
                  ->setQueueSeconds($data['queue_seconds'])
                  ->setQueueThankyou($data['queue_thankyou'])
                  ->setQueueCallerannounce($data['queue_callerannounce'])
                  ->setQueueReporthold($data['queue_reporthold'])
                  ->setAnnounceFrequency($data['announce_frequency'])
                  ->setAnnounceToFirstUser($data['announce_to_first_user'])
                  ->setMinAnnounceFrequency($data['min_announce_frequency'])
                  ->setAnnounceRoundSeconds($data['announce_round_seconds'])
                  ->setAnnounceHoldtime($data['announce_holdtime'])
                  ->setAnnouncePosition($data['announce_position'])
                  ->setAnnouncePositionLimit($data['announce_position_limit'])
                  ->setPeriodicAnnounce($data['periodic_announce'])
                  ->setPeriodicAnnounceFrequency($data['periodic_announce_frequency'])
                  ->setRelativePeriodicAnnounce($data['relative_periodic_announce'])
                  ->setRandomPeriodicAnnounce($data['random_periodic_announce'])
                  ->setRetry($data['retry'])
                  ->setWrapuptime($data['wrapuptime'])
                  ->setPenaltymemberslimit($data['penaltymemberslimit'])
                  ->setAutofill($data['autofill'])
                  ->setMonitorType($data['monitor_type'])
                  ->setAutopause($data['autopause'])
                  ->setAutopausedelay($data['autopausedelay'])
                  ->setAutopausebusy($data['autopausebusy'])
                  ->setAutopauseunavail($data['autopauseunavail'])
                  ->setMaxlen($data['maxlen'])
                  ->setServicelevel($data['servicelevel'])
                  ->setStrategy($data['strategy'])
                  ->setJoinempty($data['joinempty'])
                  ->setLeavewhenempty($data['leavewhenempty'])
                  ->setReportholdtime($data['reportholdtime'])
                  ->setMemberdelay($data['memberdelay'])
                  ->setWeight($data['weight'])
                  ->setTimeoutrestart($data['timeoutrestart'])
                  ->setDefaultrule($data['defaultrule'])
                  ->setTimeoutpriority($data['timeoutpriority']);
        } else if ($data instanceof \Zend_Db_Table_Row_Abstract || $data instanceof \stdClass) {
            $entry->setName($data->{'name'})
                  ->setAstMusiconhold($data->{'ast_musiconhold'})
                  ->setAnnounce($data->{'announce'})
                  ->setContext($data->{'context'})
                  ->setTimeout($data->{'timeout'})
                  ->setRinginuse($data->{'ringinuse'})
                  ->setSetinterfacevar($data->{'setinterfacevar'})
                  ->setSetqueuevar($data->{'setqueuevar'})
                  ->setSetqueueentryvar($data->{'setqueueentryvar'})
                  ->setMonitorFormat($data->{'monitor_format'})
                  ->setMembermacro($data->{'membermacro'})
                  ->setMembergosub($data->{'membergosub'})
                  ->setQueueYouarenext($data->{'queue_youarenext'})
                  ->setQueueThereare($data->{'queue_thereare'})
                  ->setQueueCallswaiting($data->{'queue_callswaiting'})
                  ->setQueueQuantity1($data->{'queue_quantity1'})
                  ->setQueueQuantity2($data->{'queue_quantity2'})
                  ->setQueueHoldtime($data->{'queue_holdtime'})
                  ->setQueueMinutes($data->{'queue_minutes'})
                  ->setQueueMinute($data->{'queue_minute'})
                  ->setQueueSeconds($data->{'queue_seconds'})
                  ->setQueueThankyou($data->{'queue_thankyou'})
                  ->setQueueCallerannounce($data->{'queue_callerannounce'})
                  ->setQueueReporthold($data->{'queue_reporthold'})
                  ->setAnnounceFrequency($data->{'announce_frequency'})
                  ->setAnnounceToFirstUser($data->{'announce_to_first_user'})
                  ->setMinAnnounceFrequency($data->{'min_announce_frequency'})
                  ->setAnnounceRoundSeconds($data->{'announce_round_seconds'})
                  ->setAnnounceHoldtime($data->{'announce_holdtime'})
                  ->setAnnouncePosition($data->{'announce_position'})
                  ->setAnnouncePositionLimit($data->{'announce_position_limit'})
                  ->setPeriodicAnnounce($data->{'periodic_announce'})
                  ->setPeriodicAnnounceFrequency($data->{'periodic_announce_frequency'})
                  ->setRelativePeriodicAnnounce($data->{'relative_periodic_announce'})
                  ->setRandomPeriodicAnnounce($data->{'random_periodic_announce'})
                  ->setRetry($data->{'retry'})
                  ->setWrapuptime($data->{'wrapuptime'})
                  ->setPenaltymemberslimit($data->{'penaltymemberslimit'})
                  ->setAutofill($data->{'autofill'})
                  ->setMonitorType($data->{'monitor_type'})
                  ->setAutopause($data->{'autopause'})
                  ->setAutopausedelay($data->{'autopausedelay'})
                  ->setAutopausebusy($data->{'autopausebusy'})
                  ->setAutopauseunavail($data->{'autopauseunavail'})
                  ->setMaxlen($data->{'maxlen'})
                  ->setServicelevel($data->{'servicelevel'})
                  ->setStrategy($data->{'strategy'})
                  ->setJoinempty($data->{'joinempty'})
                  ->setLeavewhenempty($data->{'leavewhenempty'})
                  ->setReportholdtime($data->{'reportholdtime'})
                  ->setMemberdelay($data->{'memberdelay'})
                  ->setWeight($data->{'weight'})
                  ->setTimeoutrestart($data->{'timeoutrestart'})
                  ->setDefaultrule($data->{'defaultrule'})
                  ->setTimeoutpriority($data->{'timeoutpriority'});

        } else if ($data instanceof \Oasis\Model\Raw\AstQueues) {
            $entry->setName($data->getName())
                  ->setAstMusiconhold($data->getAstMusiconhold())
                  ->setAnnounce($data->getAnnounce())
                  ->setContext($data->getContext())
                  ->setTimeout($data->getTimeout())
                  ->setRinginuse($data->getRinginuse())
                  ->setSetinterfacevar($data->getSetinterfacevar())
                  ->setSetqueuevar($data->getSetqueuevar())
                  ->setSetqueueentryvar($data->getSetqueueentryvar())
                  ->setMonitorFormat($data->getMonitorFormat())
                  ->setMembermacro($data->getMembermacro())
                  ->setMembergosub($data->getMembergosub())
                  ->setQueueYouarenext($data->getQueueYouarenext())
                  ->setQueueThereare($data->getQueueThereare())
                  ->setQueueCallswaiting($data->getQueueCallswaiting())
                  ->setQueueQuantity1($data->getQueueQuantity1())
                  ->setQueueQuantity2($data->getQueueQuantity2())
                  ->setQueueHoldtime($data->getQueueHoldtime())
                  ->setQueueMinutes($data->getQueueMinutes())
                  ->setQueueMinute($data->getQueueMinute())
                  ->setQueueSeconds($data->getQueueSeconds())
                  ->setQueueThankyou($data->getQueueThankyou())
                  ->setQueueCallerannounce($data->getQueueCallerannounce())
                  ->setQueueReporthold($data->getQueueReporthold())
                  ->setAnnounceFrequency($data->getAnnounceFrequency())
                  ->setAnnounceToFirstUser($data->getAnnounceToFirstUser())
                  ->setMinAnnounceFrequency($data->getMinAnnounceFrequency())
                  ->setAnnounceRoundSeconds($data->getAnnounceRoundSeconds())
                  ->setAnnounceHoldtime($data->getAnnounceHoldtime())
                  ->setAnnouncePosition($data->getAnnouncePosition())
                  ->setAnnouncePositionLimit($data->getAnnouncePositionLimit())
                  ->setPeriodicAnnounce($data->getPeriodicAnnounce())
                  ->setPeriodicAnnounceFrequency($data->getPeriodicAnnounceFrequency())
                  ->setRelativePeriodicAnnounce($data->getRelativePeriodicAnnounce())
                  ->setRandomPeriodicAnnounce($data->getRandomPeriodicAnnounce())
                  ->setRetry($data->getRetry())
                  ->setWrapuptime($data->getWrapuptime())
                  ->setPenaltymemberslimit($data->getPenaltymemberslimit())
                  ->setAutofill($data->getAutofill())
                  ->setMonitorType($data->getMonitorType())
                  ->setAutopause($data->getAutopause())
                  ->setAutopausedelay($data->getAutopausedelay())
                  ->setAutopausebusy($data->getAutopausebusy())
                  ->setAutopauseunavail($data->getAutopauseunavail())
                  ->setMaxlen($data->getMaxlen())
                  ->setServicelevel($data->getServicelevel())
                  ->setStrategy($data->getStrategy())
                  ->setJoinempty($data->getJoinempty())
                  ->setLeavewhenempty($data->getLeavewhenempty())
                  ->setReportholdtime($data->getReportholdtime())
                  ->setMemberdelay($data->getMemberdelay())
                  ->setWeight($data->getWeight())
                  ->setTimeoutrestart($data->getTimeoutrestart())
                  ->setDefaultrule($data->getDefaultrule())
                  ->setTimeoutpriority($data->getTimeoutpriority());

        }

        $entry->resetChangeLog()->initChangeLog()->setMapper($this);

        return $entry;
    }
}
