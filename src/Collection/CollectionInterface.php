<?php

namespace Nulldark\Collection;

use ArrayAccess;
use Closure;
use Countable;
use IteratorAggregate;

/**
 * @template TKey of array-key
 * @template TValue
 *
 * @extends ArrayAccess<TKey, TValue>
 * @extends IteratorAggregate<TKey, TValue>
 */
interface CollectionInterface extends ArrayAccess, Countable, IteratorAggregate
{
    /**
     * Get all items from collection.
     *
     * @return array<TKey, TValue>
     */
    public function all(): array;

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
     * Run a first item of collection
     *
     * @template TValueDefault
     *
     * @param (callable(TValue,TKey): bool)|null $callback
     * @param TValueDefault $default
     * @return TValue|TValueDefault
     */
    public function first(callable $callback = null, mixed $default = null): mixed;

    /**
     * Remove all items from collection.
     *
     * @return void
     */
    public function clear(): void;
}
