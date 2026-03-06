<?php

namespace Ivoz\Provider\Domain\Model\MatchListPattern;

/**
 * MatchListPattern
 */
class MatchListPattern extends MatchListPatternAbstract implements MatchListPatternInterface
{
    use MatchListPatternTrait;

    /**
     * @codeCoverageIgnore
     * @return array<string, mixed>
     */
    public function getChangeSet(): array
    {
        return parent::getChangeSet();
    }

    /**
     * Get id
     * @codeCoverageIgnore
     * @return integer
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Get Number value in E.164 format
     * @return string
     */
    public function getNumberE164()
    {
        $callingCode = $this
            ->getNumberCountry()
            ->getCountryCode();

        return
            $callingCode .
            $this->getNumberValue();
    }

    protected function sanitizeValues(): void
    {
        $this->sanitizeNullableFields();
        $this->sanitizeMatchListValue();
        $this->sanitizeMatchPattern();
    }

    protected function sanitizeMatchPattern(): void
    {
        /** @var self::TYPE_NUMBER|self::TYPE_REGEXP $type */
        $type = $this->getType();
        $pattern = match ($type) {
            self::TYPE_REGEXP => $this->getRegexp() ?? '',
            self::TYPE_NUMBER => sprintf(
                '%s %s',
                $this->getNumberCountry()?->getCountryCode() ?? '',
                $this->getNumbervalue() ?? '',
            ),
        };

        $this->setMatchPattern($pattern);
    }

    protected function sanitizeMatchListValue(): void
    {
        $notNew = !$this->isNew();
        $matchListHasChanged = $this->hasChanged('matchListId');

        if ($notNew && $matchListHasChanged) {
            $errorMsg = 'Unable to update match list value in a match list pattern';
            throw new \DomainException($errorMsg, 403);
        }
    }

    protected function sanitizeNullableFields(): void
    {
        $nullableFields = [
            'number' => 'numberValue',
            'regexp' => 'regExp',
        ];
        $patternType = $this->getType();
        foreach ($nullableFields as $type => $fieldName) {
            if ($patternType == $type) {
                continue;
            }
            $setter = 'set' . ucfirst($fieldName);
            $this->{$setter}(null);
        }
    }
}
