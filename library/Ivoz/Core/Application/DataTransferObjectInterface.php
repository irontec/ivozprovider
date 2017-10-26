<?php

namespace Ivoz\Core\Application;

interface DataTransferObjectInterface
{
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
