<?php

namespace Ivoz\Api\Symfony\Serializer;

use Ivoz\Api\Core\Serializer\Mixer\MixerInterface;
use Ivoz\Api\Doctrine\Orm\Extension\UnpaginatedResultGeneratorExtension;
use Ivoz\Core\Infrastructure\Persistence\Filesystem\TempFileHelper;
use Symfony\Component\Serializer\Encoder\ChainDecoder;
use Symfony\Component\Serializer\Encoder\ChainEncoder;
use Symfony\Component\Serializer\Encoder\DecoderInterface;
use Symfony\Component\Serializer\Encoder\EncoderInterface;
use Symfony\Component\Serializer\Exception\LogicException;
use Symfony\Component\Serializer\Exception\NotEncodableValueException;
use Symfony\Component\Serializer\Exception\NotNormalizableValueException;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Filesystem\Filesystem;

class ProgressiveSerializer implements SerializerInterface, NormalizerInterface, DenormalizerInterface, EncoderInterface, DecoderInterface
{
    const SEGMENT_SIZE = UnpaginatedResultGeneratorExtension::BATCH_SIZE;

    protected $decorated;
    protected $tmpFileHelper;

    /**
     * @var MixerInterface[]
     */
    protected $mixers = [];

    public function __construct(
        Serializer $decoratedSerializer,
        TempFileHelper $tmpFileHelper
    ) {
        $this->decorated = $decoratedSerializer;
        $this->tmpFileHelper = $tmpFileHelper;
    }

    public function addMixer(MixerInterface $mixer)
    {
        $this->mixers[] = $mixer;
    }

    /**
     * {@inheritdoc}
     */
    public function serialize($data, $format, array $context = array())
    {
        $isGenerator = $data instanceof \Generator;
        $formatCanBeMixed = $this->canBeMixed($format);
        if ($isGenerator && $formatCanBeMixed) {
            return $this->progressiveSerialize(
                $data,
                $format,
                $context
            );
        }

        return $this->decorated->serialize(...func_get_args());
    }

    private function progressiveSerialize(\Generator $dataSource, $format, array $context)
    {
        $partials = [];
        foreach ($dataSource as $item) {
            $chunks[] = $item;
            if (count($chunks) >= self::SEGMENT_SIZE) {
                $partials[] = $this->tmpFileHelper->createWithContent(
                    $this->serialize($chunks, $format, $context)
                );
                $chunks = [];
            }
        }

        if (!empty($chunks)) {
            $partials[] = $this->tmpFileHelper->createWithContent(
                $this->serialize($chunks, $format, $context)
            );
        }

        return $this->mix(
            $format,
            $partials
        );
    }

    private function canBeMixed($format)
    {
        foreach ($this->mixers as $mixer) {
            $isSupported = $mixer->supportsFormat($format);
            if ($isSupported) {
                return true;
            }
        }

        return false;
    }

    private function mix($format, array $segments)
    {
        foreach ($this->mixers as $mixer) {
            $isSupported = $mixer->supportsFormat($format);
            if ($isSupported) {
                return $mixer->mix($segments);
            }
        }

        throw new \Exception('No compatible mixer found for ' . $format);
    }

    /////////////////////////////////////////////////
    /// Proxy methods
    /////////////////////////////////////////////////

    /**
     * {@inheritdoc}
     */
    public function deserialize($data, $type, $format, array $context = array())
    {
        return $this->decorated->deserialize(
            ...func_get_args()
        );
    }

    /**
     * {@inheritdoc}
     */
    public function normalize($data, $format = null, array $context = array())
    {
        return $this->decorated->normalize(
            ...func_get_args()
        );
    }

    /**
     * {@inheritdoc}
     *
     * @throws NotNormalizableValueException
     */
    public function denormalize($data, $type, $format = null, array $context = array())
    {
        return $this->decorated->denormalize(
            ...func_get_args()
        );
    }

    /**
     * {@inheritdoc}
     */
    public function supportsNormalization($data, $format = null/*, array $context = array()*/)
    {
        return $this->decorated->supportsNormalization(
            ...func_get_args()
        );
    }

    /**
     * {@inheritdoc}
     */
    public function supportsDenormalization($data, $type, $format = null/*, array $context = array()*/)
    {
        return $this->decorated->supportsDenormalization(
            ...func_get_args()
        );
    }

    /**
     * {@inheritdoc}
     */
    public function encode($data, $format, array $context = array())
    {
        return $this->decorated->encode(
            ...func_get_args()
        );
    }

    /**
     * {@inheritdoc}
     */
    final public function decode($data, $format, array $context = array())
    {
        return $this->decorated->decode(
            ...func_get_args()
        );
    }

    /**
     * {@inheritdoc}
     */
    public function supportsEncoding($format/*, array $context = array()*/)
    {
        return $this->decorated->supportsEncoding(
            ...func_get_args()
        );
    }

    /**
     * {@inheritdoc}
     */
    public function supportsDecoding($format/*, array $context = array()*/)
    {
        return $this->decorated->supportsDecoding(
            ...func_get_args()
        );
    }
}
