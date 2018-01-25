<?php

namespace Ivoz\Core\Infrastructure\Persistence\Doctrine;

final class Events
{
    /**
     * Triggered after the transaction has been successful
     */
    const onCommit = 'onCommit';
}
