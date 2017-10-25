<?php

namespace Ivoz\Provider\Domain\Service\GenericMusicOnHold;

use Ivoz\Provider\Domain\Model\GenericMusicOnHold\GenericMusicOnHoldInterface;

/**
 * Class SanitizeValues
 * @package Ivoz\Provider\Domain\Service\GenericMusicOnHold
 * @lifecycle pre_persist
 */
class SanitizeValues implements GenericMusicOnHoldLifecycleEventHandlerInterface
{
    public function __construct() {}

    public function execute(GenericMusicOnHoldInterface $entity)
    {
        foreach ($entity->getTempFiles() as $tmpFile) {

            $tmpPath = $tmpFile->getTmpPath();
            if (!is_null($tmpPath)) {
                $entity->setStatus('pending');
            }
        }
    }
}
