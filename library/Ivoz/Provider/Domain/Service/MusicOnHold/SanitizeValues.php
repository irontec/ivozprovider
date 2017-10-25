<?php

namespace Ivoz\Provider\Domain\Service\MusicOnHold;

use Ivoz\Provider\Domain\Model\MusicOnHold\MusicOnHoldInterface;

/**
 * Class SanitizeValues
 * @package Ivoz\Provider\Domain\Service\MusicOnHold
 * @lifecycle pre_persist
 */
class SanitizeValues implements MusicOnHoldLifecycleEventHandlerInterface
{
    public function __construct() {}

    public function execute(MusicOnHoldInterface $entity)
    {
        foreach ($entity->getTempFiles() as $tmpFile) {

            $tmpPath = $tmpFile->getTmpPath();
            if (!is_null($tmpPath)) {
                $entity->setStatus('pending');
            }
        }
    }
}