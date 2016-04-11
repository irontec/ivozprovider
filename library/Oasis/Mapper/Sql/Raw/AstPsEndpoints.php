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
 * Data Mapper implementation for Oasis\Model\AstPsEndpoints
 *
 * @package Oasis\Mapper\Sql
 * @subpackage Raw
 * @author Luis Felipe Garcia
 */

namespace Oasis\Mapper\Sql\Raw;
class AstPsEndpoints extends MapperAbstract
{
    protected $_modelName = 'Oasis\\Model\\AstPsEndpoints';


    protected $_urlIdentifiers = array();

    /**
     * Returns an array, keys are the field names.
     *
     * @param Oasis\Model\Raw\AstPsEndpoints $model
     * @return array
     */
    public function toArray($model)
    {
        if (!$model instanceof \Oasis\Model\Raw\AstPsEndpoints) {
            if (is_object($model)) {
                $message = get_class($model) . " is not a \Oasis\Model\Raw\AstPsEndpoints object in toArray for " . get_class($this);
            } else {
                $message = "$model is not a \\Oasis\Model\\AstPsEndpoints object in toArray for " . get_class($this);
            }

            $this->_logger->log($message, \Zend_Log::ERR);
            throw new \Exception('Unable to create array: invalid model passed to mapper', 2000);
        }

        $result = array(
            'sorcery_id' => $model->getSorceryId(),
            'transport' => $model->getTransport(),
            'aors' => $model->getAors(),
            'auth' => $model->getAuth(),
            'context' => $model->getContext(),
            'disallow' => $model->getDisallow(),
            'allow' => $model->getAllow(),
            'direct_media' => $model->getDirectMedia(),
            'connected_line_method' => $model->getConnectedLineMethod(),
            'direct_media_method' => $model->getDirectMediaMethod(),
            'direct_media_glare_mitigation' => $model->getDirectMediaGlareMitigation(),
            'disable_direct_media_on_nat' => $model->getDisableDirectMediaOnNat(),
            'dtmf_mode' => $model->getDtmfMode(),
            'external_media_address' => $model->getExternalMediaAddress(),
            'force_rport' => $model->getForceRport(),
            'ice_support' => $model->getIceSupport(),
            'identify_by' => $model->getIdentifyBy(),
            'mailboxes' => $model->getMailboxes(),
            'moh_suggest' => $model->getMohSuggest(),
            'outbound_auth' => $model->getOutboundAuth(),
            'outbound_proxy' => $model->getOutboundProxy(),
            'rewrite_contact' => $model->getRewriteContact(),
            'rtp_ipv6' => $model->getRtpIpv6(),
            'rtp_symmetric' => $model->getRtpSymmetric(),
            'send_diversion' => $model->getSendDiversion(),
            'send_pai' => $model->getSendPai(),
            'send_rpid' => $model->getSendRpid(),
            'timers_min_se' => $model->getTimersMinSe(),
            'timers' => $model->getTimers(),
            'timers_sess_expires' => $model->getTimersSessExpires(),
            'callerid' => $model->getCallerid(),
            'callerid_privacy' => $model->getCalleridPrivacy(),
            'callerid_tag' => $model->getCalleridTag(),
            '100rel' => $model->get100rel(),
            'aggregate_mwi' => $model->getAggregateMwi(),
            'trust_id_inbound' => $model->getTrustIdInbound(),
            'trust_id_outbound' => $model->getTrustIdOutbound(),
            'use_ptime' => $model->getUsePtime(),
            'use_avpf' => $model->getUseAvpf(),
            'media_encryption' => $model->getMediaEncryption(),
            'inband_progress' => $model->getInbandProgress(),
            'call_group' => $model->getCallGroup(),
            'pickup_group' => $model->getPickupGroup(),
            'named_call_group' => $model->getNamedCallGroup(),
            'named_pickup_group' => $model->getNamedPickupGroup(),
            'device_state_busy_at' => $model->getDeviceStateBusyAt(),
            'fax_detect' => $model->getFaxDetect(),
            't38_udptl' => $model->getT38Udptl(),
            't38_udptl_ec' => $model->getT38UdptlEc(),
            't38_udptl_maxdatagram' => $model->getT38UdptlMaxdatagram(),
            't38_udptl_nat' => $model->getT38UdptlNat(),
            't38_udptl_ipv6' => $model->getT38UdptlIpv6(),
            'tone_zone' => $model->getToneZone(),
            'language' => $model->getLanguage(),
            'one_touch_recording' => $model->getOneTouchRecording(),
            'record_on_feature' => $model->getRecordOnFeature(),
            'record_off_feature' => $model->getRecordOffFeature(),
            'rtp_engine' => $model->getRtpEngine(),
            'allow_transfer' => $model->getAllowTransfer(),
            'allow_subscribe' => $model->getAllowSubscribe(),
            'sdp_owner' => $model->getSdpOwner(),
            'sdp_session' => $model->getSdpSession(),
            'tos_audio' => $model->getTosAudio(),
            'tos_video' => $model->getTosVideo(),
            'sub_min_expiry' => $model->getSubMinExpiry(),
            'from_domain' => $model->getFromDomain(),
            'from_user' => $model->getFromUser(),
            'mwi_from_user' => $model->getMwiFromUser(),
            'dtls_verify' => $model->getDtlsVerify(),
            'dtls_rekey' => $model->getDtlsRekey(),
            'dtls_cert_file' => $model->getDtlsCertFile(),
            'dtls_private_key' => $model->getDtlsPrivateKey(),
            'dtls_cipher' => $model->getDtlsCipher(),
            'dtls_ca_file' => $model->getDtlsCaFile(),
            'dtls_ca_path' => $model->getDtlsCaPath(),
            'dtls_setup' => $model->getDtlsSetup(),
            'srtp_tag_32' => $model->getSrtpTag32(),
            'media_address' => $model->getMediaAddress(),
            'redirect_method' => $model->getRedirectMethod(),
            'set_var' => $model->getSetVar(),
            'cos_audio' => $model->getCosAudio(),
            'cos_video' => $model->getCosVideo(),
            'message_context' => $model->getMessageContext(),
            'force_avp' => $model->getForceAvp(),
            'media_use_received_transport' => $model->getMediaUseReceivedTransport(),
            'accountcode' => $model->getAccountcode(),
        );

        return $result;
    }

    /**
     * Returns the DbTable class associated with this mapper
     *
     * @return Oasis\\Mapper\\Sql\\DbTable\\AstPsEndpoints
     */
    public function getDbTable()
    {
        if (is_null($this->_dbTable)) {
            $this->setDbTable('Oasis\\Mapper\\Sql\\DbTable\\AstPsEndpoints');
        }

        return $this->_dbTable;
    }

    /**
     * Deletes the current model
     *
     * @param Oasis\Model\Raw\AstPsEndpoints $model The model to delete
     * @see Oasis\Mapper\DbTable\TableAbstract::delete()
     * @return int
     */
    public function delete(\Oasis\Model\Raw\ModelAbstract $model)
    {
        if (!$model instanceof \Oasis\Model\Raw\AstPsEndpoints) {
            if (is_object($model)) {
                $message = get_class($model) . " is not a \\Oasis\\Model\\AstPsEndpoints object in delete for " . get_class($this);
            } else {
                $message = "$model is not a \\Oasis\\Model\\AstPsEndpoints object in delete for " . get_class($this);
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
                            $references = $relDbAdapter->getReference('Oasis\\Mapper\\Sql\\DbTable\\AstPsEndpoints', $capitalizedFk);

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
                            $references = $relDbAdapter->getReference('Oasis\\Mapper\\Sql\\DbTable\\AstPsEndpoints', $capitalizedFk);

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

            $where = $dbAdapter->quoteInto($dbAdapter->quoteIdentifier('sorcery_id') . ' = ?', $model->getSorceryId());
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
    public function save(\Oasis\Model\Raw\AstPsEndpoints $model)
    {
        return $this->_save($model, false, false);
    }

    /**
     * Saves current and all dependent rows
     *
     * @param \Oasis\Model\Raw\AstPsEndpoints $model
     * @param boolean $useTransaction Flag to indicate if save should be done inside a database transaction
     * @return boolean If the save action was successful
     */
    public function saveRecursive(\Oasis\Model\Raw\AstPsEndpoints $model, $useTransaction = true, $transactionTag = null)
    {
        return $this->_save($model, true, $useTransaction, $transactionTag);
    }

    protected function _save(\Oasis\Model\Raw\AstPsEndpoints $model,
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

        $primaryKey = $model->getSorceryId();
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

        unset($data['sorcery_id']);

        try {
            if (is_null($primaryKey) || empty($primaryKey)) {

                $primaryKey = $this->getDbTable()->insert($data);

                if ($primaryKey) {
                    $model->setSorceryId($primaryKey);
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
                             $this->getDbTable()->getAdapter()->quoteIdentifier('sorcery_id') . ' = ?' => $primaryKey
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
     * @param Oasis\Model\Raw\AstPsEndpoints|null $entry The object to load the data into, or null to have one created
     * @return Oasis\Model\Raw\AstPsEndpoints The model with the data provided
     */
    public function loadModel($data, $entry = null)
    {
        if (!$entry) {
            $entry = new \Oasis\Model\AstPsEndpoints();
        }

        // We don't need to log changes as we will reset them later...
        $entry->stopChangeLog();

        if (is_array($data)) {
            $entry->setSorceryId($data['sorcery_id'])
                  ->setTransport($data['transport'])
                  ->setAors($data['aors'])
                  ->setAuth($data['auth'])
                  ->setContext($data['context'])
                  ->setDisallow($data['disallow'])
                  ->setAllow($data['allow'])
                  ->setDirectMedia($data['direct_media'])
                  ->setConnectedLineMethod($data['connected_line_method'])
                  ->setDirectMediaMethod($data['direct_media_method'])
                  ->setDirectMediaGlareMitigation($data['direct_media_glare_mitigation'])
                  ->setDisableDirectMediaOnNat($data['disable_direct_media_on_nat'])
                  ->setDtmfMode($data['dtmf_mode'])
                  ->setExternalMediaAddress($data['external_media_address'])
                  ->setForceRport($data['force_rport'])
                  ->setIceSupport($data['ice_support'])
                  ->setIdentifyBy($data['identify_by'])
                  ->setMailboxes($data['mailboxes'])
                  ->setMohSuggest($data['moh_suggest'])
                  ->setOutboundAuth($data['outbound_auth'])
                  ->setOutboundProxy($data['outbound_proxy'])
                  ->setRewriteContact($data['rewrite_contact'])
                  ->setRtpIpv6($data['rtp_ipv6'])
                  ->setRtpSymmetric($data['rtp_symmetric'])
                  ->setSendDiversion($data['send_diversion'])
                  ->setSendPai($data['send_pai'])
                  ->setSendRpid($data['send_rpid'])
                  ->setTimersMinSe($data['timers_min_se'])
                  ->setTimers($data['timers'])
                  ->setTimersSessExpires($data['timers_sess_expires'])
                  ->setCallerid($data['callerid'])
                  ->setCalleridPrivacy($data['callerid_privacy'])
                  ->setCalleridTag($data['callerid_tag'])
                  ->set100rel($data['100rel'])
                  ->setAggregateMwi($data['aggregate_mwi'])
                  ->setTrustIdInbound($data['trust_id_inbound'])
                  ->setTrustIdOutbound($data['trust_id_outbound'])
                  ->setUsePtime($data['use_ptime'])
                  ->setUseAvpf($data['use_avpf'])
                  ->setMediaEncryption($data['media_encryption'])
                  ->setInbandProgress($data['inband_progress'])
                  ->setCallGroup($data['call_group'])
                  ->setPickupGroup($data['pickup_group'])
                  ->setNamedCallGroup($data['named_call_group'])
                  ->setNamedPickupGroup($data['named_pickup_group'])
                  ->setDeviceStateBusyAt($data['device_state_busy_at'])
                  ->setFaxDetect($data['fax_detect'])
                  ->setT38Udptl($data['t38_udptl'])
                  ->setT38UdptlEc($data['t38_udptl_ec'])
                  ->setT38UdptlMaxdatagram($data['t38_udptl_maxdatagram'])
                  ->setT38UdptlNat($data['t38_udptl_nat'])
                  ->setT38UdptlIpv6($data['t38_udptl_ipv6'])
                  ->setToneZone($data['tone_zone'])
                  ->setLanguage($data['language'])
                  ->setOneTouchRecording($data['one_touch_recording'])
                  ->setRecordOnFeature($data['record_on_feature'])
                  ->setRecordOffFeature($data['record_off_feature'])
                  ->setRtpEngine($data['rtp_engine'])
                  ->setAllowTransfer($data['allow_transfer'])
                  ->setAllowSubscribe($data['allow_subscribe'])
                  ->setSdpOwner($data['sdp_owner'])
                  ->setSdpSession($data['sdp_session'])
                  ->setTosAudio($data['tos_audio'])
                  ->setTosVideo($data['tos_video'])
                  ->setSubMinExpiry($data['sub_min_expiry'])
                  ->setFromDomain($data['from_domain'])
                  ->setFromUser($data['from_user'])
                  ->setMwiFromUser($data['mwi_from_user'])
                  ->setDtlsVerify($data['dtls_verify'])
                  ->setDtlsRekey($data['dtls_rekey'])
                  ->setDtlsCertFile($data['dtls_cert_file'])
                  ->setDtlsPrivateKey($data['dtls_private_key'])
                  ->setDtlsCipher($data['dtls_cipher'])
                  ->setDtlsCaFile($data['dtls_ca_file'])
                  ->setDtlsCaPath($data['dtls_ca_path'])
                  ->setDtlsSetup($data['dtls_setup'])
                  ->setSrtpTag32($data['srtp_tag_32'])
                  ->setMediaAddress($data['media_address'])
                  ->setRedirectMethod($data['redirect_method'])
                  ->setSetVar($data['set_var'])
                  ->setCosAudio($data['cos_audio'])
                  ->setCosVideo($data['cos_video'])
                  ->setMessageContext($data['message_context'])
                  ->setForceAvp($data['force_avp'])
                  ->setMediaUseReceivedTransport($data['media_use_received_transport'])
                  ->setAccountcode($data['accountcode']);
        } else if ($data instanceof \Zend_Db_Table_Row_Abstract || $data instanceof \stdClass) {
            $entry->setSorceryId($data->{'sorcery_id'})
                  ->setTransport($data->{'transport'})
                  ->setAors($data->{'aors'})
                  ->setAuth($data->{'auth'})
                  ->setContext($data->{'context'})
                  ->setDisallow($data->{'disallow'})
                  ->setAllow($data->{'allow'})
                  ->setDirectMedia($data->{'direct_media'})
                  ->setConnectedLineMethod($data->{'connected_line_method'})
                  ->setDirectMediaMethod($data->{'direct_media_method'})
                  ->setDirectMediaGlareMitigation($data->{'direct_media_glare_mitigation'})
                  ->setDisableDirectMediaOnNat($data->{'disable_direct_media_on_nat'})
                  ->setDtmfMode($data->{'dtmf_mode'})
                  ->setExternalMediaAddress($data->{'external_media_address'})
                  ->setForceRport($data->{'force_rport'})
                  ->setIceSupport($data->{'ice_support'})
                  ->setIdentifyBy($data->{'identify_by'})
                  ->setMailboxes($data->{'mailboxes'})
                  ->setMohSuggest($data->{'moh_suggest'})
                  ->setOutboundAuth($data->{'outbound_auth'})
                  ->setOutboundProxy($data->{'outbound_proxy'})
                  ->setRewriteContact($data->{'rewrite_contact'})
                  ->setRtpIpv6($data->{'rtp_ipv6'})
                  ->setRtpSymmetric($data->{'rtp_symmetric'})
                  ->setSendDiversion($data->{'send_diversion'})
                  ->setSendPai($data->{'send_pai'})
                  ->setSendRpid($data->{'send_rpid'})
                  ->setTimersMinSe($data->{'timers_min_se'})
                  ->setTimers($data->{'timers'})
                  ->setTimersSessExpires($data->{'timers_sess_expires'})
                  ->setCallerid($data->{'callerid'})
                  ->setCalleridPrivacy($data->{'callerid_privacy'})
                  ->setCalleridTag($data->{'callerid_tag'})
                  ->set100rel($data->{'100rel'})
                  ->setAggregateMwi($data->{'aggregate_mwi'})
                  ->setTrustIdInbound($data->{'trust_id_inbound'})
                  ->setTrustIdOutbound($data->{'trust_id_outbound'})
                  ->setUsePtime($data->{'use_ptime'})
                  ->setUseAvpf($data->{'use_avpf'})
                  ->setMediaEncryption($data->{'media_encryption'})
                  ->setInbandProgress($data->{'inband_progress'})
                  ->setCallGroup($data->{'call_group'})
                  ->setPickupGroup($data->{'pickup_group'})
                  ->setNamedCallGroup($data->{'named_call_group'})
                  ->setNamedPickupGroup($data->{'named_pickup_group'})
                  ->setDeviceStateBusyAt($data->{'device_state_busy_at'})
                  ->setFaxDetect($data->{'fax_detect'})
                  ->setT38Udptl($data->{'t38_udptl'})
                  ->setT38UdptlEc($data->{'t38_udptl_ec'})
                  ->setT38UdptlMaxdatagram($data->{'t38_udptl_maxdatagram'})
                  ->setT38UdptlNat($data->{'t38_udptl_nat'})
                  ->setT38UdptlIpv6($data->{'t38_udptl_ipv6'})
                  ->setToneZone($data->{'tone_zone'})
                  ->setLanguage($data->{'language'})
                  ->setOneTouchRecording($data->{'one_touch_recording'})
                  ->setRecordOnFeature($data->{'record_on_feature'})
                  ->setRecordOffFeature($data->{'record_off_feature'})
                  ->setRtpEngine($data->{'rtp_engine'})
                  ->setAllowTransfer($data->{'allow_transfer'})
                  ->setAllowSubscribe($data->{'allow_subscribe'})
                  ->setSdpOwner($data->{'sdp_owner'})
                  ->setSdpSession($data->{'sdp_session'})
                  ->setTosAudio($data->{'tos_audio'})
                  ->setTosVideo($data->{'tos_video'})
                  ->setSubMinExpiry($data->{'sub_min_expiry'})
                  ->setFromDomain($data->{'from_domain'})
                  ->setFromUser($data->{'from_user'})
                  ->setMwiFromUser($data->{'mwi_from_user'})
                  ->setDtlsVerify($data->{'dtls_verify'})
                  ->setDtlsRekey($data->{'dtls_rekey'})
                  ->setDtlsCertFile($data->{'dtls_cert_file'})
                  ->setDtlsPrivateKey($data->{'dtls_private_key'})
                  ->setDtlsCipher($data->{'dtls_cipher'})
                  ->setDtlsCaFile($data->{'dtls_ca_file'})
                  ->setDtlsCaPath($data->{'dtls_ca_path'})
                  ->setDtlsSetup($data->{'dtls_setup'})
                  ->setSrtpTag32($data->{'srtp_tag_32'})
                  ->setMediaAddress($data->{'media_address'})
                  ->setRedirectMethod($data->{'redirect_method'})
                  ->setSetVar($data->{'set_var'})
                  ->setCosAudio($data->{'cos_audio'})
                  ->setCosVideo($data->{'cos_video'})
                  ->setMessageContext($data->{'message_context'})
                  ->setForceAvp($data->{'force_avp'})
                  ->setMediaUseReceivedTransport($data->{'media_use_received_transport'})
                  ->setAccountcode($data->{'accountcode'});

        } else if ($data instanceof \Oasis\Model\Raw\AstPsEndpoints) {
            $entry->setSorceryId($data->getSorceryId())
                  ->setTransport($data->getTransport())
                  ->setAors($data->getAors())
                  ->setAuth($data->getAuth())
                  ->setContext($data->getContext())
                  ->setDisallow($data->getDisallow())
                  ->setAllow($data->getAllow())
                  ->setDirectMedia($data->getDirectMedia())
                  ->setConnectedLineMethod($data->getConnectedLineMethod())
                  ->setDirectMediaMethod($data->getDirectMediaMethod())
                  ->setDirectMediaGlareMitigation($data->getDirectMediaGlareMitigation())
                  ->setDisableDirectMediaOnNat($data->getDisableDirectMediaOnNat())
                  ->setDtmfMode($data->getDtmfMode())
                  ->setExternalMediaAddress($data->getExternalMediaAddress())
                  ->setForceRport($data->getForceRport())
                  ->setIceSupport($data->getIceSupport())
                  ->setIdentifyBy($data->getIdentifyBy())
                  ->setMailboxes($data->getMailboxes())
                  ->setMohSuggest($data->getMohSuggest())
                  ->setOutboundAuth($data->getOutboundAuth())
                  ->setOutboundProxy($data->getOutboundProxy())
                  ->setRewriteContact($data->getRewriteContact())
                  ->setRtpIpv6($data->getRtpIpv6())
                  ->setRtpSymmetric($data->getRtpSymmetric())
                  ->setSendDiversion($data->getSendDiversion())
                  ->setSendPai($data->getSendPai())
                  ->setSendRpid($data->getSendRpid())
                  ->setTimersMinSe($data->getTimersMinSe())
                  ->setTimers($data->getTimers())
                  ->setTimersSessExpires($data->getTimersSessExpires())
                  ->setCallerid($data->getCallerid())
                  ->setCalleridPrivacy($data->getCalleridPrivacy())
                  ->setCalleridTag($data->getCalleridTag())
                  ->set100rel($data->get100rel())
                  ->setAggregateMwi($data->getAggregateMwi())
                  ->setTrustIdInbound($data->getTrustIdInbound())
                  ->setTrustIdOutbound($data->getTrustIdOutbound())
                  ->setUsePtime($data->getUsePtime())
                  ->setUseAvpf($data->getUseAvpf())
                  ->setMediaEncryption($data->getMediaEncryption())
                  ->setInbandProgress($data->getInbandProgress())
                  ->setCallGroup($data->getCallGroup())
                  ->setPickupGroup($data->getPickupGroup())
                  ->setNamedCallGroup($data->getNamedCallGroup())
                  ->setNamedPickupGroup($data->getNamedPickupGroup())
                  ->setDeviceStateBusyAt($data->getDeviceStateBusyAt())
                  ->setFaxDetect($data->getFaxDetect())
                  ->setT38Udptl($data->getT38Udptl())
                  ->setT38UdptlEc($data->getT38UdptlEc())
                  ->setT38UdptlMaxdatagram($data->getT38UdptlMaxdatagram())
                  ->setT38UdptlNat($data->getT38UdptlNat())
                  ->setT38UdptlIpv6($data->getT38UdptlIpv6())
                  ->setToneZone($data->getToneZone())
                  ->setLanguage($data->getLanguage())
                  ->setOneTouchRecording($data->getOneTouchRecording())
                  ->setRecordOnFeature($data->getRecordOnFeature())
                  ->setRecordOffFeature($data->getRecordOffFeature())
                  ->setRtpEngine($data->getRtpEngine())
                  ->setAllowTransfer($data->getAllowTransfer())
                  ->setAllowSubscribe($data->getAllowSubscribe())
                  ->setSdpOwner($data->getSdpOwner())
                  ->setSdpSession($data->getSdpSession())
                  ->setTosAudio($data->getTosAudio())
                  ->setTosVideo($data->getTosVideo())
                  ->setSubMinExpiry($data->getSubMinExpiry())
                  ->setFromDomain($data->getFromDomain())
                  ->setFromUser($data->getFromUser())
                  ->setMwiFromUser($data->getMwiFromUser())
                  ->setDtlsVerify($data->getDtlsVerify())
                  ->setDtlsRekey($data->getDtlsRekey())
                  ->setDtlsCertFile($data->getDtlsCertFile())
                  ->setDtlsPrivateKey($data->getDtlsPrivateKey())
                  ->setDtlsCipher($data->getDtlsCipher())
                  ->setDtlsCaFile($data->getDtlsCaFile())
                  ->setDtlsCaPath($data->getDtlsCaPath())
                  ->setDtlsSetup($data->getDtlsSetup())
                  ->setSrtpTag32($data->getSrtpTag32())
                  ->setMediaAddress($data->getMediaAddress())
                  ->setRedirectMethod($data->getRedirectMethod())
                  ->setSetVar($data->getSetVar())
                  ->setCosAudio($data->getCosAudio())
                  ->setCosVideo($data->getCosVideo())
                  ->setMessageContext($data->getMessageContext())
                  ->setForceAvp($data->getForceAvp())
                  ->setMediaUseReceivedTransport($data->getMediaUseReceivedTransport())
                  ->setAccountcode($data->getAccountcode());

        }

        $entry->resetChangeLog()->initChangeLog()->setMapper($this);

        return $entry;
    }
}
