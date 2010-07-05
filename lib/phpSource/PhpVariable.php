<?php
/**
 * @package phpSource
 */

namespace phpSource;

/**
 * Include the needed files
 */
require_once \dirname(__FILE__).'/PhpElement.php';

/**
 * Class that represents the source code for a variable in php
 *
 * @package phpSource
 * @author Fredrik Wallgren <fredrik@wallgren.me>
 * @license http://www.opensource.org/licenses/mit-license.php MIT License
 */
class PhpVariable extends \phpSource\PhpElement
{
  /**
   *
   * @var \phpSource\PhpDocComment A comment in phpdoc format that describes the variable
   * @access private
   */
  private $comment;

  /**
   *
   * @var string The value of the initialized value
   * @access private
   */
  private $initialization;

  /**
   *
   * @param string $access
   * @param string $identifier
   * @param string $initialization The value to set the variable at initialization
   * @param \phpSource\PhpDocComment $comment
   */
  function __construct($access, $identifier, $initialization = '', \phpSource\PhpDocComment $comment = null)
  {
    $this->comment = $comment;
    $this->access = $access;
    $this->identifier = $identifier;
    $this->initialization = '';
    if (\strlen($initialization))
    {
      $this->initialization = ' = '.$initialization;
    }
  }

  /**
   *
   * @return string Returns the complete source code for the variable
   * @access public
   */
  public function getSource()
  {
    $ret = '';

    if ($this->comment !== null)
    {
      $ret .= \PHP_EOL.$this->getSourceRow($this->comment->getSource());
    }

    $ret .= $this->getSourceRow($this->access.' $'.$this->identifier.$this->initialization.';');

    return $ret;
  }
}