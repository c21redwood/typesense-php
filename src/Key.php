<?php
namespace Redwood\Typesence;

use Redwood\Typesence\Lib\Configuration;

class Key
{

  /**
   * @var \Redwood\Typesence\Lib\Configuration
   */
  private $congif;

  /**
   * @var \Redwood\Typesence\ApiCall
   */
  private $apiCall;

  /**
   * @var string
   */
  private $keyId;

  /**
   * Key constructor.
   *
   * @param  \Redwood\Typesence\Lib\Configuration  $congif
   * @param  \Redwood\Typesence\ApiCall  $apiCall
   * @param  string  $keyId
   */
  public function __construct(
    Configuration $congif, ApiCall $apiCall, string $keyId
  ) {
    $this->congif  = $congif;
    $this->apiCall = $apiCall;
    $this->keyId   = $keyId;
  }

  /**
   * @return string
   */
  private function endpointPath(): string
  {
    return sprintf('%s/%s', Keys::RESOURCE_PATH, $this->keyId);
  }

  /**
   * @return array
   * @throws \Redwood\Typesence\Exceptions\TypesenseClientError|\GuzzleHttp\Exception\GuzzleException
   */
  public function retrieve(): array
  {
    return $this->apiCall->get($this->endpointPath(), []);
  }

  /**
   * @return array
   * @throws \Redwood\Typesence\Exceptions\TypesenseClientError|\GuzzleHttp\Exception\GuzzleException
   */
  public function delete(): array
  {
    return $this->apiCall->delete($this->endpointPath());
  }

}