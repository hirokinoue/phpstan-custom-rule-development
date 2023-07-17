<?php declare(strict_types=1);

namespace App;

class SomeClass extends SomeParentClass
{
    public function someMethod(): void {
        SomeStaticClass::someStaticMethod();
        self::someStaticMethod();
        static::someStaticMethod();
        parent::someStaticMethod();
        $someStaticClass = 'SomeStaticClass';
        $someStaticClass::someStaticMethod();
    }
}
