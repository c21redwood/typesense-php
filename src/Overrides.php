<?php
namespace Redwood\Typesence;

use Redwood\Typesence\Lib\Configuration;

class Overrides implements \ArrayAccess
{

  public const RESOURCE_PATH = 'overrides';

  /**
   * @var \Redwood\Typesence\Lib\Configuration
   */
  private $config;

  /**
   * @var \Redwood\Typesence\ApiCall
   */
  private $apiCall;

  /**
   * @var string
   */
  private $collectionName;

  /**
   * @var array
   */
  private $overrides = [];

  /**
   * Overrides constructor.
   *
   * @param  \Redwood\Typesence\Lib\Configuration  $config
   * @param  string  $collectionName
   */
  public function __construct(Configuration $config, string $collectionName)
  {
    $this->config         = $config;
    $this->collectionName = $collectionName;
    $this->apiCall        = new ApiCall($config);
  }

  /**
   * @param  string  $overrideId
   *
   * @return string
   */
  public function endPointPath(string $overrideId = ''): string
  {
    return sprintf('%s/%s/%s/%s', Collections::RESOURCE_PATH, $this->collectionName, self::RESOURCE_PATH, $overrideId);
  }

  /**
   * @param  string  $documentId
   * @param  array  $config
   *
   * @return array
   * @throws \Redwood\Typesence\Exceptions\TypesenseClientError|\GuzzleHttp\Exception\GuzzleException
   */
  public function upsert(string $documentId, array $config): array
  {
    return $this->apiCall->put($this->endPointPath($documentId), $config);
  }

  /**
   * @return array
   * @throws \Redwood\Typesence\Exceptions\TypesenseClientError|\GuzzleHttp\Exception\GuzzleException
   */
  public function retrieve(): array
  {
    return $this->apiCall->get($this->endPointPath(), []);
  }

  /**
   * @inheritDoc
   */
  public function offsetExists($documentId): bool
  {
    return isset($this->overrides[$documentId]);
  }

  /**
   * @inheritDoc
   */
  public function offsetGet($documentId)
  {
    if (!isset($this->overrides[$documentId])) {
      $this->overrides[$documentId] = new Override($this->config, $this->collectionName, $documentId);
    }

    return $this->overrides[$documentId];
  }

  /**
   * @inheritDoc
   */
  public function offsetSet($documentId, $value): void
  {
    $this->overrides[$documentId] = $value;
  }

  /**
   * @inheritDoc
   */
  public function offsetUnset($documentId): void
  {
    unset($this->overrides[$documentId]);
  }

}