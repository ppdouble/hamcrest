<?php

/*
 Copyright (c) 2009 hamcrest.org
 */

require_once 'Hamcrest/BaseMatcher.php';
require_once 'Hamcrest/Description.php';

/**
 * Tests if a string is equal to another string, ignoring any changes in
 * whitespace.
 */
class Hamcrest_Text_IsEqualIgnoringWhiteSpace extends Hamcrest_BaseMatcher
{
  
  private $_string;
  
  public function __construct($string)
  {
    $this->_string = $string;
  }
  
  public function matches($item)
  {
    if (!is_string($item) &&
      !(is_object($item) && method_exists($item, '__toString')))
    {
      return false;
    }
    
    return (strtolower($this->_stripSpace($item))
        === strtolower($this->_stripSpace($this->_string)));
  }
  
  public function describeMismatch($item,
    Hamcrest_Description $mismatchDescription)
  {
    $mismatchDescription->appendText('was ')->appendValue($item);
  }
  
  public function describeTo(Hamcrest_Description $description)
  {
    $description->appendText('equalToIgnoringWhiteSpace(')
                ->appendValue($this->_string)
                ->appendText(')')
                ;
  }
  
  /**
   * @hamcrest(factory)
   */
  public static function equalToIgnoringWhiteSpace($string)
  {
    return new self($string);
  }
  
  // -- Private Methods
  
  private function _stripSpace($string)
  {
    $parts = preg_split("/[\r\n\t ]+/", $string);
    foreach ($parts as $i => $part)
    {
      $parts[$i] = trim($part, " \r\n\t");
    }
    return trim(implode(' ', $parts), " \r\n\t");
  }
  
}
