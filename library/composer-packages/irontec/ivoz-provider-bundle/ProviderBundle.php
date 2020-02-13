<?php

namespace Ivoz\ProviderBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class ProviderBundle extends Bundle
{
    public function getParent()
    {
        return 'CoreBundle';
    }
}
