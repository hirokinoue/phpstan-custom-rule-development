<?php

namespace Rules;

use PhpParser\Node;
use PhpParser\Node\Stmt\ClassMethod;
use PHPStan\Rules\Rule;
use PHPStan\Analyser\Scope;
use PHPStan\Rules\RuleErrorBuilder;

class MyRule implements Rule
{
    public function getNodeType(): string
    {
        return ClassMethod::class;
    }

    public function processNode(Node $node, Scope $scope): array
    {
        if (str_contains(strtolower($node->name->name), 'emerald')) {
            return [
                RuleErrorBuilder::message(
                    'Emerald should be green.'
                )->build(),
            ];
        }
        return [];
    }
}
