<?php
namespace Redwood\Typesence;

use Redwood\Typesence\Lib\Configuration;

class Override
{

  /**
   * @var \Redwood\Typesence\Lib\Configuration
   */
  private $config;

  /**
   * @var string
   */
  private $collectionName;

  /**
   * @var int
   */
  private $overrideId;

  /**
   * @var \Redwood\Typesence\ApiCall
   */
  private $apiCall;

  /**
   * Override constructor.
   *
   * @param  \Redwood\Typesence\Lib\Configuration  $config
   * @param  string  $collectionName
   * @param  int  $overrideId
   */
  public function __construct(
    Configuration $config, string $collectionName, int $overrideId
  ) {
    $this->config         = $config;
    $this->collectionName = $collectionName;
    $this->overrideId     = $overrideId;
    $this->apiCall        = new ApiCall($this->config);
  }

  /**
   * @return string
   */
  private function endPointPath(): string
  {
    return sprintf('%s/%s/%s/%s', Collections::RESOURCE_PATH, $this->collectionName, Overrides::RESOURCE_PATH, $this->overrideId);
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
   * @return array
   * @throws \Redwood\Typesence\Exceptions\TypesenseClientError|\GuzzleHttp\Exception\GuzzleException
   */
  public function delete(): array
  {
    return $this->apiCall->delete($this->endPointPath());
  }

}