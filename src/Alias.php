<?php


namespace Redwood\Typesence;

use Redwood\Typesence\Lib\Configuration;

class Alias
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
   * Alias constructor.
   *
   * @param  \Redwood\Typesence\Lib\Configuration  $config
   * @param  string  $name
   */
  public function __construct(Configuration $config, string $name)
  {
    $this->config  = $config;
    $this->name    = $name;
    $this->apiCall = new ApiCall($this->config);
  }

  /**
   * @return string
   */
  public function endPointPath(): string
  {
    return sprintf('%s/%s', Aliases::RESOURCE_PATH, $this->name);
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