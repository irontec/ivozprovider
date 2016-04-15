<?php

/**
 * Application Model Mapper
 *
 * @package Mapper
 * @subpackage Sql
 * @author Luis Felipe Garcia
 * @copyright ZF model generator
 * @license http://framework.zend.com/license/new-bsd     New BSD License
 */

/**
 * Data Mapper implementation for IvozProvider\Model\Users
 *
 * @package Mapper
 * @subpackage Sql
 * @author Luis Felipe Garcia
 */
namespace IvozProvider\Mapper\Sql;
class Users extends Raw\Users
{
    protected function _save(\IvozProvider\Model\Raw\Users $model,
        $recursive = false, $useTransaction = true, $transactionTag = null, $forceInsert = false
    )
    {
        $pass = $model->hasChange('pass');
        if ($pass) {
            $passPlain = $model->getPass();
            if (!empty($passPlain)) {
                $newToken = md5(md5($passPlain));
                $model->setTokenKey($newToken);

                $salt = $this->_salt();
                $ret = crypt(
                    $model->getPass(),
                    '$5$rounds=5000$' . $salt . '$'
                );
                $model->setPass($ret);
                $this->_logger->log("Password Setted", \Zend_Log::INFO);
            }
        }

        $isNew = !$model->getPrimaryKey();
        $isBoss = $model->getIsBoss() == 1;
        $hasChangedIsBoss = $model->hasChange('isBoss');
        $hasChangedTerminal = $model->hasChange('terminalId');
        $voicemailHasChanged = $model->hasChange('voicemailEnabled');
        $haschangedExtension = $model->hasChange("extensionId");

        if (!$isNew && $hasChangedIsBoss && $isBoss) {
            $bosses = $this->findByField("bossAssistantId", $model->getPrimaryKey());
            foreach ($bosses as $boss) {
                $boss->setBossAssistantId(null)->save();
                $logMessage = "User unsetted as Boss Assistant of boss with id = '".$boss->getPrimaryKey()."'";
                $this->_logger->log($logMessage, \Zend_Log::INFO);
            }
        }

        if (!$isNew && $hasChangedTerminal) {
            $prevSavedUser = $this->find($model->getPrimaryKey());
            $prevSavedUserTerminal = $prevSavedUser->getTerminal();
            if ($prevSavedUserTerminal) {
                $this->_unsetMailboxAors($prevSavedUserTerminal);
            }
        }

        $response = parent::_save($model, $recursive, $useTransaction, $transactionTag, $forceInsert);

        if ($response && $isNew) {
            $this->_setAstVoicemail($model);
        }

        $applicationServer = $model->getCompany()->getApplicationServer();
        if ($response && ($haschangedExtension || $hasChangedTerminal)) {
        //if ($response && $haschangedExtension) {
            $this->_reloadDialplan($applicationServer);
        }

        $terminal = $model->getTerminal();
        if ($terminal) {
            $aors = $model->getId() . '@' . $model->getCompanyId();
            $endpoint = $terminal->getEndpoint();
            if ($endpoint) {
                $endpoint->setMailboxes($aors)->save();
                $terminalPk = $terminal->getPrimaryKey();
                $this->_logger->log("Updated mailboxes_aors ('".$aors."') in terminal with id = '".$terminalPk."'", \Zend_Log::INFO);
            }
        }

        return $response;

    }

    protected function _setAstVoicemail(\IvozProvider\Model\Raw\Users $model)
    {
         $astVoicemailMapper = new \IvozProvider\Mapper\Sql\AstVoicemail;

         $where = "context = '". $model->getCompanyId() .
                  "' AND mailbox='". $model->getPrimaryKey() ."'";

         $astVoicemail = $astVoicemailMapper->fetchOne($where);

         if (!$astVoicemail) {
             $astVoicemail = new \IvozProvider\Model\AstVoicemail;
         }

         $result = $astVoicemail->setContext($model->getCompanyId())
                             ->setMailbox($model->getPrimaryKey())
                             ->setPassword($model->getPass())
                             ->setFullname($model->getName() . " " . $model->getLastname())
                             ->setEmail($model->getEmail())
                             ->setTz($model->getTimezone()->getTz())
                             ->save();

         $pk = $astVoicemail->getPrimaryKey();
         $this->_logger->log("AstVoiscemail with id = '".$pk."' setted", \Zend_Log::INFO);

         return $result;
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

        $extension = $model->getExtension();
        $applicationServer = $model->getCompany()->getApplicationServer();

        $response = parent::delete($model);

        if (!$response) {
            return $response;
        }

        if (!is_null($extension)) {
            $this->_reloadDialplan($applicationServer);
        }

        $astVoicemailMapper = new \IvozProvider\Mapper\Sql\AstVoicemail;
        $where = "context = '". $model->getCompanyId() .
                  "' AND mailbox='". $model->getPrimaryKey() ."'";
        $astVoicemails = $astVoicemailMapper->fetchList($where);
        $nAstVoiceMails = count($astVoicemails);
        if ($nAstVoiceMails > 0) {
            $this->_logger->log("Deletting ".$nAstVoiceMails." ast voicemails", \Zend_log::INFO);
        } else {
            $this->_logger->log("No ast voicemails to delete", \Zend_log::INFO);
        }
        foreach ($astVoicemails as $astVoicemail) {
            $pk = $astVoicemail->getPrimaryKey();
            $astVoicemail->delete();
            $this->_logger->log("ast voicemail with id = '".$pk."' deleted.", \Zend_log::INFO);
        }

        if (!is_null($model->getTerminal())) {
            $this->_unsetMailboxAors($model->getTerminal());
        }

        return $response;
    }

    protected function _unsetMailboxAors(\IvozProvider\Model\Terminals $terminal) {
        $terminal->setMailboxesAors('')->save();
        $terminalPK = $terminal->getPrimaryKey();
        $logMessage = "Unsetted mailboxes_aors in old terminal with id = '".$terminalPK."'";
        $this->_logger->log($logMessage, \Zend_Log::INFO);
    }

    protected function _salt()
    {
        $ret = substr(md5(mt_rand(), false), 0, 8);

        return $ret;
    }

    protected function _reloadDialplan($applicationServer)
    {
            $reloadDialplanJob = new \IvozProvider\Gearmand\Jobs\ReloadDialplan();
            $reloadDialplanJob
            ->setApplicationServer($applicationServer)
            ->send();
    }

}
