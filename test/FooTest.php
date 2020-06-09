<?php

declare(strict_types=1);

namespace DotEnvNotEmptyTest;

use Dotenv\Exception\ValidationException;
use DotEnvNotEmpty\Foo;
use PHPUnit\Framework\TestCase;

use function getenv;

class FooTest extends TestCase
{
    /**
     * @covers \DotEnvNotEmpty\Foo
     */
    public function testAssertVariablesNotEmpty(): void
    {
        $this->bar = new Foo();

        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage('NO_SUCH_VARIABLE is missing, EMPTY is empty, EMPTY_STRING is empty');
        //$this->expectExceptionMessage('NO_SUCH_VARIABLE is missing');
        //$this->expectExceptionMessage('EMPTY is empty');
        //$this->expectExceptionMessage('EMPTY_STRING is empty');

        $this->bar->assertVariablesNotEmpty();
    }

    /**
     * @covers \DotEnvNotEmpty\Foo
     */
    public function testEmptyVariableIsInitialized(): void
    {
        new Foo();
        $this->assertNull(getenv('EMPTY'));
    }

    /**
     * @covers \DotEnvNotEmpty\Foo
     */
    public function testEmptyStringVariableIsInitialized(): void
    {
        new Foo();
        $this->assertSame('', getenv('EMPTY_STRING'));
    }
}
