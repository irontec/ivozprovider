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
     * @return string | null
     */
    public function getPassword();

    /**
     * Get fullname
     *
     * @return string | null
     */
    public function getFullname();

    /**
     * Get alias
     *
     * @return string | null
     */
    public function getAlias();

    /**
     * Get email
     *
     * @return string | null
     */
    public function getEmail();

    /**
     * Get pager
     *
     * @return string | null
     */
    public function getPager();

    /**
     * Get attach
     *
     * @return string | null
     */
    public function getAttach();

    /**
     * Get attachfmt
     *
     * @return string | null
     */
    public function getAttachfmt();

    /**
     * Get serveremail
     *
     * @return string | null
     */
    public function getServeremail();

    /**
     * Get language
     *
     * @return string | null
     */
    public function getLanguage();

    /**
     * Get tz
     *
     * @return string | null
     */
    public function getTz();

    /**
     * Get deleteVoicemail
     *
     * @return string | null
     */
    public function getDeleteVoicemail();

    /**
     * Get saycid
     *
     * @return string | null
     */
    public function getSaycid();

    /**
     * Get sendVoicemail
     *
     * @return string | null
     */
    public function getSendVoicemail();

    /**
     * Get review
     *
     * @return string | null
     */
    public function getReview();

    /**
     * Get tempgreetwarn
     *
     * @return string | null
     */
    public function getTempgreetwarn();

    /**
     * Get operator
     *
     * @return string | null
     */
    public function getOperator();

    /**
     * Get envelope
     *
     * @return string | null
     */
    public function getEnvelope();

    /**
     * Get sayduration
     *
     * @return integer | null
     */
    public function getSayduration();

    /**
     * Get forcename
     *
     * @return string | null
     */
    public function getForcename();

    /**
     * Get forcegreetings
     *
     * @return string | null
     */
    public function getForcegreetings();

    /**
     * Get callback
     *
     * @return string | null
     */
    public function getCallback();

    /**
     * Get dialout
     *
     * @return string | null
     */
    public function getDialout();

    /**
     * Get exitcontext
     *
     * @return string | null
     */
    public function getExitcontext();

    /**
     * Get maxmsg
     *
     * @return integer | null
     */
    public function getMaxmsg();

    /**
     * Get volgain
     *
     * @return string | null
     */
    public function getVolgain();

    /**
     * Get imapuser
     *
     * @return string | null
     */
    public function getImapuser();

    /**
     * Get imappassword
     *
     * @return string | null
     */
    public function getImappassword();

    /**
     * Get imapserver
     *
     * @return string | null
     */
    public function getImapserver();

    /**
     * Get imapport
     *
     * @return string | null
     */
    public function getImapport();

    /**
     * Get imapflags
     *
     * @return string | null
     */
    public function getImapflags();

    /**
     * Get stamp
     *
     * @return \DateTime | null
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
