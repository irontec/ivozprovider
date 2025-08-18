<?php

namespace Ivoz\Provider\Domain\Service\TransformationRule;

use Ivoz\Provider\Domain\Model\TransformationRule\TransformationRuleInterface;

class ValidateRegexCaptureGroups implements TransformationRuleLifecycleEventHandlerInterface
{
    public const PRE_PERSIST_PRIORITY = self::PRIORITY_NORMAL;

    /** @return array<array-key, int> */
    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_PRE_PERSIST => self::PRE_PERSIST_PRIORITY
        ];
    }

    public function execute(TransformationRuleInterface $transformationRule): void
    {
        $replaceExpr = $transformationRule->getReplaceExpr();
        $matchExpr = $transformationRule->getMatchExpr();

        if (is_null($replaceExpr) || is_null($matchExpr)) {
            return;
        }

        $this->validateReplaceExpr($replaceExpr, $matchExpr);
    }

    private function validateReplaceExpr(string $replaceExpr, string $matchExpr): void
    {
        if (preg_match('/\\\\(\d+)/', $replaceExpr, $matches)) {
            preg_match_all('/\\\\(\d+)/', $replaceExpr, $allMatches);
            $backrefNumbers = array_map('intval', $allMatches[1]);

            if (empty($backrefNumbers)) {
                return;
            }

            $maxBackrefNumber = max($backrefNumbers);
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
}
