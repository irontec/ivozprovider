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
 * Data Mapper implementation for IvozProvider\Model\Companies
 *
 * @package IvozProvider\Mapper\Sql
 * @subpackage Raw
 * @author Luis Felipe Garcia
 */

namespace IvozProvider\Mapper\Sql\Raw;
class Companies extends MapperAbstract
{
    protected $_modelName = 'IvozProvider\\Model\\Companies';


    protected $_urlIdentifiers = array();

    /**
     * Returns an array, keys are the field names.
     *
     * @param IvozProvider\Model\Raw\Companies $model
     * @return array
     */
    public function toArray($model, $fields = array())
    {

        if (!$model instanceof \IvozProvider\Model\Raw\Companies) {
            if (is_object($model)) {
                $message = get_class($model) . " is not a \IvozProvider\Model\Raw\Companies object in toArray for " . get_class($this);
            } else {
                $message = "$model is not a \\IvozProvider\Model\\Companies object in toArray for " . get_class($this);
            }

            $this->_logger->log($message, \Zend_Log::ERR);
            throw new \Exception('Unable to create array: invalid model passed to mapper', 2000);
        }

        if (empty($fields)) {
            $result = array(
                'id' => $model->getId(),
                'brandId' => $model->getBrandId(),
                'type' => $model->getType(),
                'name' => $model->getName(),
                'domain_users' => $model->getDomainUsers(),
                'nif' => $model->getNif(),
                'defaultTimezoneId' => $model->getDefaultTimezoneId(),
                'applicationServerId' => $model->getApplicationServerId(),
                'externalMaxCalls' => $model->getExternalMaxCalls(),
                'postalAddress' => $model->getPostalAddress(),
                'postalCode' => $model->getPostalCode(),
                'town' => $model->getTown(),
                'province' => $model->getProvince(),
                'country' => $model->getCountry(),
                'outbound_prefix' => $model->getOutboundPrefix(),
                'countryId' => $model->getCountryId(),
                'languageId' => $model->getLanguageId(),
                'mediaRelaySetsId' => $model->getMediaRelaySetsId(),
                'ipFilter' => $model->getIpFilter(),
                'onDemandRecord' => $model->getOnDemandRecord(),
                'onDemandRecordCode' => $model->getOnDemandRecordCode(),
                'areaCode' => $model->getAreaCode(),
                'externallyExtraOpts' => $model->getExternallyExtraOpts(),
                'recordingsLimitMB' => $model->getRecordingsLimitMB(),
                'recordingsLimitEmail' => $model->getRecordingsLimitEmail(),
                'outgoingDDIId' => $model->getOutgoingDDIId(),
                'outgoingDDIRuleId' => $model->getOutgoingDDIRuleId(),
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
     * @return IvozProvider\\Mapper\\Sql\\DbTable\\Companies
     */
    public function getDbTable()
    {
        if (is_null($this->_dbTable)) {
            $this->setDbTable('IvozProvider\\Mapper\\Sql\\DbTable\\Companies');
        }

        return $this->_dbTable;
    }

    /**
     * Deletes the current model
     *
     * @param IvozProvider\Model\Raw\Companies $model The model to delete
     * @see IvozProvider\Mapper\DbTable\TableAbstract::delete()
     * @return int
     */
    public function delete(\IvozProvider\Model\Raw\ModelAbstract $model)
    {
        if (!$model instanceof \IvozProvider\Model\Raw\Companies) {
            if (is_object($model)) {
                $message = get_class($model) . " is not a \\IvozProvider\\Model\\Companies object in delete for " . get_class($this);
            } else {
                $message = "$model is not a \\IvozProvider\\Model\\Companies object in delete for " . get_class($this);
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
                            $references = $relDbAdapter->getReference('IvozProvider\\Mapper\\Sql\\DbTable\\Companies', $capitalizedFk);

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
                            $references = $relDbAdapter->getReference('IvozProvider\\Mapper\\Sql\\DbTable\\Companies', $capitalizedFk);

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
    public function save(\IvozProvider\Model\Raw\Companies $model, $forceInsert = false)
    {
        return $this->_save($model, false, false, null, $forceInsert);
    }

    /**
     * Saves current and all dependent rows
     *
     * @param \IvozProvider\Model\Raw\Companies $model
     * @param boolean $useTransaction Flag to indicate if save should be done inside a database transaction
     * @return integer primary key for autoincrement fields if the save action was successful
     */
    public function saveRecursive(\IvozProvider\Model\Raw\Companies $model, $useTransaction = true,
            $transactionTag = null, $forceInsert = false)
    {
        return $this->_save($model, true, $useTransaction, $transactionTag, $forceInsert);
    }

    protected function _save(\IvozProvider\Model\Raw\Companies $model,
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
                if ($model->getCalendars(null, null, true) !== null) {
                    $calendars = $model->getCalendars();

                    if (!is_array($calendars)) {

                        $calendars = array($calendars);
                    }

                    foreach ($calendars as $value) {
                        $value->setCompanyId($primaryKey)
                              ->saveRecursive(false, $transactionTag);
                    }
                }

                if ($model->getCallACL(null, null, true) !== null) {
                    $callACL = $model->getCallACL();

                    if (!is_array($callACL)) {

                        $callACL = array($callACL);
                    }

                    foreach ($callACL as $value) {
                        $value->setCompanyId($primaryKey)
                              ->saveRecursive(false, $transactionTag);
                    }
                }

                if ($model->getCallACLPatterns(null, null, true) !== null) {
                    $callACLPatterns = $model->getCallACLPatterns();

                    if (!is_array($callACLPatterns)) {

                        $callACLPatterns = array($callACLPatterns);
                    }

                    foreach ($callACLPatterns as $value) {
                        $value->setCompanyId($primaryKey)
                              ->saveRecursive(false, $transactionTag);
                    }
                }

                if ($model->getCompanyAdmins(null, null, true) !== null) {
                    $companyAdmins = $model->getCompanyAdmins();

                    if (!is_array($companyAdmins)) {

                        $companyAdmins = array($companyAdmins);
                    }

                    foreach ($companyAdmins as $value) {
                        $value->setCompanyId($primaryKey)
                              ->saveRecursive(false, $transactionTag);
                    }
                }

                if ($model->getCompanyServices(null, null, true) !== null) {
                    $companyServices = $model->getCompanyServices();

                    if (!is_array($companyServices)) {

                        $companyServices = array($companyServices);
                    }

                    foreach ($companyServices as $value) {
                        $value->setCompanyId($primaryKey)
                              ->saveRecursive(false, $transactionTag);
                    }
                }

                if ($model->getConferenceRooms(null, null, true) !== null) {
                    $conferenceRooms = $model->getConferenceRooms();

                    if (!is_array($conferenceRooms)) {

                        $conferenceRooms = array($conferenceRooms);
                    }

                    foreach ($conferenceRooms as $value) {
                        $value->setCompanyId($primaryKey)
                              ->saveRecursive(false, $transactionTag);
                    }
                }

                if ($model->getDDIs(null, null, true) !== null) {
                    $dDIs = $model->getDDIs();

                    if (!is_array($dDIs)) {

                        $dDIs = array($dDIs);
                    }

                    foreach ($dDIs as $value) {
                        $value->setCompanyId($primaryKey)
                              ->saveRecursive(false, $transactionTag);
                    }
                }

                if ($model->getDomains(null, null, true) !== null) {
                    $domains = $model->getDomains();

                    if (!is_array($domains)) {

                        $domains = array($domains);
                    }

                    foreach ($domains as $value) {
                        $value->setCompanyId($primaryKey)
                              ->saveRecursive(false, $transactionTag);
                    }
                }

                if ($model->getExtensions(null, null, true) !== null) {
                    $extensions = $model->getExtensions();

                    if (!is_array($extensions)) {

                        $extensions = array($extensions);
                    }

                    foreach ($extensions as $value) {
                        $value->setCompanyId($primaryKey)
                              ->saveRecursive(false, $transactionTag);
                    }
                }

                if ($model->getExternalCallFilters(null, null, true) !== null) {
                    $externalCallFilters = $model->getExternalCallFilters();

                    if (!is_array($externalCallFilters)) {

                        $externalCallFilters = array($externalCallFilters);
                    }

                    foreach ($externalCallFilters as $value) {
                        $value->setCompanyId($primaryKey)
                              ->saveRecursive(false, $transactionTag);
                    }
                }

                if ($model->getFaxes(null, null, true) !== null) {
                    $faxes = $model->getFaxes();

                    if (!is_array($faxes)) {

                        $faxes = array($faxes);
                    }

                    foreach ($faxes as $value) {
                        $value->setCompanyId($primaryKey)
                              ->saveRecursive(false, $transactionTag);
                    }
                }

                if ($model->getFeaturesRelCompanies(null, null, true) !== null) {
                    $featuresRelCompanies = $model->getFeaturesRelCompanies();

                    if (!is_array($featuresRelCompanies)) {

                        $featuresRelCompanies = array($featuresRelCompanies);
                    }

                    foreach ($featuresRelCompanies as $value) {
                        $value->setCompanyId($primaryKey)
                              ->saveRecursive(false, $transactionTag);
                    }
                }

                if ($model->getFriends(null, null, true) !== null) {
                    $friends = $model->getFriends();

                    if (!is_array($friends)) {

                        $friends = array($friends);
                    }

                    foreach ($friends as $value) {
                        $value->setCompanyId($primaryKey)
                              ->saveRecursive(false, $transactionTag);
                    }
                }

                if ($model->getHuntGroups(null, null, true) !== null) {
                    $huntGroups = $model->getHuntGroups();

                    if (!is_array($huntGroups)) {

                        $huntGroups = array($huntGroups);
                    }

                    foreach ($huntGroups as $value) {
                        $value->setCompanyId($primaryKey)
                              ->saveRecursive(false, $transactionTag);
                    }
                }

                if ($model->getIVRCommon(null, null, true) !== null) {
                    $iVRCommon = $model->getIVRCommon();

                    if (!is_array($iVRCommon)) {

                        $iVRCommon = array($iVRCommon);
                    }

                    foreach ($iVRCommon as $value) {
                        $value->setCompanyId($primaryKey)
                              ->saveRecursive(false, $transactionTag);
                    }
                }

                if ($model->getIVRCustom(null, null, true) !== null) {
                    $iVRCustom = $model->getIVRCustom();

                    if (!is_array($iVRCustom)) {

                        $iVRCustom = array($iVRCustom);
                    }

                    foreach ($iVRCustom as $value) {
                        $value->setCompanyId($primaryKey)
                              ->saveRecursive(false, $transactionTag);
                    }
                }

                if ($model->getInvoices(null, null, true) !== null) {
                    $invoices = $model->getInvoices();

                    if (!is_array($invoices)) {

                        $invoices = array($invoices);
                    }

                    foreach ($invoices as $value) {
                        $value->setCompanyId($primaryKey)
                              ->saveRecursive(false, $transactionTag);
                    }
                }

                if ($model->getLocutions(null, null, true) !== null) {
                    $locutions = $model->getLocutions();

                    if (!is_array($locutions)) {

                        $locutions = array($locutions);
                    }

                    foreach ($locutions as $value) {
                        $value->setCompanyId($primaryKey)
                              ->saveRecursive(false, $transactionTag);
                    }
                }

                if ($model->getMatchLists(null, null, true) !== null) {
                    $matchLists = $model->getMatchLists();

                    if (!is_array($matchLists)) {

                        $matchLists = array($matchLists);
                    }

                    foreach ($matchLists as $value) {
                        $value->setCompanyId($primaryKey)
                              ->saveRecursive(false, $transactionTag);
                    }
                }

                if ($model->getMusicOnHold(null, null, true) !== null) {
                    $musicOnHold = $model->getMusicOnHold();

                    if (!is_array($musicOnHold)) {

                        $musicOnHold = array($musicOnHold);
                    }

                    foreach ($musicOnHold as $value) {
                        $value->setCompanyId($primaryKey)
                              ->saveRecursive(false, $transactionTag);
                    }
                }

                if ($model->getOutgoingDDIRules(null, null, true) !== null) {
                    $outgoingDDIRules = $model->getOutgoingDDIRules();

                    if (!is_array($outgoingDDIRules)) {

                        $outgoingDDIRules = array($outgoingDDIRules);
                    }

                    foreach ($outgoingDDIRules as $value) {
                        $value->setCompanyId($primaryKey)
                              ->saveRecursive(false, $transactionTag);
                    }
                }

                if ($model->getOutgoingRouting(null, null, true) !== null) {
                    $outgoingRouting = $model->getOutgoingRouting();

                    if (!is_array($outgoingRouting)) {

                        $outgoingRouting = array($outgoingRouting);
                    }

                    foreach ($outgoingRouting as $value) {
                        $value->setCompanyId($primaryKey)
                              ->saveRecursive(false, $transactionTag);
                    }
                }

                if ($model->getParsedCDRs(null, null, true) !== null) {
                    $parsedCDRs = $model->getParsedCDRs();

                    if (!is_array($parsedCDRs)) {

                        $parsedCDRs = array($parsedCDRs);
                    }

                    foreach ($parsedCDRs as $value) {
                        $value->setCompanyId($primaryKey)
                              ->saveRecursive(false, $transactionTag);
                    }
                }

                if ($model->getPickUpGroups(null, null, true) !== null) {
                    $pickUpGroups = $model->getPickUpGroups();

                    if (!is_array($pickUpGroups)) {

                        $pickUpGroups = array($pickUpGroups);
                    }

                    foreach ($pickUpGroups as $value) {
                        $value->setCompanyId($primaryKey)
                              ->saveRecursive(false, $transactionTag);
                    }
                }

                if ($model->getPricingPlansRelCompanies(null, null, true) !== null) {
                    $pricingPlansRelCompanies = $model->getPricingPlansRelCompanies();

                    if (!is_array($pricingPlansRelCompanies)) {

                        $pricingPlansRelCompanies = array($pricingPlansRelCompanies);
                    }

                    foreach ($pricingPlansRelCompanies as $value) {
                        $value->setCompanyId($primaryKey)
                              ->saveRecursive(false, $transactionTag);
                    }
                }

                if ($model->getQueues(null, null, true) !== null) {
                    $queues = $model->getQueues();

                    if (!is_array($queues)) {

                        $queues = array($queues);
                    }

                    foreach ($queues as $value) {
                        $value->setCompanyId($primaryKey)
                              ->saveRecursive(false, $transactionTag);
                    }
                }

                if ($model->getRecordings(null, null, true) !== null) {
                    $recordings = $model->getRecordings();

                    if (!is_array($recordings)) {

                        $recordings = array($recordings);
                    }

                    foreach ($recordings as $value) {
                        $value->setCompanyId($primaryKey)
                              ->saveRecursive(false, $transactionTag);
                    }
                }

                if ($model->getRetailAccounts(null, null, true) !== null) {
                    $retailAccounts = $model->getRetailAccounts();

                    if (!is_array($retailAccounts)) {

                        $retailAccounts = array($retailAccounts);
                    }

                    foreach ($retailAccounts as $value) {
                        $value->setCompanyId($primaryKey)
                              ->saveRecursive(false, $transactionTag);
                    }
                }

                if ($model->getSchedules(null, null, true) !== null) {
                    $schedules = $model->getSchedules();

                    if (!is_array($schedules)) {

                        $schedules = array($schedules);
                    }

                    foreach ($schedules as $value) {
                        $value->setCompanyId($primaryKey)
                              ->saveRecursive(false, $transactionTag);
                    }
                }

                if ($model->getTerminals(null, null, true) !== null) {
                    $terminals = $model->getTerminals();

                    if (!is_array($terminals)) {

                        $terminals = array($terminals);
                    }

                    foreach ($terminals as $value) {
                        $value->setCompanyId($primaryKey)
                              ->saveRecursive(false, $transactionTag);
                    }
                }

                if ($model->getUsers(null, null, true) !== null) {
                    $users = $model->getUsers();

                    if (!is_array($users)) {

                        $users = array($users);
                    }

                    foreach ($users as $value) {
                        $value->setCompanyId($primaryKey)
                              ->saveRecursive(false, $transactionTag);
                    }
                }

                if ($model->getKamAccCdrs(null, null, true) !== null) {
                    $kamAccCdrs = $model->getKamAccCdrs();

                    if (!is_array($kamAccCdrs)) {

                        $kamAccCdrs = array($kamAccCdrs);
                    }

                    foreach ($kamAccCdrs as $value) {
                        $value->setCompanyId($primaryKey)
                              ->saveRecursive(false, $transactionTag);
                    }
                }

                if ($model->getKamUsersAddress(null, null, true) !== null) {
                    $kamUsersAddress = $model->getKamUsersAddress();

                    if (!is_array($kamUsersAddress)) {

                        $kamUsersAddress = array($kamUsersAddress);
                    }

                    foreach ($kamUsersAddress as $value) {
                        $value->setCompanyId($primaryKey)
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
     * @param IvozProvider\Model\Raw\Companies|null $entry The object to load the data into, or null to have one created
     * @return IvozProvider\Model\Raw\Companies The model with the data provided
     */
    public function loadModel($data, $entry = null)
    {
        if (!$entry) {
            $entry = new \IvozProvider\Model\Companies();
        }

        // We don't need to log changes as we will reset them later...
        $entry->stopChangeLog();

        if (is_array($data)) {
            $entry->setId($data['id'])
                  ->setBrandId($data['brandId'])
                  ->setType($data['type'])
                  ->setName($data['name'])
                  ->setDomainUsers($data['domain_users'])
                  ->setNif($data['nif'])
                  ->setDefaultTimezoneId($data['defaultTimezoneId'])
                  ->setApplicationServerId($data['applicationServerId'])
                  ->setExternalMaxCalls($data['externalMaxCalls'])
                  ->setPostalAddress($data['postalAddress'])
                  ->setPostalCode($data['postalCode'])
                  ->setTown($data['town'])
                  ->setProvince($data['province'])
                  ->setCountry($data['country'])
                  ->setOutboundPrefix($data['outbound_prefix'])
                  ->setCountryId($data['countryId'])
                  ->setLanguageId($data['languageId'])
                  ->setMediaRelaySetsId($data['mediaRelaySetsId'])
                  ->setIpFilter($data['ipFilter'])
                  ->setOnDemandRecord($data['onDemandRecord'])
                  ->setOnDemandRecordCode($data['onDemandRecordCode'])
                  ->setAreaCode($data['areaCode'])
                  ->setExternallyExtraOpts($data['externallyExtraOpts'])
                  ->setRecordingsLimitMB($data['recordingsLimitMB'])
                  ->setRecordingsLimitEmail($data['recordingsLimitEmail'])
                  ->setOutgoingDDIId($data['outgoingDDIId'])
                  ->setOutgoingDDIRuleId($data['outgoingDDIRuleId']);
        } else if ($data instanceof \Zend_Db_Table_Row_Abstract || $data instanceof \stdClass) {
            $entry->setId($data->{'id'})
                  ->setBrandId($data->{'brandId'})
                  ->setType($data->{'type'})
                  ->setName($data->{'name'})
                  ->setDomainUsers($data->{'domain_users'})
                  ->setNif($data->{'nif'})
                  ->setDefaultTimezoneId($data->{'defaultTimezoneId'})
                  ->setApplicationServerId($data->{'applicationServerId'})
                  ->setExternalMaxCalls($data->{'externalMaxCalls'})
                  ->setPostalAddress($data->{'postalAddress'})
                  ->setPostalCode($data->{'postalCode'})
                  ->setTown($data->{'town'})
                  ->setProvince($data->{'province'})
                  ->setCountry($data->{'country'})
                  ->setOutboundPrefix($data->{'outbound_prefix'})
                  ->setCountryId($data->{'countryId'})
                  ->setLanguageId($data->{'languageId'})
                  ->setMediaRelaySetsId($data->{'mediaRelaySetsId'})
                  ->setIpFilter($data->{'ipFilter'})
                  ->setOnDemandRecord($data->{'onDemandRecord'})
                  ->setOnDemandRecordCode($data->{'onDemandRecordCode'})
                  ->setAreaCode($data->{'areaCode'})
                  ->setExternallyExtraOpts($data->{'externallyExtraOpts'})
                  ->setRecordingsLimitMB($data->{'recordingsLimitMB'})
                  ->setRecordingsLimitEmail($data->{'recordingsLimitEmail'})
                  ->setOutgoingDDIId($data->{'outgoingDDIId'})
                  ->setOutgoingDDIRuleId($data->{'outgoingDDIRuleId'});

        } else if ($data instanceof \IvozProvider\Model\Raw\Companies) {
            $entry->setId($data->getId())
                  ->setBrandId($data->getBrandId())
                  ->setType($data->getType())
                  ->setName($data->getName())
                  ->setDomainUsers($data->getDomainUsers())
                  ->setNif($data->getNif())
                  ->setDefaultTimezoneId($data->getDefaultTimezoneId())
                  ->setApplicationServerId($data->getApplicationServerId())
                  ->setExternalMaxCalls($data->getExternalMaxCalls())
                  ->setPostalAddress($data->getPostalAddress())
                  ->setPostalCode($data->getPostalCode())
                  ->setTown($data->getTown())
                  ->setProvince($data->getProvince())
                  ->setCountry($data->getCountry())
                  ->setOutboundPrefix($data->getOutboundPrefix())
                  ->setCountryId($data->getCountryId())
                  ->setLanguageId($data->getLanguageId())
                  ->setMediaRelaySetsId($data->getMediaRelaySetsId())
                  ->setIpFilter($data->getIpFilter())
                  ->setOnDemandRecord($data->getOnDemandRecord())
                  ->setOnDemandRecordCode($data->getOnDemandRecordCode())
                  ->setAreaCode($data->getAreaCode())
                  ->setExternallyExtraOpts($data->getExternallyExtraOpts())
                  ->setRecordingsLimitMB($data->getRecordingsLimitMB())
                  ->setRecordingsLimitEmail($data->getRecordingsLimitEmail())
                  ->setOutgoingDDIId($data->getOutgoingDDIId())
                  ->setOutgoingDDIRuleId($data->getOutgoingDDIRuleId());

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
        $etag = $etags->findOneByField('table', 'Companies');

        if (empty($etag)) {
            $etag = new \IvozProvider\Model\EtagVersions();
            $etag->setTable('Companies');
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