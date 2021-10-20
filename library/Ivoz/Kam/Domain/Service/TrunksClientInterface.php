<?php

namespace Ivoz\Kam\Domain\Service;

interface TrunksClientInterface
{
    public const DIALPLAN_RELOAD_ACTION = 'dialplan.reload';
    public const DISPATCHER_RELOAD_ACTION = 'dispatcher.reload';
    public const LCR_RELOAD_ACTION = 'lcr.reload';
    public const PERMISSIONS_TRUSTED_RELOAD_ACTION = 'permissions.trustedReload';
    public const PERMISSIONS_ADDRESS_RELOAD_ACTION = 'permissions.addressReload';
    public const UAC_REG_RELOAD_ACTION = 'uac.reg_reload';
    public const UAC_REG_INFO_ACTION = 'uac.reg_info';
    public const LCR_DUMP_GWS_ACTION = 'lcr.dump_gws';
    public const DLG_PROFILE_GET_SIZE = 'dlg.profile_get_size';
    public const RTPENGINE_RELOAD_ACTION = 'rtpengine.reload';
    public const CGRATES_ENABLED_ACTION = 'cfg.get';

    public const TRUNKS_ACTIONS = [
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
