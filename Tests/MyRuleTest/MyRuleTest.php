<?php declare(strict_types = 1);

namespace Tests\MyRuleTest;

use Rules\MyRule;
use PHPStan\Rules\Rule;
use PHPStan\Testing\RuleTestCase;

/**
 * @extends RuleTestCase<MyRule>
 */
class MyRuleTest extends RuleTestCase
{
    protected function getRule(): Rule
    {
        return new MyRule();
    }

    public function testRule(): void
    {
        $this->analyse([__DIR__ . '/data/my-rule.php'], [
            [
                'Emerald should be green.',
                7,
            ],
        ]);
    }

//    public static function getAdditionalConfigFiles(): array
//    {
//        return [__DIR__ . '/../extension.neon'];
//    }
}
