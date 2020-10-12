<?php
namespace Redwood\Typesence;

use Redwood\Typesence\Lib\Configuration;

class Collections implements \ArrayAccess
{

  public const RESOURCE_PATH = '/collections';

  /**
   * @var \Redwood\Typesence\Lib\Configuration
   */
  private $congif;

  /**
   * @var \Redwood\Typesence\ApiCall
   */
  private $apiCall;

  /**
   * @var array
   */
  private $collections = [];

  /**
   * Collections constructor.
   *
   * @param $congif
   */
  public function __construct(Configuration $congif)
  {
    $this->congif  = $congif;
    $this->apiCall = new ApiCall($congif);
  }

  /**
   * @param $collectionName
   *
   * @return mixed
   */
  public function __get($collectionName)
  {
    if (isset($this->{$collectionName})) {
      return $this->{$collectionName};
    }
    if (!isset($this->collections[$collectionName])) {
      $this->collections[$collectionName] = new Collection($this->congif, $collectionName);
    }

    return $this->collections[$collectionName];
  }

  /**
   * @param  array  $schema
   *
   * @return array
   * @throws \Redwood\Typesence\Exceptions\TypesenseClientError|\GuzzleHttp\Exception\GuzzleException
   */
  public function create(array $schema): array
  {
    return $this->apiCall->post(self::RESOURCE_PATH, $schema);
  }

  /**
   * @return array
   * @throws \Redwood\Typesence\Exceptions\TypesenseClientError|\GuzzleHttp\Exception\GuzzleException
   */
  public function retrieve(): array
  {
    return $this->apiCall->get(self::RESOURCE_PATH, []);
  }

  /**
   * @inheritDoc
   */
  public function offsetExists($offset): bool
  {
    return isset($this->collections[$offset]);
  }

  /**
   * @inheritDoc
   */
  public function offsetGet($offset): Collection
  {
    if (!isset($this->collections[$offset])) {
      $this->collections[$offset] = new Collection($this->congif, $offset);
    }

    return $this->collections[$offset];
  }

  /**
   * @inheritDoc
   */
  public function offsetSet($offset, $value): void
  {
    $this->collections[$offset] = $value;
  }

  /**
   * @inheritDoc
   */
  public function offsetUnset($offset): void
  {
    unset($this->collections[$offset]);
  }

}