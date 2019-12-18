<?php

namespace Ivoz\Api\Csv\Serializer\Mixer;

use Ivoz\Api\Core\Serializer\Mixer\MixerInterface;

class CsvMixer implements MixerInterface
{
    const FORMAT = 'csv';

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
        for ($i=0; $i < count($segments); $i++) {
            // Remove column names from every segment but the first one
            $content = stream_get_contents($segments[$i]);

            $segments[$i] = $i > 0
                ? $this->removeFirstLine($content)
                : $content;
        }

        return implode(
            '',
            $segments
        );
    }

    private function removeFirstLine($content)
    {
        return substr($content, strpos($content, "\n")+1);
    }
}
