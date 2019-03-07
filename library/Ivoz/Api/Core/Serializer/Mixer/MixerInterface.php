<?php

namespace Ivoz\Api\Core\Serializer\Mixer;

use Symfony\Component\HttpFoundation\Response;

interface MixerInterface
{

    /**
     * {@inheritdoc}
     */
    public function supportsFormat($format = null);

    /**
     * @param array of resources $segments
     *
     * @return string | Response
     */
    public function mix(array $segments);
}
