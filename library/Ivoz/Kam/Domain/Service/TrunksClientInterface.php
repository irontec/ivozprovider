<?php

namespace Ivoz\Kam\Domain\Service;

interface TrunksClientInterface
{
    const DIALPLAN_RELOAD_ACTION = 'dialplan.reload';
    const DISPATCHER_RELOAD_ACTION = 'dispatcher.reload';
    const LCR_RELOAD_ACTION = 'lcr.reload';
    const PERMISSIONS_TRUSTED_RELOAD_ACTION = 'permissions.trustedReload';
    const PERMISSIONS_ADDRESS_RELOAD_ACTION = 'permissions.addressReload';
    const UAC_REG_RELOAD_ACTION = 'uac.reg_reload';
    const DLG_PROFILE_GET_SIZE = 'dlg.profile_get_size';
    const RTPENGINE_RELOAD_ACTION = 'rtpengine.reload';

    const TRUNKS_ACTIONS = [
        self::DIALPLAN_RELOAD_ACTION,
        self::DISPATCHER_RELOAD_ACTION,
        self::LCR_RELOAD_ACTION,
        self::PERMISSIONS_TRUSTED_RELOAD_ACTION,
        self::PERMISSIONS_ADDRESS_RELOAD_ACTION,
        self::UAC_REG_RELOAD_ACTION,
        self::DLG_PROFILE_GET_SIZE,
        self::RTPENGINE_RELOAD_ACTION
    ];

    /**
     * @param int $companyId
     * @return int
     */
    public function getCompanyActiveCalls(int $companyId);

    /**
     * @param int $brandId
     * @return int
     */
    public function getBrandActiveCalls(int $brandId);

    /**
     * @return int
     */
    public function getPlatformActiveCalls();

    public function reloadDialplan();

    public function reloadDispatcher();

    public function reloadLcr();

    public function reloadTrustedPermissions();

    public function reloadAddressPermissions();

    public function reloadUacReg();

    public function reloadRtpengine();
}
