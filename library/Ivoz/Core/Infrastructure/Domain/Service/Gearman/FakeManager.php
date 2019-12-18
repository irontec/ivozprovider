<?php

namespace Ivoz\Core\Infrastructure\Domain\Service\Gearman;

class FakeManager extends Manager
{
    public static function getClient()
    {
        return new class extends \GearmanClient
        {
            public function doBackground($function_name, $workload, $unique = null)
            {
            }
        };
    }
}
