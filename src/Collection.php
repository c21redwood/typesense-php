<?php
namespace Redwood\Typesence;

use Redwood\Typesence\Lib\Configuration;

class Collection
{

  /**
   * @var \Redwood\Typesence\Lib\Configuration
   */
  private $config;

  /**
   * @var string
   */
  private $name;

  /**
   * @var \Redwood\Typesence\ApiCall
   */
  private $apiCall;

  /**
   * @var \Redwood\Typesence\Documents
   */
  public $documents;

  /**
   * @var \Redwood\Typesence\Overrides
   */
  public $overrides;

  /**
   * Collection constructor.
   *
   * @param $config
   * @param $name
   */
  public function __construct(Configuration $config, string $name)
  {
    $this->config    = $config;
    $this->name      = $name;
    $this->apiCall   = new ApiCall($config);
    $this->documents = new Documents($config, $name);
    $this->overrides = new Overrides($config, $name);
  }

  /**
   * @return string
   */
  public function endPointPath(): string
  {
    return sprintf('%s/%s', Collections::RESOURCE_PATH, $this->name);
  }

  /**
   * @return \Redwood\Typesence\Documents
   */
  public function getDocuments(): Documents
  {
    return $this->documents;
  }

  /**
   * @return \Redwood\Typesence\Overrides
   */
  public function getOverrides(): Overrides
  {
    return $this->overrides;
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