<?php

namespace Ivoz\Kam\Domain\Service;

interface UsersClientInterface
{
    public const DISPATCHER_RELOAD_ACTION = 'dispatcher.reload';
    public const DOMAIN_RELOAD_ACTION = 'domain.reload';
    public const PERMISSIONS_TRUSTED_RELOAD_ACTION = 'permissions.trustedReload';
    public const PERMISSIONS_ADDRESS_RELOAD_ACTION = 'permissions.addressReload';
    public const DIALPLAN_RELOAD_ACTION = 'dialplan.reload';
    public const RTPENGINE_RELOAD_ACTION = 'rtpengine.reload';
    public const BANNED_ADDRESS_UNBAN = 'htable.delete';

    public const USERS_ACTIONS = [
        self::DISPATCHER_RELOAD_ACTION,
        self::DOMAIN_RELOAD_ACTION,
        self::PERMISSIONS_TRUSTED_RELOAD_ACTION,
        self::PERMISSIONS_ADDRESS_RELOAD_ACTION,
        self::DIALPLAN_RELOAD_ACTION,
        self::RTPENGINE_RELOAD_ACTION,
        self::BANNED_ADDRESS_UNBAN
    ];

    public function reloadDispatcher(): void;

    public function reloadDomain(): void;

    public function reloadTrustedPermissions(): void;

    public function reloadAddressPermissions(): void;

    public function reloadDialplan(): void;

    public function reloadRtpengine(): void;

    public function unban(string $aor, string $ip): void;
}
