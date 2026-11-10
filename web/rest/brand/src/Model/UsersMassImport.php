<?php

namespace Model;

use Ivoz\Api\Core\Annotation\AttributeDefinition;

/**
 * @codeCoverageIgnore
 */
class UsersMassImport
{
    /**
     * @var integer
     * @AttributeDefinition(type="int")
     */
    protected $created;

    /**
     * @var integer
     * @AttributeDefinition(type="int")
     */
    protected $updated;

    /**
     * @var UsersMassImportError[]
     * @AttributeDefinition(
     *     type="array",
     *     class="Model\UsersMassImportError"
     * )
     */
    protected $errors;

    /**
     * @param UsersMassImportError[] $errors
     */
    public function __construct(
        int $created,
        int $updated,
        array $errors
    ) {
        $this->created = $created;
        $this->updated = $updated;
        $this->errors = $errors;
    }

    /**
     * @return array{created: int, updated: int, errors: list<array{line: int, message: string}>}
     */
    public function toArray(): array
    {
        return [
            'created' => $this->created,
            'updated' => $this->updated,
            'errors' => array_values(
                array_map(
                    fn (UsersMassImportError $error): array => $error->toArray(),
                    $this->errors
                )
            ),
        ];
    }
}
