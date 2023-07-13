<?php

namespace Test\Unit\Services\Validation;

use Test\TestCase;
use App\Services\Validation\Validator;

/**
 * @group unit
 */
class ValidatorTest extends TestCase
{
    public function testIsValidFalse()
    {
        $validator = new Validator();

        $this->assertFalse($validator->isValid(new \Acme\Foo()));
        $this->assertEquals('The field myVal should be greater than 2', $validator->getError());
    }

    public function testIsValidTrue()
    {
        $validator = new Validator();
        $foo = new \Acme\Foo();
        $foo->setVal(3);

        $this->assertTrue($validator->isValid($foo));
        $this->assertNull($validator->getError());
    }
}

namespace Acme;
use App\Services\Validation\Rules\GreaterThan;

class Foo
{
    #[GreaterThan(val: 2)]
    private int $myVal = 1;
    public function setVal(int $myVal)
    {
        $this->myVal = $myVal;
    }
    public function getVal()
    {
        return $this->myVal;
    }
}
