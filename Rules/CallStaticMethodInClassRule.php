<?php declare (strict_types=1);

namespace Rules;

use PhpParser\Node;
use PhpParser\Node\Expr;
use PhpParser\Node\Expr\StaticCall;
use PHPStan\Rules\Rule;
use PHPStan\Analyser\Scope;
use PHPStan\Rules\RuleErrorBuilder;

/**
 * @implements Rule<StaticCall>
 */
final class CallStaticMethodInClassRule implements Rule
{
    public function getNodeType(): string
    {
        return StaticCall::class;
    }

    public function processNode(Node $node, Scope $scope): array
    {
        /** @var StaticCall $node */
        if ($this->shouldSkip($node)) {
            return [];
        }
        if ($scope->isInClass()) {
            return [
                RuleErrorBuilder::message(
                    'Use constructor injection for dependent classes.'
                )->build(),
            ];
        }
        return [];
    }

    private function shouldSkip(StaticCall $staticCall): bool
    {
        if ($staticCall->class instanceof Expr) {
            return false;
        }
        if ($staticCall->class->isSpecialClassName()) {
            return true;
        }
        return false;
    }
}
