<?php

namespace Ivoz\Provider\Domain\Model\TransformationRule;

use Ivoz\Core\Domain\Assert\Assertion;

/**
 * TransformationRule
 */
class TransformationRule extends TransformationRuleAbstract implements TransformationRuleInterface
{
    use TransformationRuleTrait;

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
     * {@inheritDoc}
     */
    public function setMatchExpr(?string $matchExpr = null): static
    {
        if (!is_null($matchExpr)) {
            Assertion::regexFormat($matchExpr);
        }

        return parent::setMatchExpr($matchExpr);
    }


    private function validateReplaceExpr(string $replaceExpr): void
    {
        if (preg_match('/\\\\(\d+)/', $replaceExpr, $matches)) {
            preg_match_all('/\\\\(\d+)/', $replaceExpr, $allMatches);
            $backrefNumbers = array_map('intval', $allMatches[1]);

            if (empty($backrefNumbers)) {
                return;
            }

            $maxBackrefNumber = max($backrefNumbers);

            $matchExpr = $this->getMatchExpr();
            if (!is_null($matchExpr)) {
                $captureGroupCount = $this->countCaptureGroups($matchExpr);

                if ($maxBackrefNumber > $captureGroupCount) {
                    throw new \DomainException(
                        sprintf(
                            'Replace expression contains backreference \\%d but match expression only has %d capture groups',
                            $maxBackrefNumber,
                            $captureGroupCount
                        )
                    );
                }
            }
        }
    }

    private function countCaptureGroups(string $pattern): int
    {
        $testPattern = '/' . str_replace('/', '\/', $pattern) . '/';

        if (@preg_match($testPattern, '') === false) {
            return 0;
        }

        $count = 0;
        $length = strlen($pattern);
        $escaped = false;

        for ($i = 0; $i < $length; $i++) {
            $char = $pattern[$i];

            if ($escaped) {
                $escaped = false;
                continue;
            }

            if ($char === '\\') {
                $escaped = true;
                continue;
            }

            if ($char === '(' && $i + 2 < $length && substr($pattern, $i, 3) !== '(?:') {
                if ($i + 1 < $length && $pattern[$i + 1] === '?') {
                    continue;
                }
                $count++;
            }
        }

        return $count;
    }

    protected function sanitizeValues(): void
    {
        $notNew = !$this->isNew();
        $transformationRuleSetHasChanged = $this->hasChanged('transformationRuleSetId');

        if ($notNew && $transformationRuleSetHasChanged) {
            $errorMsg = 'Unable to update transformation rule set value in a transformation rule';
            throw new \DomainException($errorMsg, 403);
        }

        if (!is_null($this->replaceExpr) && !is_null($this->matchExpr)) {
            $this->validateReplaceExpr($this->replaceExpr);
        }
    }
}
