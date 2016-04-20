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
        $haschangedExtension = $model->hasChange("extensionId");

        if (!$isNew && $hasChangedIsBoss && $isBoss) {
            $bosses = $this->findByField("bossAssistantId", $model->getPrimaryKey());
            foreach ($bosses as $boss) {
                $boss->setBossAssistantId(null)->save();
                $logMessage = "User unsetted as Boss Assistant of boss with id = '".$boss->getPrimaryKey()."'";
                $this->_logger->log($logMessage, \Zend_Log::INFO);
            }
        }

        // Reset previous terminal voicemail
        if (!$isNew && $hasChangedTerminal) {
            $prevSavedUser = $this->find($model->getPrimaryKey());
            $this->setEndpointVoiceMail($prevSavedUser, null);
        }

        $response = parent::_save($model, $recursive, $useTransaction, $transactionTag, $forceInsert);

        // Update Asterisk Voicemail
        $this->saveVoiceMail($model);

        // Reload Hints
        if ($haschangedExtension || $hasChangedTerminal) {
            $this->_reloadDialplan();
        }

        return $response;

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
        $response = parent::delete($model);

        // Delete User voicemail
        $this->deleteVoiceMail();

        if (!is_null($extension)) {
            $this->_reloadDialplan();
        }

        return $response;
    }

    protected function saveVoiceMail($model)
    {
        // Update Asterisk Voicemail
        $vmMapper = new \IvozProvider\Mapper\Sql\AstVoicemail();
        $vm = $vmMapper->findOneByField("mailbox", $model->getVoiceMailUser());

        // If not found create a new one
        $forceInsert = false;
        if (is_null($vm)) {
            $forceInsert = true;
            $vm = new \IvozProvider\Model\AstVoicemail();
        }

        // Update/Insert endpoint data
        $vm->setContext($model->getVoiceMailContext())
            ->setMailbox($model->getVoiceMailUser())
            ->setPassword($model->getPass())
            ->setFullname($model->getName() . " " . $model->getLastname())
            ->setEmail($model->getEmail())
            ->setTz($model->getTimezone()->getTz())
            ->setAttach($model->getAttachVoicemailSound()?"yes":"no")
            ->save();

        // Update user endpoint if user want VoiceMail notifications
        if ($model->getVoicemailEnabled()) {
            $this->setEndpointVoiceMail($model, $model->getVoiceMail());
        } else {
            $this->setEndpointVoiceMail($model, null);
        }
    }

    protected function deleteVoiceMail($model)
    {
        // Delete User voicemail
        $vmMapper = new \IvozProvider\Mapper\Sql\AstVoicemail();
        $vm = $vmMapper->findOneByField("mailbox", $model->getVoiceMailUser());
        if ($vm) {
            $vmMapper->delete($vm);
        }

        // Update user endpoint
        $this->setEndpointVoiceMail($model, null);
    }

    protected function setEndpointVoiceMail($model, $voiceMail)
    {
        // Update Asterisk Endpoint data
        $terminal = $model->getTerminal();
        if ($terminal) {
            // Replicate Terminal into ast_ps_endpoint
            $endpointMapper = new \IvozProvider\Mapper\Sql\AstPsEndpoints();
            $endpoint = $endpointMapper->findOneByField("terminalId", $terminal->getId());
            if ($endpoint) {
                $endpoint->setMailboxes($voiceMail)->save();
            }
        }
    }

    protected function _salt()
    {
        return substr(md5(mt_rand(), false), 0, 8);
    }

    protected function _reloadDialplan()
    {
        $reloadDialplanJob = new \IvozProvider\Gearmand\Jobs\ReloadDialplan();
        $reloadDialplanJob->send();
    }

}
