<?php

/**
 * Copyright (c) 2023 Dominik Szamburski
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */

namespace Nulldark\Stdlib\Collections;

use Traversable;

/**
 * @author Dominik Szamburski
 * @package Nulldark\Stdlib\Array
 * @since 2.0.0
 * @license MIT
 *
 * @template TKey of array-key
 * @template TValue
 *
 * @implements GenericArrayInterface<TKey, TValue>
 */
class GenericArray implements GenericArrayInterface
{
    /**
     * The items of array.
     *
     * @var array<TKey, TValue>
     */
    protected array $data = [];

    /**
     * @param array<TKey, TValue> $items
     */
    public function __construct(array $items = [])
    {
        foreach ($items as $key => $value) {
            $this[$key] = $value;
        }
    }

    /**
     * @inheritDoc
     */
    public function clear(): void
    {
        $this->data = [];
    }

    /**
     * @inheritDoc
     */
    public function empty(): bool
    {
        return $this->count() === 0;
    }

    /**
     * @inheritDoc
     *
     * @return Traversable<TKey, TValue>
     */
    public function getIterator(): Traversable
    {
        return new \ArrayIterator($this->data);
    }

    /**
     * @inheritDoc
     *
     * @param TKey $offset
     *
     * @return bool
     */
    public function offsetExists(mixed $offset): bool
    {
        return isset($this->items[$offset]);
    }

    /**
     * @inheritDoc
     *
     * @param TKey $offset
     *
     * @return TValue
     */
    public function offsetGet(mixed $offset): mixed
    {
        return $this->data[$offset];
    }

    /**
     * @inheritDoc
     *
     * @param TKey $offset
     * @param TValue $value
     *
     * @return void
     */
    public function offsetSet(mixed $offset, mixed $value): void
    {
        if ($offset === null) {
            $this->data[] = $value;
        } else {
            $this->data[$offset] = $value;
        }
    }

    /**
     * @inheritDoc
     *
     * @param TKey $offset
     *
     * @return void
     */
    public function offsetUnset(mixed $offset): void
    {
        unset($this->data[$offset]);
    }

    /**
     * @inheritDoc
     */
    public function count(): int
    {
        return \count($this->data);
    }

    /**
     * @inheritDoc
     */
    public function first(): mixed
    {
        $index = array_key_first($this->data);

        if ($index === null) {
            throw new \RuntimeException("Can't find a first element, Collection is empty.");
        }

        return $this[$index];
    }

    public function last(): mixed
    {
        $index = array_key_last($this->data);

        if ($index === null) {
            throw new \RuntimeException("Can't find a last element, Collection is empty.");
        }

        return $this[$index];
    }

    /**
     * @inheritDoc
     */
    public function each(callable $callback): GenericArrayInterface
    {
        foreach ($this->data as $key => $item) {
            if ($callback($item, $key) === false) {
                break;
            }
        }

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function filter(callable $callback): GenericArrayInterface
    {
        $collection = clone $this;
        $collection->data = array_merge([], array_filter($collection->data, $callback));

        return $collection;
    }
}
