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

namespace Nulldark\Stdlib\Array;

use ArrayAccess;
use Countable;
use IteratorAggregate;
use RuntimeException;

/**
 * @author Dominik Szamburski
 * @package \Nulldark\Stdlib\Array
 * @since 2.0.0
 * @license MIT
 *
 * @template TKey of array-key
 * @template TValue
 *
 * @extends ArrayAccess<TKey, TValue>
 * @extends IteratorAggregate<TKey, TValue>
 */
interface ArrayInterface extends ArrayAccess, Countable, IteratorAggregate
{
    /**
     * Remove all items from collection.
     *
     * @return void
     */
    public function clear(): void;

    /**
     * Checks whether the collection is empty.
     *
     * @since 2.0.0
     *
     * @return bool
     */
    public function empty(): bool;

    /**
     * Execute callback over a collection.
     *
     * @param callable(TValue, TKey): TValue $callback
     * @return $this
     */
    public function each(callable $callback): self;

    /**
     * Run a filter over a collection.
     *
     * @param callable(TValue): bool $callback
     * @return $this
     */
    public function filter(callable $callback): self;

    /**
     * Returns a first item of collection
     *
     * @return TValue
     *
     * @throws RuntimeException if collection is empty.
     */
    public function first(): mixed;

    /**
     * Returns a last item of collection
     *
     * @return TValue
     *
     * @throws RuntimeException if collection is empty.
     */
    public function last(): mixed;
}
