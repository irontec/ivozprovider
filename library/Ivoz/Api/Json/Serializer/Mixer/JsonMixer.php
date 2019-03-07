<?php

namespace Ivoz\Api\Json\Serializer\Mixer;

use Ivoz\Api\Core\Serializer\Mixer\MixerInterface;

class JsonMixer implements MixerInterface
{
    const FORMAT = 'json';

    /**
     * @inheritdoc
     */
    public function supportsFormat($format = null)
    {
        return static::FORMAT === $format;
    }

    /**
     * @inheritdoc
     */
    public function mix(array $segments)
    {
        $cleanSegments = array_map(
            function ($item) {
                return substr(
                    stream_get_contents($item),
                    1,
                    -1
                );
            },
            $segments
        );

        return
            '['
            . implode(',', $cleanSegments)
            . ']';
    }
}
