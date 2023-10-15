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

namespace Nulldark\Collection;

use Traversable;

/**
 * @template TKey of array-key
 * @template TValue
 *
 * @implements CollectionInterface<TKey, TValue>
 */
abstract class AbstractCollection implements CollectionInterface
{
    /**
     * @var array<TKey, TValue> $items;
     */
    protected array $items = [];

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
     * @link http://php.net/manual/en/iteratoraggregate.getiterator.php IteratorAggregate::getIterator()
     *
     * @return Traversable<TKey, TValue>
     */
    public function getIterator(): Traversable
    {
        return new \ArrayIterator($this->items);
    }

    /**
     * @link http://php.net/manual/en/arrayaccess.offsetexists.php ArrayAccess::offsetExists()
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
     * @link http://php.net/manual/en/arrayaccess.offsetget.php ArrayAccess::offsetGet()
     *
     * @param TKey $offset
     *
     * @return TValue
     */
    public function offsetGet(mixed $offset): mixed
    {
        return $this->items[$offset];
    }

    /**
     * @link http://php.net/manual/en/arrayaccess.offsetset.php ArrayAccess::offsetSet()
     *
     * @param TKey|null $offset
     * @param TValue $value
     *
     * @return void
     */
    public function offsetSet(mixed $offset, mixed $value): void
    {
        if ($offset === null) {
            $this->items[] = $value;
        } else {
            $this->items[$offset] = $value;
        }
    }

    /**
     * @link http://php.net/manual/en/arrayaccess.offsetunset.php ArrayAccess::offsetUnset()
     *
     * @param TKey $offset
     *
     * @return void
     */
    public function offsetUnset(mixed $offset): void
    {
        unset($this->items[$offset]);
    }

    /**
     * @link http://php.net/manual/en/countable.count.php Countable::count()
     *
     * @return int
     */
    public function count(): int
    {
        return \count($this->items);
    }

    /**
     * @inheritDoc
     */
    public function clear(): void
    {
        $this->items = [];
    }

    /**
     * @inheritDoc
     */
    public function all(): array
    {
        return $this->items;
    }

    /**
     * @inheritDoc
     */
    public function first(callable $callback = null, mixed $default = null): mixed
    {
        if (is_null($callback)) {
            foreach ($this->items as $item) {
                return $item;
            }

            return $default;
        }

        foreach ($this->items as $key => $item) {
            if ($callback($item, $key)) {
                return $item;
            }
        }

        return $default;
    }

    /**
     * @inheritDoc
     */
    public function each(callable $callback): CollectionInterface
    {
        foreach ($this->items as $key => $item) {
            if ($callback($item, $key) === false) {
                break;
            }
        }

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function filter(callable $callback): CollectionInterface
    {
        $collection = clone $this;
        $collection->items = array_merge([], array_filter($collection->items, $callback));

        return $collection;
    }
}
