<?php

declare(strict_types=1);

namespace BTCPayServer\Result;

abstract class AbstractResult implements \ArrayAccess
{
  /** @var array */
  private array $data;

  public function __construct(array $data)
  {
    $this->data = $data;
  }

  public function getData(): array
  {
    return $this->data;
  }

  public function offsetExists(mixed $offset): bool
  {
    $data = $this->getData();
    return array_key_exists($offset, $data);
  }

  public function offsetGet(mixed $offset): mixed
  {
    $data = $this->getData();
    return $data[$offset] ?? null;
  }

  public function offsetSet(mixed $offset, mixed $value): void
  {
    throw new \RuntimeException('You should not change the data in a result.');
  }

  public function offsetUnset(mixed $offset): void
  {
    throw new \RuntimeException('You should not change the data in a result.');
  }
}
