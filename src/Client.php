<?php
namespace Redwood\Typesence;

use Redwood\Typesence\Lib\Configuration;

class Client
{

  /**
   * @var \Redwood\Typesence\Lib\Configuration
   */
  private $config;

  /**
   * @var \Redwood\Typesence\Collections
   */
  public $collections;

  /**
   * @var \Redwood\Typesence\Aliases
   */
  public $aliases;

  /**
   * Client constructor.
   *
   * @param  array  $config
   *
   * @throws \Redwood\Typesence\Exceptions\ConfigError
   */
  public function __construct(array $config)
  {
    $this->config      = new Configuration($config);
    $this->collections = new Collections($this->config);
    $this->aliases     = new Aliases($this->config);
  }

  /**
   * @return \Redwood\Typesence\Collections
   */
  public function getCollections(): Collections
  {
    return $this->collections;
  }

  /**
   * @return \Redwood\Typesence\Aliases
   */
  public function getAliases(): Aliases
  {
    return $this->aliases;
  }

}