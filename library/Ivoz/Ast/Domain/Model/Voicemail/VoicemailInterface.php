<?php

namespace Ivoz\Ast\Domain\Model\Voicemail;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;

interface VoicemailInterface extends LoggableEntityInterface
{
    /**
     * @return array
     */
    public function getChangeSet();

    /**
     * Get context
     *
     * @return string
     */
    public function getContext();

    /**
     * Get mailbox
     *
     * @return string
     */
    public function getMailbox();

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword();

    /**
     * Get fullname
     *
     * @return string
     */
    public function getFullname();

    /**
     * Get alias
     *
     * @return string
     */
    public function getAlias();

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail();

    /**
     * Get pager
     *
     * @return string
     */
    public function getPager();

    /**
     * Get attach
     *
     * @return string
     */
    public function getAttach();

    /**
     * Get attachfmt
     *
     * @return string
     */
    public function getAttachfmt();

    /**
     * Get serveremail
     *
     * @return string
     */
    public function getServeremail();

    /**
     * Get language
     *
     * @return string
     */
    public function getLanguage();

    /**
     * Get tz
     *
     * @return string
     */
    public function getTz();

    /**
     * Get deleteVoicemail
     *
     * @return string
     */
    public function getDeleteVoicemail();

    /**
     * Get saycid
     *
     * @return string
     */
    public function getSaycid();

    /**
     * Get sendVoicemail
     *
     * @return string
     */
    public function getSendVoicemail();

    /**
     * Get review
     *
     * @return string
     */
    public function getReview();

    /**
     * Get tempgreetwarn
     *
     * @return string
     */
    public function getTempgreetwarn();

    /**
     * Get operator
     *
     * @return string
     */
    public function getOperator();

    /**
     * Get envelope
     *
     * @return string
     */
    public function getEnvelope();

    /**
     * Get sayduration
     *
     * @return integer
     */
    public function getSayduration();

    /**
     * Get forcename
     *
     * @return string
     */
    public function getForcename();

    /**
     * Get forcegreetings
     *
     * @return string
     */
    public function getForcegreetings();

    /**
     * Get callback
     *
     * @return string
     */
    public function getCallback();

    /**
     * Get dialout
     *
     * @return string
     */
    public function getDialout();

    /**
     * Get exitcontext
     *
     * @return string
     */
    public function getExitcontext();

    /**
     * Get maxmsg
     *
     * @return integer
     */
    public function getMaxmsg();

    /**
     * Get volgain
     *
     * @return string
     */
    public function getVolgain();

    /**
     * Get imapuser
     *
     * @return string
     */
    public function getImapuser();

    /**
     * Get imappassword
     *
     * @return string
     */
    public function getImappassword();

    /**
     * Get imapserver
     *
     * @return string
     */
    public function getImapserver();

    /**
     * Get imapport
     *
     * @return string
     */
    public function getImapport();

    /**
     * Get imapflags
     *
     * @return string
     */
    public function getImapflags();

    /**
     * Get stamp
     *
     * @return \DateTime
     */
    public function getStamp();

    /**
     * Set user
     *
     * @param \Ivoz\Provider\Domain\Model\User\UserInterface $user
     *
     * @return self
     */
    public function setUser(\Ivoz\Provider\Domain\Model\User\UserInterface $user = null);

    /**
     * Get user
     *
     * @return \Ivoz\Provider\Domain\Model\User\UserInterface
     */
    public function getUser();

    /**
     * Set residentialDevice
     *
     * @param \Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceInterface $residentialDevice
     *
     * @return self
     */
    public function setResidentialDevice(\Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceInterface $residentialDevice = null);

    /**
     * Get residentialDevice
     *
     * @return \Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceInterface
     */
    public function getResidentialDevice();
}
