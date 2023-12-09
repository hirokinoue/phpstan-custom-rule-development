<?php

namespace Rules;

use PhpParser\Node;
use PHPStan\Analyser\Scope;
use PHPStan\Rules\Rule;
use PHPStan\Node\InClassNode;
use PHPStan\Rules\RuleErrorBuilder;
use PHPStan\Type\ArrayType;
use PHPStan\Type\ObjectType;

class NameNodeHolderFindRule implements Rule
{
    public function getNodeType(): string
    {
        return InClassNode::class;
    }

    public function processNode(Node $node, Scope $scope): array
    {
        if (!$node instanceof InClassNode) {
            return [];
        }

        $classLike = $node->getOriginalNode();
        $properties = $classLike->getProperties();
        $classReflection = $scope->getClassReflection();
        foreach ($properties as $property) {
            foreach($property->props as $prop) {
                $propertyName = $prop->name->toString();
                $propertyReflection = $classReflection->getNativeProperty($propertyName);
                $propertyType = $propertyReflection->getReadableType();
                if ($propertyType instanceof ArrayType) {
                    $propertyType = $propertyType->getItemType();
                }
                $trinary = $propertyType->isSuperTypeOf(new ObjectType('PhpParser\Node\Name'));
                if (!$trinary->no()) {
                    return [
                        RuleErrorBuilder::message(
                            $classLike->namespacedName->toString()
                        )->build(),
                    ];
                }
            }
        }
        return [];
    }
}
