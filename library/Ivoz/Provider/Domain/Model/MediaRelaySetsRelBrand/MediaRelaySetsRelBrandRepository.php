<?php

namespace Ivoz\Provider\Domain\Model\MediaRelaySetsRelBrand;

use Ivoz\Core\Domain\Service\Repository\RepositoryInterface;
use Ivoz\Provider\Domain\Model\Administrator\AdministratorInterface;

/**
 * @extends RepositoryInterface<MediaRelaySetsRelBrandInterface, MediaRelaySetsRelBrandDto>
 */
interface MediaRelaySetsRelBrandRepository extends RepositoryInterface
{
    /** @return int[] */
    public function getMediaRelaySetIdsByBrandAdmin(AdministratorInterface $admin): array;
}
