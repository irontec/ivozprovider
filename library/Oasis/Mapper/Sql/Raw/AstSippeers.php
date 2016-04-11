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
 * Data Mapper implementation for Oasis\Model\AstSippeers
 *
 * @package Oasis\Mapper\Sql
 * @subpackage Raw
 * @author Luis Felipe Garcia
 */

namespace Oasis\Mapper\Sql\Raw;
class AstSippeers extends MapperAbstract
{
    protected $_modelName = 'Oasis\\Model\\AstSippeers';


    protected $_urlIdentifiers = array();

    /**
     * Returns an array, keys are the field names.
     *
     * @param Oasis\Model\Raw\AstSippeers $model
     * @return array
     */
    public function toArray($model)
    {
        if (!$model instanceof \Oasis\Model\Raw\AstSippeers) {
            if (is_object($model)) {
                $message = get_class($model) . " is not a \Oasis\Model\Raw\AstSippeers object in toArray for " . get_class($this);
            } else {
                $message = "$model is not a \\Oasis\Model\\AstSippeers object in toArray for " . get_class($this);
            }

            $this->_logger->log($message, \Zend_Log::ERR);
            throw new \Exception('Unable to create array: invalid model passed to mapper', 2000);
        }

        $result = array(
            'id' => $model->getId(),
            'name' => $model->getName(),
            'ipaddr' => $model->getIpaddr(),
            'port' => $model->getPort(),
            'regseconds' => $model->getRegseconds(),
            'defaultuser' => $model->getDefaultuser(),
            'fullcontact' => $model->getFullcontact(),
            'regserver' => $model->getRegserver(),
            'useragent' => $model->getUseragent(),
            'lastms' => $model->getLastms(),
            'host' => $model->getHost(),
            'type' => $model->getType(),
            'context' => $model->getContext(),
            'permit' => $model->getPermit(),
            'deny' => $model->getDeny(),
            'secret' => $model->getSecret(),
            'md5secret' => $model->getMd5secret(),
            'remotesecret' => $model->getRemotesecret(),
            'transport' => $model->getTransport(),
            'dtmfmode' => $model->getDtmfmode(),
            'directmedia' => $model->getDirectmedia(),
            'nat' => $model->getNat(),
            'callgroup' => $model->getCallgroup(),
            'pickupgroup' => $model->getPickupgroup(),
            'language' => $model->getLanguage(),
            'disallow' => $model->getDisallow(),
            'allow' => $model->getAllow(),
            'insecure' => $model->getInsecure(),
            'trustrpid' => $model->getTrustrpid(),
            'progressinband' => $model->getProgressinband(),
            'promiscredir' => $model->getPromiscredir(),
            'useclientcode' => $model->getUseclientcode(),
            'accountcode' => $model->getAccountcode(),
            'setvar' => $model->getSetvar(),
            'callerid' => $model->getCallerid(),
            'amaflags' => $model->getAmaflags(),
            'callcounter' => $model->getCallcounter(),
            'busylevel' => $model->getBusylevel(),
            'allowoverlap' => $model->getAllowoverlap(),
            'allowsubscribe' => $model->getAllowsubscribe(),
            'videosupport' => $model->getVideosupport(),
            'maxcallbitrate' => $model->getMaxcallbitrate(),
            'rfc2833compensate' => $model->getRfc2833compensate(),
            'mailbox' => $model->getMailbox(),
            'session-timers' => $model->getSessionTimers(),
            'session-expires' => $model->getSessionExpires(),
            'session-minse' => $model->getSessionMinse(),
            'session-refresher' => $model->getSessionRefresher(),
            't38pt_usertpsource' => $model->getT38ptUsertpsource(),
            'regexten' => $model->getRegexten(),
            'fromdomain' => $model->getFromdomain(),
            'fromuser' => $model->getFromuser(),
            'qualify' => $model->getQualify(),
            'defaultip' => $model->getDefaultip(),
            'rtptimeout' => $model->getRtptimeout(),
            'rtpholdtimeout' => $model->getRtpholdtimeout(),
            'sendrpid' => $model->getSendrpid(),
            'outboundproxy' => $model->getOutboundproxy(),
            'callbackextension' => $model->getCallbackextension(),
            'timert1' => $model->getTimert1(),
            'timerb' => $model->getTimerb(),
            'qualifyfreq' => $model->getQualifyfreq(),
            'constantssrc' => $model->getConstantssrc(),
            'contactpermit' => $model->getContactpermit(),
            'contactdeny' => $model->getContactdeny(),
            'usereqphone' => $model->getUsereqphone(),
            'textsupport' => $model->getTextsupport(),
            'faxdetect' => $model->getFaxdetect(),
            'buggymwi' => $model->getBuggymwi(),
            'auth' => $model->getAuth(),
            'fullname' => $model->getFullname(),
            'trunkname' => $model->getTrunkname(),
            'cid_number' => $model->getCidNumber(),
            'callingpres' => $model->getCallingpres(),
            'mohinterpret' => $model->getMohinterpret(),
            'mohsuggest' => $model->getMohsuggest(),
            'parkinglot' => $model->getParkinglot(),
            'hasast_voicemail' => $model->getHasastVoicemail(),
            'subscribemwi' => $model->getSubscribemwi(),
            'vmexten' => $model->getVmexten(),
            'autoframing' => $model->getAutoframing(),
            'rtpkeepalive' => $model->getRtpkeepalive(),
            'call-limit' => $model->getCallLimit(),
            'g726nonstandard' => $model->getG726nonstandard(),
            'ignoresdpversion' => $model->getIgnoresdpversion(),
            'allowtransfer' => $model->getAllowtransfer(),
            'dynamic' => $model->getDynamic(),
            'path' => $model->getPath(),
            'supportpath' => $model->getSupportpath(),
        );

        return $result;
    }

    /**
     * Returns the DbTable class associated with this mapper
     *
     * @return Oasis\\Mapper\\Sql\\DbTable\\AstSippeers
     */
    public function getDbTable()
    {
        if (is_null($this->_dbTable)) {
            $this->setDbTable('Oasis\\Mapper\\Sql\\DbTable\\AstSippeers');
        }

        return $this->_dbTable;
    }

    /**
     * Deletes the current model
     *
     * @param Oasis\Model\Raw\AstSippeers $model The model to delete
     * @see Oasis\Mapper\DbTable\TableAbstract::delete()
     * @return int
     */
    public function delete(\Oasis\Model\Raw\ModelAbstract $model)
    {
        if (!$model instanceof \Oasis\Model\Raw\AstSippeers) {
            if (is_object($model)) {
                $message = get_class($model) . " is not a \\Oasis\\Model\\AstSippeers object in delete for " . get_class($this);
            } else {
                $message = "$model is not a \\Oasis\\Model\\AstSippeers object in delete for " . get_class($this);
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
                            $references = $relDbAdapter->getReference('Oasis\\Mapper\\Sql\\DbTable\\AstSippeers', $capitalizedFk);

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
                            $references = $relDbAdapter->getReference('Oasis\\Mapper\\Sql\\DbTable\\AstSippeers', $capitalizedFk);

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
     * @return boolean If the save action was successful
     */
    public function save(\Oasis\Model\Raw\AstSippeers $model)
    {
        return $this->_save($model, false, false);
    }

    /**
     * Saves current and all dependent rows
     *
     * @param \Oasis\Model\Raw\AstSippeers $model
     * @param boolean $useTransaction Flag to indicate if save should be done inside a database transaction
     * @return boolean If the save action was successful
     */
    public function saveRecursive(\Oasis\Model\Raw\AstSippeers $model, $useTransaction = true, $transactionTag = null)
    {
        return $this->_save($model, true, $useTransaction, $transactionTag);
    }

    protected function _save(\Oasis\Model\Raw\AstSippeers $model,
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

        unset($data['id']);

        try {
            if (is_null($primaryKey) || empty($primaryKey)) {

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
                             $this->getDbTable()->getAdapter()->quoteIdentifier('id') . ' = ?' => $primaryKey
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
     * @param Oasis\Model\Raw\AstSippeers|null $entry The object to load the data into, or null to have one created
     * @return Oasis\Model\Raw\AstSippeers The model with the data provided
     */
    public function loadModel($data, $entry = null)
    {
        if (!$entry) {
            $entry = new \Oasis\Model\AstSippeers();
        }

        // We don't need to log changes as we will reset them later...
        $entry->stopChangeLog();

        if (is_array($data)) {
            $entry->setId($data['id'])
                  ->setName($data['name'])
                  ->setIpaddr($data['ipaddr'])
                  ->setPort($data['port'])
                  ->setRegseconds($data['regseconds'])
                  ->setDefaultuser($data['defaultuser'])
                  ->setFullcontact($data['fullcontact'])
                  ->setRegserver($data['regserver'])
                  ->setUseragent($data['useragent'])
                  ->setLastms($data['lastms'])
                  ->setHost($data['host'])
                  ->setType($data['type'])
                  ->setContext($data['context'])
                  ->setPermit($data['permit'])
                  ->setDeny($data['deny'])
                  ->setSecret($data['secret'])
                  ->setMd5secret($data['md5secret'])
                  ->setRemotesecret($data['remotesecret'])
                  ->setTransport($data['transport'])
                  ->setDtmfmode($data['dtmfmode'])
                  ->setDirectmedia($data['directmedia'])
                  ->setNat($data['nat'])
                  ->setCallgroup($data['callgroup'])
                  ->setPickupgroup($data['pickupgroup'])
                  ->setLanguage($data['language'])
                  ->setDisallow($data['disallow'])
                  ->setAllow($data['allow'])
                  ->setInsecure($data['insecure'])
                  ->setTrustrpid($data['trustrpid'])
                  ->setProgressinband($data['progressinband'])
                  ->setPromiscredir($data['promiscredir'])
                  ->setUseclientcode($data['useclientcode'])
                  ->setAccountcode($data['accountcode'])
                  ->setSetvar($data['setvar'])
                  ->setCallerid($data['callerid'])
                  ->setAmaflags($data['amaflags'])
                  ->setCallcounter($data['callcounter'])
                  ->setBusylevel($data['busylevel'])
                  ->setAllowoverlap($data['allowoverlap'])
                  ->setAllowsubscribe($data['allowsubscribe'])
                  ->setVideosupport($data['videosupport'])
                  ->setMaxcallbitrate($data['maxcallbitrate'])
                  ->setRfc2833compensate($data['rfc2833compensate'])
                  ->setMailbox($data['mailbox'])
                  ->setSessionTimers($data['session-timers'])
                  ->setSessionExpires($data['session-expires'])
                  ->setSessionMinse($data['session-minse'])
                  ->setSessionRefresher($data['session-refresher'])
                  ->setT38ptUsertpsource($data['t38pt_usertpsource'])
                  ->setRegexten($data['regexten'])
                  ->setFromdomain($data['fromdomain'])
                  ->setFromuser($data['fromuser'])
                  ->setQualify($data['qualify'])
                  ->setDefaultip($data['defaultip'])
                  ->setRtptimeout($data['rtptimeout'])
                  ->setRtpholdtimeout($data['rtpholdtimeout'])
                  ->setSendrpid($data['sendrpid'])
                  ->setOutboundproxy($data['outboundproxy'])
                  ->setCallbackextension($data['callbackextension'])
                  ->setTimert1($data['timert1'])
                  ->setTimerb($data['timerb'])
                  ->setQualifyfreq($data['qualifyfreq'])
                  ->setConstantssrc($data['constantssrc'])
                  ->setContactpermit($data['contactpermit'])
                  ->setContactdeny($data['contactdeny'])
                  ->setUsereqphone($data['usereqphone'])
                  ->setTextsupport($data['textsupport'])
                  ->setFaxdetect($data['faxdetect'])
                  ->setBuggymwi($data['buggymwi'])
                  ->setAuth($data['auth'])
                  ->setFullname($data['fullname'])
                  ->setTrunkname($data['trunkname'])
                  ->setCidNumber($data['cid_number'])
                  ->setCallingpres($data['callingpres'])
                  ->setMohinterpret($data['mohinterpret'])
                  ->setMohsuggest($data['mohsuggest'])
                  ->setParkinglot($data['parkinglot'])
                  ->setHasastVoicemail($data['hasast_voicemail'])
                  ->setSubscribemwi($data['subscribemwi'])
                  ->setVmexten($data['vmexten'])
                  ->setAutoframing($data['autoframing'])
                  ->setRtpkeepalive($data['rtpkeepalive'])
                  ->setCallLimit($data['call-limit'])
                  ->setG726nonstandard($data['g726nonstandard'])
                  ->setIgnoresdpversion($data['ignoresdpversion'])
                  ->setAllowtransfer($data['allowtransfer'])
                  ->setDynamic($data['dynamic'])
                  ->setPath($data['path'])
                  ->setSupportpath($data['supportpath']);
        } else if ($data instanceof \Zend_Db_Table_Row_Abstract || $data instanceof \stdClass) {
            $entry->setId($data->{'id'})
                  ->setName($data->{'name'})
                  ->setIpaddr($data->{'ipaddr'})
                  ->setPort($data->{'port'})
                  ->setRegseconds($data->{'regseconds'})
                  ->setDefaultuser($data->{'defaultuser'})
                  ->setFullcontact($data->{'fullcontact'})
                  ->setRegserver($data->{'regserver'})
                  ->setUseragent($data->{'useragent'})
                  ->setLastms($data->{'lastms'})
                  ->setHost($data->{'host'})
                  ->setType($data->{'type'})
                  ->setContext($data->{'context'})
                  ->setPermit($data->{'permit'})
                  ->setDeny($data->{'deny'})
                  ->setSecret($data->{'secret'})
                  ->setMd5secret($data->{'md5secret'})
                  ->setRemotesecret($data->{'remotesecret'})
                  ->setTransport($data->{'transport'})
                  ->setDtmfmode($data->{'dtmfmode'})
                  ->setDirectmedia($data->{'directmedia'})
                  ->setNat($data->{'nat'})
                  ->setCallgroup($data->{'callgroup'})
                  ->setPickupgroup($data->{'pickupgroup'})
                  ->setLanguage($data->{'language'})
                  ->setDisallow($data->{'disallow'})
                  ->setAllow($data->{'allow'})
                  ->setInsecure($data->{'insecure'})
                  ->setTrustrpid($data->{'trustrpid'})
                  ->setProgressinband($data->{'progressinband'})
                  ->setPromiscredir($data->{'promiscredir'})
                  ->setUseclientcode($data->{'useclientcode'})
                  ->setAccountcode($data->{'accountcode'})
                  ->setSetvar($data->{'setvar'})
                  ->setCallerid($data->{'callerid'})
                  ->setAmaflags($data->{'amaflags'})
                  ->setCallcounter($data->{'callcounter'})
                  ->setBusylevel($data->{'busylevel'})
                  ->setAllowoverlap($data->{'allowoverlap'})
                  ->setAllowsubscribe($data->{'allowsubscribe'})
                  ->setVideosupport($data->{'videosupport'})
                  ->setMaxcallbitrate($data->{'maxcallbitrate'})
                  ->setRfc2833compensate($data->{'rfc2833compensate'})
                  ->setMailbox($data->{'mailbox'})
                  ->setSessionTimers($data->{'session-timers'})
                  ->setSessionExpires($data->{'session-expires'})
                  ->setSessionMinse($data->{'session-minse'})
                  ->setSessionRefresher($data->{'session-refresher'})
                  ->setT38ptUsertpsource($data->{'t38pt_usertpsource'})
                  ->setRegexten($data->{'regexten'})
                  ->setFromdomain($data->{'fromdomain'})
                  ->setFromuser($data->{'fromuser'})
                  ->setQualify($data->{'qualify'})
                  ->setDefaultip($data->{'defaultip'})
                  ->setRtptimeout($data->{'rtptimeout'})
                  ->setRtpholdtimeout($data->{'rtpholdtimeout'})
                  ->setSendrpid($data->{'sendrpid'})
                  ->setOutboundproxy($data->{'outboundproxy'})
                  ->setCallbackextension($data->{'callbackextension'})
                  ->setTimert1($data->{'timert1'})
                  ->setTimerb($data->{'timerb'})
                  ->setQualifyfreq($data->{'qualifyfreq'})
                  ->setConstantssrc($data->{'constantssrc'})
                  ->setContactpermit($data->{'contactpermit'})
                  ->setContactdeny($data->{'contactdeny'})
                  ->setUsereqphone($data->{'usereqphone'})
                  ->setTextsupport($data->{'textsupport'})
                  ->setFaxdetect($data->{'faxdetect'})
                  ->setBuggymwi($data->{'buggymwi'})
                  ->setAuth($data->{'auth'})
                  ->setFullname($data->{'fullname'})
                  ->setTrunkname($data->{'trunkname'})
                  ->setCidNumber($data->{'cid_number'})
                  ->setCallingpres($data->{'callingpres'})
                  ->setMohinterpret($data->{'mohinterpret'})
                  ->setMohsuggest($data->{'mohsuggest'})
                  ->setParkinglot($data->{'parkinglot'})
                  ->setHasastVoicemail($data->{'hasast_voicemail'})
                  ->setSubscribemwi($data->{'subscribemwi'})
                  ->setVmexten($data->{'vmexten'})
                  ->setAutoframing($data->{'autoframing'})
                  ->setRtpkeepalive($data->{'rtpkeepalive'})
                  ->setCallLimit($data->{'call-limit'})
                  ->setG726nonstandard($data->{'g726nonstandard'})
                  ->setIgnoresdpversion($data->{'ignoresdpversion'})
                  ->setAllowtransfer($data->{'allowtransfer'})
                  ->setDynamic($data->{'dynamic'})
                  ->setPath($data->{'path'})
                  ->setSupportpath($data->{'supportpath'});

        } else if ($data instanceof \Oasis\Model\Raw\AstSippeers) {
            $entry->setId($data->getId())
                  ->setName($data->getName())
                  ->setIpaddr($data->getIpaddr())
                  ->setPort($data->getPort())
                  ->setRegseconds($data->getRegseconds())
                  ->setDefaultuser($data->getDefaultuser())
                  ->setFullcontact($data->getFullcontact())
                  ->setRegserver($data->getRegserver())
                  ->setUseragent($data->getUseragent())
                  ->setLastms($data->getLastms())
                  ->setHost($data->getHost())
                  ->setType($data->getType())
                  ->setContext($data->getContext())
                  ->setPermit($data->getPermit())
                  ->setDeny($data->getDeny())
                  ->setSecret($data->getSecret())
                  ->setMd5secret($data->getMd5secret())
                  ->setRemotesecret($data->getRemotesecret())
                  ->setTransport($data->getTransport())
                  ->setDtmfmode($data->getDtmfmode())
                  ->setDirectmedia($data->getDirectmedia())
                  ->setNat($data->getNat())
                  ->setCallgroup($data->getCallgroup())
                  ->setPickupgroup($data->getPickupgroup())
                  ->setLanguage($data->getLanguage())
                  ->setDisallow($data->getDisallow())
                  ->setAllow($data->getAllow())
                  ->setInsecure($data->getInsecure())
                  ->setTrustrpid($data->getTrustrpid())
                  ->setProgressinband($data->getProgressinband())
                  ->setPromiscredir($data->getPromiscredir())
                  ->setUseclientcode($data->getUseclientcode())
                  ->setAccountcode($data->getAccountcode())
                  ->setSetvar($data->getSetvar())
                  ->setCallerid($data->getCallerid())
                  ->setAmaflags($data->getAmaflags())
                  ->setCallcounter($data->getCallcounter())
                  ->setBusylevel($data->getBusylevel())
                  ->setAllowoverlap($data->getAllowoverlap())
                  ->setAllowsubscribe($data->getAllowsubscribe())
                  ->setVideosupport($data->getVideosupport())
                  ->setMaxcallbitrate($data->getMaxcallbitrate())
                  ->setRfc2833compensate($data->getRfc2833compensate())
                  ->setMailbox($data->getMailbox())
                  ->setSessionTimers($data->getSessionTimers())
                  ->setSessionExpires($data->getSessionExpires())
                  ->setSessionMinse($data->getSessionMinse())
                  ->setSessionRefresher($data->getSessionRefresher())
                  ->setT38ptUsertpsource($data->getT38ptUsertpsource())
                  ->setRegexten($data->getRegexten())
                  ->setFromdomain($data->getFromdomain())
                  ->setFromuser($data->getFromuser())
                  ->setQualify($data->getQualify())
                  ->setDefaultip($data->getDefaultip())
                  ->setRtptimeout($data->getRtptimeout())
                  ->setRtpholdtimeout($data->getRtpholdtimeout())
                  ->setSendrpid($data->getSendrpid())
                  ->setOutboundproxy($data->getOutboundproxy())
                  ->setCallbackextension($data->getCallbackextension())
                  ->setTimert1($data->getTimert1())
                  ->setTimerb($data->getTimerb())
                  ->setQualifyfreq($data->getQualifyfreq())
                  ->setConstantssrc($data->getConstantssrc())
                  ->setContactpermit($data->getContactpermit())
                  ->setContactdeny($data->getContactdeny())
                  ->setUsereqphone($data->getUsereqphone())
                  ->setTextsupport($data->getTextsupport())
                  ->setFaxdetect($data->getFaxdetect())
                  ->setBuggymwi($data->getBuggymwi())
                  ->setAuth($data->getAuth())
                  ->setFullname($data->getFullname())
                  ->setTrunkname($data->getTrunkname())
                  ->setCidNumber($data->getCidNumber())
                  ->setCallingpres($data->getCallingpres())
                  ->setMohinterpret($data->getMohinterpret())
                  ->setMohsuggest($data->getMohsuggest())
                  ->setParkinglot($data->getParkinglot())
                  ->setHasastVoicemail($data->getHasastVoicemail())
                  ->setSubscribemwi($data->getSubscribemwi())
                  ->setVmexten($data->getVmexten())
                  ->setAutoframing($data->getAutoframing())
                  ->setRtpkeepalive($data->getRtpkeepalive())
                  ->setCallLimit($data->getCallLimit())
                  ->setG726nonstandard($data->getG726nonstandard())
                  ->setIgnoresdpversion($data->getIgnoresdpversion())
                  ->setAllowtransfer($data->getAllowtransfer())
                  ->setDynamic($data->getDynamic())
                  ->setPath($data->getPath())
                  ->setSupportpath($data->getSupportpath());

        }

        $entry->resetChangeLog()->initChangeLog()->setMapper($this);

        return $entry;
    }
}
