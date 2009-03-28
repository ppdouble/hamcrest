<?php

/*
 Copyright (c) 2009 hamcrest.org
 */

require_once 'Hamcrest/Matcher.php';
require_once 'Hamcrest/Core/AllOf.php';
require_once 'Hamcrest/Core/AnyOf.php';
require_once 'Hamcrest/Core/CombinableMatcher.php';
require_once 'Hamcrest/Core/DescribedAs.php';
require_once 'Hamcrest/Core/Every.php';
require_once 'Hamcrest/Core/Is.php';
require_once 'Hamcrest/Core/IsAnything.php';
require_once 'Hamcrest/Core/IsCollectionContaining.php';
require_once 'Hamcrest/Core/IsEqual.php';
require_once 'Hamcrest/Core/IsInstanceOf.php';
require_once 'Hamcrest/Core/IsNot.php';
require_once 'Hamcrest/Core/IsNull.php';
require_once 'Hamcrest/Core/IsSame.php';
require_once 'Hamcrest/Core/IsIdentical.php';
require_once 'Hamcrest/Core/StringContains.php';
require_once 'Hamcrest/Core/StringEndsWith.php';
require_once 'Hamcrest/Core/StringStartsWith.php';
require_once 'Hamcrest/Number/IsCloseTo.php';
require_once 'Hamcrest/Number/OrderingComparison.php';
require_once 'Hamcrest/Text/IsEmptyString.php';
require_once 'Hamcrest/Text/IsEqualIgnoringCase.php';
require_once 'Hamcrest/Text/IsEqualIgnoringWhiteSpace.php';
require_once 'Hamcrest/Text/StringContainsInOrder.php';

//TODO: Seriously look at code-generation for this file (and for hamcrest.php)

/**
 * A series of static factories for all hamcrest matchers.
 */
class Hamcrest_Matchers
{
  
  /**
   * Evaluates to true only if ALL of the passed in matchers evaluate to true.
   */
  public static function allOf()
  {
    $args = func_get_args();
    return call_user_func_array(array('Hamcrest_Core_AllOf', 'allOf'), $args);
  }
  
  /**
   * Evaluates to true if ANY of the passed in matchers evaluate to true.
   */
  public static function anyOf()
  {
    $args = func_get_args();
    return call_user_func_array(array('Hamcrest_Core_AnyOf', 'anyOf'), $args);
  }
  
  /**
   * This is useful for fluently combining matchers that must both pass.
   * For example:
   * <pre>
   *   assertThat($string, both(containsString("a"))->andAlso(containsString("b")));
   * </pre>
   * 
   * @param Hamcrest_Matcher $itemMatcher
   */
  public static function both(Hamcrest_Matcher $matcher)
  {
    return Hamcrest_Core_CombinableMatcher::both($matcher);
  }
  
  /**
   * This is useful for fluently combining matchers where either may pass,
   * for example:
   * <pre>
   *   assertThat($string, either(containsString("a"))->orElse(containsString("b")));
   * </pre>
   * 
   * @param Hamcrest_Matcher $matcher
   */
  public static function either(Hamcrest_Matcher $matcher)
  {
    return Hamcrest_Core_CombinableMatcher::either($matcher);
  }
  
  /**
   * Wraps an existing matcher and overrides the description when it fails.
   */
  public static function describedAs()
  {
    $args = func_get_args();
    return call_user_func_array(array('Hamcrest_Core_DescribedAs', 'describedAs'), $args);
  }
  
  /**
   * Tests each item in an array against the given matcher.
   * 
   * @param Hamcrest_Matcher $itemMatcher
   *   A matcher to apply to every element in an array.
   */
  public static function everyItem(Hamcrest_Matcher $itemMatcher)
  {
    return Hamcrest_Core_Every::everyItem($itemMatcher);
  }
  
  /**
   * Decorates another Matcher, retaining the behavior but allowing tests
   * to be slightly more expressive.
   *
   * For example:  assertThat($cheese, equalTo($smelly))
   *          vs.  assertThat($cheese, is(equalTo($smelly)))
   */
  public static function is($value)
  {
    return Hamcrest_Core_Is::is($value);
  }
  
  /**
   * Calculates the logical negation of a matcher.
   */
  public static function not($value)
  {
    return Hamcrest_Core_IsNot::not($value);
  }
  
  /**
   * This matcher always evaluates to true.
   *
   * @param string $description
   *   A meaningful string used when describing itself.
   */
  public static function anything($description = 'ANYTHING')
  {
    return Hamcrest_Core_IsAnything::anything($description);
  }
  
  /**
   * Is the value equal to another value, as tested by the use of the "=="
   * comparison operator?
   */
  public static function equalTo($item)
  {
    return Hamcrest_Core_IsEqual::equalTo($item);
  }
  
  /**
   * Tests if the argument is a string that contains a substring.
   */
  public static function containsString($substring)
  {
    return Hamcrest_Core_StringContains::containsString($substring);
  }
  
  /**
   * Tests if the argument is a string that contains a substring.
   */
  public static function endsWith($substring)
  {
    return Hamcrest_Core_StringEndsWith::endsWith($substring);
  }
  
  /**
   * Tests if the argument is a string that contains a substring.
   */
  public static function startsWith($substring)
  {
    return Hamcrest_Core_StringStartsWith::startsWith($substring);
  }
  
  /**
   * Test if the value is an array containing this matcher.
   * 
   * Example:
   * <pre>
   * assertThat(array('a', 'b'), hasItem(equalTo('b')));
   * //Convenience defaults to equalTo()
   * assertThat(array('a', 'b'), hasItem('b'));
   * </pre>
   */
  public static function hasItem()
  {
    $args = func_get_args();
    return call_user_func_array(array('Hamcrest_Core_IsCollectionContaining', 'hasItem'), $args);
  }
  
  /**
   * Test if the value is an array containing elements that match all of these
   * matchers.
   * 
   * Example:
   * <pre>
   * assertThat(array('a', 'b', 'c'), hasItems(equalTo('a'), equalTo('b')));
   * </pre>
   */
  public static function hasItems()
  {
    $args = func_get_args();
    return call_user_func_array(array('Hamcrest_Core_IsCollectionContaining', 'hasItems'), $args);
  }
  
  /**
   * Is the value an instance of a particular type?
   * This version assumes no relationship between the required type and
   * the signature of the method that sets it up, for example in
   * <code>assertThat($anObject, anInstanceOf('Thing'));</code>
   */
  public static function anInstanceOf($theClass)
  {
    return Hamcrest_Core_IsInstanceOf::anInstanceOf($theClass);
  }
  
  /**
   * Alias for {@link anInstanceOf()}.
   */
  public static function any($theClass)
  {
    return Hamcrest_Core_IsInstanceOf::any($theClass);
  }
  
  /**
   * Matches if value is null.
   */
  public static function nullValue()
  {
    return Hamcrest_Core_IsNull::nullValue();
  }
  
  /**
   * Matches if value is not null.
   */
  public static function notNullValue()
  {
    return Hamcrest_Core_IsNull::notNullValue();
  }
  
  /**
   * The predicate evaluates to true only when the argument is this object.
   */
  public function sameInstance($object)
  {
    return Hamcrest_Core_IsSame::sameInstance($object);
  }
  
  /**
   * Tests of the value is identical to $value as tested by the "===" operator.
   */
  public function identicalTo($value)
  {
    return Hamcrest_Core_IsIdentical::identicalTo($value);
  }
  
  /**
   * Is the value a number equal to a value within some range of
   * acceptable error?
   */
  public static function closeTo($value, $delta)
  {
    return Hamcrest_Number_IsCloseTo::closeTo($value, $delta);
  }
  
  /**
   * The value is not > $value, nor < $value.
   */
  public static function comparesEqualTo($value)
  {
    return Hamcrest_Number_OrderingComparison::comparesEqualTo($value);
  }
  
  /**
   * The value is > $value.
   */
  public static function greaterThan($value)
  {
    return Hamcrest_Number_OrderingComparison::greaterThan($value);
  }
  
  /**
   * The value is >= $value.
   */
  public static function greaterThanOrEqualTo($value)
  {
    return Hamcrest_Number_OrderingComparison::greaterThanOrEqualTo($value);
  }
  
  /**
   * The value is < $value.
   */
  public static function lessThan($value)
  {
    return Hamcrest_Number_OrderingComparison::lessThan($value);
  }
  
  /**
   * The value is <= $value.
   */
  public static function lessThanOrEqualTo($value)
  {
    return Hamcrest_Number_OrderingComparison::lessThanOrEqualTo($value);
  }
  
  /**
   * Matches if value is zero-length string.
   */
  public static function isEmptyString()
  {
    return Hamcrest_Text_IsEmptyString::isEmptyString();
  }
  
  /**
   * Matches if value is null or zero-length string.
   */
  public static function isEmptyOrNullString()
  {
    return Hamcrest_Text_IsEmptyString::isEmptyOrNullString();
  }
  
  /**
   * Tests if a string is equal to another string, regardless of the case.
   */
  public function equalToIgnoringCase($string)
  {
    return Hamcrest_Text_IsEqualIgnoringCase::equalToIgnoringCase($string);
  }
  
  /**
   * Tests if a string is equal to another string, ignoring any changes in
   * whitespace.
   */
  public static function equalToIgnoringWhiteSpace($string)
  {
    return Hamcrest_Text_IsEqualIgnoringWhiteSpace::equalToIgnoringWhiteSpace($string);
  }
  
  /**
   * Tests if the value contains a series of substrings in a constrained order.
   */
  public static function stringContainsInOrder(array $substrings)
  {
    return Hamcrest_Text_StringContainsInOrder::stringContainsInOrder($substrings);
  }
  
}
