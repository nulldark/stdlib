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

namespace Nulldark\Stdlib\Collections\Map;

use Nulldark\Stdlib\Collections\GenericArray;

/**
 * @author Dominik Szamburski
 * @package \Nulldark\Stdlib\Map
 * @since 2.0.0
 * @license MIT
 *
 * @template K of array-key
 * @template V
 *
 * @extends GenericArray<K, V>
 * @implements MapInterface<K, V>
 */
class GenericMap extends GenericArray implements MapInterface
{
    /**
     * @inheritDoc
     */
    public function keys(): array
    {
        return array_keys($this->data);
    }

    /**
     * @param K $offset
     * @param V $value
     *
     * @inheritDoc
     */
    public function offsetSet(mixed $offset, mixed $value): void
    {
        if ($offset === null) {
            throw new \InvalidArgumentException("Key must be provided for value " . var_export($value, true));
        }

        $this->data[$offset] = $value;
    }

    /**
     * @inheritDoc
     */
    public function put(int|string $key, mixed $value): mixed
    {
        $previousValue = $this->get($key);
        $this[$key] = $value;

        return $previousValue;
    }

    /**
     * @inheritDoc
     */
    public function get(int|string $key, mixed $defaulV = null): mixed
    {
        return $this[$key] ?? $defaulV;
    }

    /**
     * @inheritDoc
     */
    public function remove(int|string $key): mixed
    {
        $previousValue = $this->get($key);
        unset($this[$key]);

        return $previousValue;
    }
}
