<?php

namespace Ivoz\Core\Application;

use Ramsey\Uuid\Uuid;

class RequestId
{
    /**
     * @var \Ramsey\Uuid\UuidInterface
     */
    protected $id;

    public function __construct()
    {
        $this->id = Uuid::uuid4();
    }

    /**
     * @return string
     */
    public function toString()
    {
        return $this->id->toString();
    }
}
