<?php

namespace Ivoz\Provider\Domain\Service\GenericMusicOnHold;

use Ivoz\Provider\Domain\Model\GenericMusicOnHold\GenericMusicOnHoldInterface;
use \IvozProvider\Gearmand\Jobs;

/**
 * Class Recoder
 * @package Ivoz\Provider\Domain\Service\GenericMusicOnHold
 * @lifecycle post_persist
 */
class Recoder implements GenericMusicOnHoldLifecycleEventHandlerInterface
{
    /**
     * @var Jobs\Recoder
     */
    protected $recoder;

    public function __construct(
        Jobs\Recoder $recoder
    ) {
        $this->recoder = $recoder;
    }

    public function execute(GenericMusicOnHoldInterface $entity)
    {
        $mustRecode = false;

        /**
         * @todo

            $fso = $model->fetchOriginalFile(false);

            if ($fso instanceof \Iron_Model_Fso && $fso->mustFlush()) {
                $mustRecode = true;
                $model->setStatus('pending');
            }

         */

        if ($mustRecode) {
            $recoderJob = new Recoder();
            $recoderJob
                ->recoder
                ->setId($entity->getId())
                ->setModelName("GenericMusicOnHold")
                ->send();
        }
    }
}
