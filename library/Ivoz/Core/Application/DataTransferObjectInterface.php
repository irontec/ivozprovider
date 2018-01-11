<?php

namespace Ivoz\Core\Application;

interface DataTransferObjectInterface
{
    const CONTEXT_COLLECTION = 'collection';
    const CONTEXT_SIMPLE = '';
    const CONTEXT_DETAILED = 'detailed';

    /**
     * @return array
     */
    public function normalize(string $context);

    /**
     * @return void
     */
    public function denormalize(array $data, string $context);

    /**
     * @return array
     */
    public static function getPropertyMap(string $context = '');

    /**
     * @return array
     */
    public function toArray();

    /**
     * @param ForeignKeyTransformerInterface $transformer
     * @return null
     */
    public function transformForeignKeys(ForeignKeyTransformerInterface $transformer);

    /**
     * @param CollectionTransformerInterface $transformer
     * @return null
     */
    public function transformCollections(CollectionTransformerInterface $transformer);
}
