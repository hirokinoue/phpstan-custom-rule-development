<?php declare(strict_types = 1);

namespace Tests\CallStaticMethodInClassRuleTest;

use Rules\CallStaticMethodInClassRule;
use PHPStan\Rules\Rule;
use PHPStan\Testing\RuleTestCase;

/**
 * @extends RuleTestCase<CallStaticMethodInClassRuleTest>
 */
class CallStaticMethodInClassRuleTest extends RuleTestCase
{
    protected function getRule(): Rule
    {
        return new CallStaticMethodInClassRule();
    }

    public function testRule(): void
    {
        $this->analyse([__DIR__ . '/data/call-static-method-in-class-rule.php'], [
            [
                'Use constructor injection for dependent classes.',
                8,
            ],
            [
                'Use constructor injection for dependent classes.',
                13,
            ],
        ]);
    }

//    public static function getAdditionalConfigFiles(): array
//    {
//        return [__DIR__ . '/../extension.neon'];
//    }
}
