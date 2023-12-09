<?php declare(strict_types = 1);

namespace Tests\NameNodeHolderFindRuleTest;

use Rules\NameNodeHolderFindRule;
use PHPStan\Rules\Rule;
use PHPStan\Testing\RuleTestCase;

/**
 * @extends RuleTestCase<NameNodeHolderFindRuleTest>
 */
class NameNodeHolderFindRuleTest extends RuleTestCase
{
    protected function getRule(): Rule
    {
        return new NameNodeHolderFindRule();
    }

    /**
     * @dataProvider data
     */
    public function testRule(string $file, array $expected): void
    {
        $this->analyse([$file], $expected);
    }

    public function data(): array
    {
        return [
            [__DIR__ . '/data/name-holder.php', [['App\DummyFuncCall', 8]]],
            [__DIR__ . '/data/non-name-holder.php', []],
        ];
    }
}
