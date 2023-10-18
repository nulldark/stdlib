<?php

namespace Nulldark\Tests\Units;

use Nulldark\Stdlib\Collection;
use Nulldark\Tests\Fixtures\Foo;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(Collection::class)]
class CollectionTest extends TestCase
{
    public function testConstructor(): void
    {
        $collection = new Collection(['foo', 'bar']);

        $this->assertCount(2, $collection);
    }

    public function testFilter(): void
    {
        $foo1 = new Foo(1, 'foo1');
        $foo2 = new Foo(2, 'foo2');

        $collection = new Collection([$foo1, $foo2]);
        $collection = $collection->filter(function ($value) {
            return $value->id == 2;
        });

        $this->assertCount(1, $collection);
        $this->assertSame($foo2, $collection->first());
    }

    public function testFirst(): void
    {
        $foo1 = new Foo(1, 'foo1');
        $foo2 = new Foo(2, 'foo2');

        $collection = new Collection([$foo1, $foo2]);

        $this->assertSame($foo1, $collection->first());
        $this->assertSame([$foo1, $foo2], $collection->all());
    }
}
