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

/**
 * @author Dominik Szamburski
 * @package \Nulldark\Stdlib\Collection
 * @since 1.0.0
 * @license MIT
 *
 * @template TKey of array-key
 * @template TValue
 *
 * @extends GenericArrayInterface<TKey, TValue>
 */
interface CollectionInterface extends GenericArrayInterface
{
    /**
     * Get all items from collection.
     *
     * @return array<TKey, TValue>
     */
    public function all(): array;

    /**
     * Returns `true` if collection contains specify element.
     *
     * @since 1.1.0
     *
     * @param TValue $element
     * @param bool $strict
     * @return bool
     *
     */
    public function contains(mixed $element, bool $strict = false): bool;

    /**
     * Adds specify element to collection.
     *
     * @since 1.1.0
     *
     * @param TValue $element
     * @return bool
     *
     */
    public function add(mixed $element): bool;
}
