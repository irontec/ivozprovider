<?php

namespace EntityGeneratorBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class EntityGeneratorBundle extends Bundle
{
    public function getParent()
    {
        return 'DoctrineBundle';
    }
}
