<?php

namespace Ivoz\Provider\Domain\Model\ApplicationServerSet;

use Ivoz\Provider\Domain\Model\ApplicationServer\ApplicationServer;
use Ivoz\Provider\Domain\Model\ApplicationServer\ApplicationServerDto;
use Ivoz\Provider\Domain\Model\ApplicationServerSetRelApplicationServer\ApplicationServerSetRelApplicationServer;
use Ivoz\Provider\Domain\Model\ApplicationServerSetRelApplicationServer\ApplicationServerSetRelApplicationServerDto;

class ApplicationServerSetDto extends ApplicationServerSetDtoAbstract
{
    /** @var int[] $applicationServers */
    private $applicationServers;

    public static function getPropertyMap(string $context = '', string $role = null): array
    {
        if ($context == self::CONTEXT_COLLECTION) {
            $response = [
                'id' => 'id',
                'name' => 'name',
                'distributeMethod' => 'distributeMethod',
                'description' => 'description',
            ];
        } else {
            $response = parent::getPropertyMap($context, $role);
            $response['applicationServers'] = 'applicationServers';
        }

        return $response;
    }

    /** @return Array<array-key, string> */
    public function normalize(string $context, string $role = ''): array
    {
        $response = parent::normalize(
            $context,
            $role
        );

       $response['applicationServers'] = $this->applicationServers;

        return $response;
    }

    /** @param int[] $applicationServerIds */
    public function setApplicationServers(array $applicationServerIds): void
    {
        $this->applicationServers = $applicationServerIds;

        $relApplicationServers       = [];
        foreach ($applicationServerIds as $id) {
            $dto = new ApplicationServerSetRelApplicationServerDto();
            $dto->setApplicationServerId($id);
            $relApplicationServers[] = $dto;
        }

        $this->setRelApplicationServers($relApplicationServers);
    }
}
