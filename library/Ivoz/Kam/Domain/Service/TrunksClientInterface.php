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
    const UAC_REG_INFO_ACTION = 'uac.reg_info';
    const LCR_DUMP_GWS_ACTION = 'lcr.dump_gws';
    const DLG_PROFILE_GET_SIZE = 'dlg.profile_get_size';
    const RTPENGINE_RELOAD_ACTION = 'rtpengine.reload';
    const CGRATES_ENABLED_ACTION = 'cfg.get';

    const TRUNKS_ACTIONS = [
        self::DIALPLAN_RELOAD_ACTION,
        self::DISPATCHER_RELOAD_ACTION,
        self::LCR_RELOAD_ACTION,
        self::PERMISSIONS_TRUSTED_RELOAD_ACTION,
        self::PERMISSIONS_ADDRESS_RELOAD_ACTION,
        self::UAC_REG_RELOAD_ACTION,
        self::UAC_REG_INFO_ACTION,
        self::LCR_DUMP_GWS_ACTION,
        self::DLG_PROFILE_GET_SIZE,
        self::RTPENGINE_RELOAD_ACTION
    ];

    /**
     * @param int $companyId
     * @return int[] inbound/outbound
     */
    public function getCompanyActiveCalls(int $companyId): array;

    /**
     * @param int $brandId
     * @return int[] inbound/outbound
     */
    public function getBrandActiveCalls(int $brandId): array;

    /**
     * @return int[] inbound/outbound
     */
    public function getPlatformActiveCalls(): array;

    public function isCgrEnabled();

    public function reloadDialplan(): void;

    public function reloadDispatcher(): void;

    public function reloadLcr(): void;

    public function reloadTrustedPermissions(): void;

    public function reloadAddressPermissions(): void;

    public function reloadUacReg(): void;

    public function getUacRegistrationInfo($luuid): array;

    public function getLcrGatewayInfo($gw_id): array;

    public function reloadRtpengine(): void;
}
