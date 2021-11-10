<?php

namespace Ivoz\Provider\Domain\Model\Locution;

class LocutionDto extends LocutionDtoAbstract
{

    private $originalFilePath;
    private $encodedFilePath;

    /**
     * @inheritdoc
     * @codeCoverageIgnore
     */
    public static function getPropertyMap(string $context = '', string $role = null)
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return [
                'id' => 'id',
                'name' => 'name',
                'status' => 'status',
                'originalFile' => ['baseName'],
            ];
        }

        $response = parent::getPropertyMap(...func_get_args());

        if ($role === 'ROLE_COMPANY_ADMIN') {
            unset($response['companyId']);
        }

        return $response;
    }

    public function denormalize(array $data, string $context, string $role = '')
    {
        $contextProperties = self::getPropertyMap($context, $role);
        if ($role === 'ROLE_COMPANY_ADMIN') {
            $contextProperties['companyId'] = 'company';
        }

        if ($context === self::CONTEXT_SIMPLE) {
            $contextProperties['originalFile'][] = 'path';
        }

        $this->setByContext(
            $contextProperties,
            $data
        );
    }

    /**
     * @return array
     */
    public function getFileObjects()
    {
        return [
            'originalFile',
            'encodedFile'
        ];
    }

    /**
     * @return mixed
     */
    public function getOriginalFilePath()
    {
        return $this->originalFilePath;
    }

    /**
     * @param string $originalFilePath
     *
     * @return static
     */
    public function setOriginalFilePath(string $originalFilePath = null): static
    {
        $this->originalFilePath = $originalFilePath;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEncodedFilePath()
    {
        return $this->encodedFilePath;
    }

    /**
     * @param string $encodedFilePath
     *
     * @return static
     */
    public function setEncodedFilePath(string $encodedFilePath = null): static
    {
        $this->encodedFilePath = $encodedFilePath;
        return $this;
    }
}
