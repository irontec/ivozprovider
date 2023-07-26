<?php

namespace Model;

use Ivoz\Api\Core\Annotation\AttributeDefinition;

/**
 * @codeCoverageIgnore
 */
class ACK
{
    /**
     * @var string
     * @AttributeDefinition(type="string")
     */
    protected $status = 'OK';

    /**
     * @return array<array-key, string>
     */
    public function toArray(): array
    {
        return [
            'status' => $this->status
        ];
    }
}
