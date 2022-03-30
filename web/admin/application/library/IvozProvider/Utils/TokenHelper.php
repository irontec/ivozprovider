<?php

namespace IvozProvider\Utils;

use IvozProvider\Service\RestClient;
use Ivoz\Provider\Domain\Model\WebPortal\WebPortal;

class TokenHelper
{
    public static function renewToken($user, $brandId)
    {
        $dataGateway = \Zend_Registry::get('data_gateway');

        $portal = null;
        $api = 'platform';

        if ($user->isBrandOperator) {
            /** @var \Ivoz\Provider\Domain\Model\WebPortal\WebPortalDto $brandWebPortal */
            $brandWebPortal = $dataGateway->findOneBy(
                WebPortal::class,
                [
                    'WebPortal.brand = :brandId AND WebPortal.urlType = :urlType',
                    [
                        ':brandId' => $brandId,
                        ':urlType' => 'brand'
                    ]
                ]
            );

            $portal = $brandWebPortal->getUrl();
            $api = 'brand';
        } elseif ($user->isCompanyAdmin) {

            /** @var \Ivoz\Provider\Domain\Model\WebPortal\WebPortalDto $clientWebPortal */
            $clientWebPortal = $dataGateway->findOneBy(
                WebPortal::class,
                [
                    'WebPortal.brand = :brandId AND WebPortal.urlType = :urlType',
                    [
                        ':brandId' => $brandId,
                        ':urlType' => 'admin'
                    ]
                ]
            );

            $portal = $clientWebPortal->getUrl();
            $api = 'client';
        }

        $user->token = RestClient::getRefreshedToken(
            $user->refreshToken,
            $portal,
            $api
        );

        return;
    }
}
