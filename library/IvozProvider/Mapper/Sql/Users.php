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
    protected function _save(
        \IvozProvider\Model\Raw\Users $model,
        $recursive = false,
        $useTransaction = true,
        $transactionTag = null,
        $forceInsert = false
    )
    {
        $isNew = !$model->getPrimaryKey();

        if ($model->getEmail() === '') {
            // '' is NULL (avoid triggering the UNIQUE KEY)
            $model->setEmail(null);
        }

        if ($isNew) {
            // Sane defaults for hidden fields
            if (!$model->getTimezoneId()) {
                $model->setTimezoneId(
                    $model->getCompany()->getBrand()->getDefaultTimezoneId()
                );
            }

            if (is_null($model->getVoicemailSendMail()) && $model->getEmail()) {
                $model->setVoicemailSendMail(1);
            }

            if ($model->getEmail()) {
                $model->setActive(1);
                $model->setPass("1234");
            }

        } else {

            $canAccessUserweb = ($model->getActive() && $model->getEmail());
            if ($canAccessUserweb) {
                // Avoid username/pass/active incoherences
                if (!$model->getPass()) {
                    $model->setPass("1234");
                }
            } else {
                $model->setActive(0);
                $model->setPass(null);
            }

            if (!$model->getEmail()) {
                // If no mail, no SendMail
                $model->setVoicemailSendMail(0);
            }
        }

        // Nice pass for nice users
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
                $this->_logger->log("Password set", \Zend_Log::INFO);
            }
        }

        $isBoss = $model->getIsBoss() == 1;
        $hasChangedIsBoss = $model->hasChange('isBoss');
        $hasChangedTerminal = $model->hasChange('terminalId');
        $hasChangedExtension = $model->hasChange("extensionId");

        if (!$isNew && $hasChangedIsBoss && $isBoss) {
            $bosses = $this->findByField("bossAssistantId", $model->getPrimaryKey());
            foreach ($bosses as $boss) {
                $boss->setBossAssistantId(null)->save();
                $logMessage = "User unset as Boss Assistant of boss with id = '".$boss->getPrimaryKey()."'";
                $this->_logger->log($logMessage, \Zend_Log::INFO);
            }
        }

        // This user is being updated
        $original = $this->find($model->getPrimaryKey());
        if ($original) {
            // Update previous terminal
            if ($endpoint = $original->getEndpoint()) {
                $endpoint
                    ->setPickupGroup(null)
                    ->setCallerid(null)
                    ->setMailboxes(null)
                    ->save();
            }
        }

        $response = parent::_save($model, $recursive, $useTransaction, $transactionTag, $forceInsert);

        // Update Asterisk Voicemail
        $vmMapper = new \IvozProvider\Mapper\Sql\AstVoicemail();
        $voicemail = $vmMapper->findOneByField("userId", $model->getPrimaryKey());

        // If not found create a new one
        if (is_null($voicemail)) {
            $voicemail = new \IvozProvider\Model\AstVoicemail();
        }

        if ($model->getVoicemailSendMail()) {
            $voicemail->setEmail($model->getEmail());
        } else {
            $voicemail->setEmail(null);
        }

        if ($model->getVoicemailAttachSound()) {
            $voicemail->setAttach('yes');
        } else {
            $voicemail->setAttach('no');
        }

        // Update/Insert endpoint data
        $voicemail->setUserId($model->getId())
            ->setContext($model->getVoiceMailContext())
            ->setMailbox($model->getVoiceMailUser())
            ->setFullname($model->getName() . " " . $model->getLastname())
            ->setTz($model->getTimezone()->getTz())
            ->save();

        // Update the endpoint
        $model->updateEndpoint();

        // If extension has changed, update extension user
        if ($hasChangedExtension && $model->getExtension()) {
            $model->getExtension()
                ->setRouteType('user')
                ->setUser($model)
                ->save();
        }

        // Update all queue member entries for this user
        if ($hasChangedExtension || $hasChangedTerminal) {
            foreach ($model->getQueueMembers() as $member) {
                $member->save();
            }
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

        // Update the endpoint
        $endpoint = $model->getEndpoint();
        if ($endpoint) {
            $endpoint
                ->setCallerid(null)
                ->setMailboxes(null)
                ->save();
        }

        return parent::delete($model);
    }

    protected function _salt()
    {
        return substr(md5(mt_rand(), false), 0, 8);
    }

}
