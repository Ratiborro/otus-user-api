<?php

declare(strict_types=1);

namespace App\List;

use Countable;
use IteratorAggregate;
use Traversable;
use ArrayIterator;

abstract class AbstractList implements Countable, IteratorAggregate
{
    public function __construct(private array $items = [])
    {
    }

    public function add($item): void
    {
        $this->items[] = $item;
    }

    public function get(int $index): mixed
    {
        return $this->items[$index] ?? null;
    }

    public function count(): int
    {
        return count($this->items);
    }

    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->items);
    }
}