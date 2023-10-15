<?php

namespace Nulldark\Tests\Fixtures;

class Foo
{
    public function __construct(
        public int $id,
        public string $name
    ) {
    }
}
