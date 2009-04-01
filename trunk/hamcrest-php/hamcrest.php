<?php

/*
 Copyright (c) 2009 hamcrest.org
 */

require_once 'Hamcrest/Matcher.php';
require_once 'Hamcrest/MatcherAssert.php';
require_once 'Hamcrest/Matchers.php';

/**
 * Make an assertion and throw {@link Hamcrest_AssertionError} if fails.
 * 
 * Example:
 * <pre>
 * //With an identifier
 * assertThat("assertion identifier", $apple->flavour(), equalTo("tasty"));
 * //Without an identifier
 * assertThat($apple->flavour(), equalTo("tasty"));
 * //Evaluating a boolean expression
 * assertThat("some error", $a > $b);
 * </pre>
 */
function assertThat()
{
  $args = func_get_args();
  return call_user_func_array(
    array('Hamcrest_MatcherAssert', 'assertThat'),
    $args
  );
}

/**
 * Evaluates to true only if ALL of the passed in matchers evaluate to true.
 */
function allOf()
{
  $args = func_get_args();
  return call_user_func_array(array('Hamcrest_Matchers', 'allOf'), $args);
}

/**
 * Evaluates to true if ANY of the passed in matchers evaluate to true.
 */
function anyOf()
{
  $args = func_get_args();
  return call_user_func_array(array('Hamcrest_Matchers', 'anyOf'), $args);
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
function both(Hamcrest_Matcher $matcher)
{
  return Hamcrest_Matchers::both($matcher);
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
function either(Hamcrest_Matcher $matcher)
{
  return Hamcrest_Matchers::either($matcher);
}

/**
 * Wraps an existing matcher and overrides the description when it fails.
 */
function describedAs()
{
  $args = func_get_args();
  return call_user_func_array(array('Hamcrest_Matchers', 'describedAs'), $args);
}

/**
 * Tests each item in an array against the given matcher.
 * 
 * @param Hamcrest_Matcher $itemMatcher
 *   A matcher to apply to every element in an array.
 */
function everyItem(Hamcrest_Matcher $itemMatcher)
{
  return Hamcrest_Matchers::everyItem($itemMatcher);
}

/**
 * Decorates another Matcher, retaining the behavior but allowing tests
 * to be slightly more expressive.
 *
 * For example:  assertThat($cheese, equalTo($smelly))
 *          vs.  assertThat($cheese, is(equalTo($smelly)))
 */
function is($value)
{
  return Hamcrest_Matchers::is($value);
}

/**
 * Calculates the logical negation of a matcher.
 */
function not($value)
{
  return Hamcrest_Matchers::not($value);
}

/**
 * This matcher always evaluates to true.
 *
 * @param string $description
 *   A meaningful string used when describing itself.
 */
function anything($description = 'ANYTHING')
{
  return Hamcrest_Matchers::anything($description);
}

/**
 * Is the value equal to another value, as tested by the use of the "=="
 * comparison operator?
 */
function equalTo($item)
{
  return Hamcrest_Matchers::equalTo($item);
}

/**
 * Tests if the argument is a string that contains a substring.
 */
function containsString($substring)
{
  return Hamcrest_Matchers::containsString($substring);
}

/**
 * Tests if the argument is a string that contains a substring.
 */
function endsWith($substring)
{
  return Hamcrest_Matchers::endsWith($substring);
}

/**
 * Tests if the argument is a string that contains a substring.
 */
function startsWith($substring)
{
  return Hamcrest_Matchers::startsWith($substring);
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
function hasItem()
{
  $args = func_get_args();
  return call_user_func_array(array('Hamcrest_Matchers', 'hasItem'), $args);
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
function hasItems()
{
  $args = func_get_args();
  return call_user_func_array(array('Hamcrest_Matchers', 'hasItems'), $args);
}

/**
 * Is the value an instance of a particular type?
 * This version assumes no relationship between the required type and
 * the signature of the method that sets it up, for example in
 * <code>assertThat($anObject, anInstanceOf('Thing'));</code>
 */
function anInstanceOf($theClass)
{
  return Hamcrest_Matchers::anInstanceOf($theClass);
}

/**
 * Alias for {@link anInstanceOf()}.
 */
function any($theClass)
{
  return Hamcrest_Matchers::any($theClass);
}

/**
 * Matches if value is null.
 */
function nullValue()
{
  return Hamcrest_Matchers::nullValue();
}

/**
 * Matches if value is not null.
 */
function notNullValue()
{
  return Hamcrest_Matchers::notNullValue();
}

/**
 * The predicate evaluates to true only when the argument is this object.
 */
function sameInstance($object)
{
  return Hamcrest_Matchers::sameInstance($object);
}

/**
 * Tests of the value is identical to $value as tested by the "===" operator.
 */
function identicalTo($value)
{
  return Hamcrest_Matchers::identicalTo($value);
}

/**
 * Is the value a number equal to a value within some range of
 * acceptable error?
 */
function closeTo($value, $delta)
{
  return Hamcrest_Matchers::closeTo($value, $delta);
}

/**
 * The value is not > $value, nor < $value.
 */
function comparesEqualTo($value)
{
  return Hamcrest_Matchers::comparesEqualTo($value);
}

/**
 * The value is > $value.
 */
function greaterThan($value)
{
  return Hamcrest_Matchers::greaterThan($value);
}

/**
 * The value is >= $value.
 */
function greaterThanOrEqualTo($value)
{
  return Hamcrest_Matchers::greaterThanOrEqualTo($value);
}

/**
 * The value is < $value.
 */
function lessThan($value)
{
  return Hamcrest_Matchers::lessThan($value);
}

/**
 * The value is <= $value.
 */
function lessThanOrEqualTo($value)
{
  return Hamcrest_Matchers::lessThanOrEqualTo($value);
}

/**
 * Matches if value is zero-length string.
 */
function isEmptyString()
{
  return Hamcrest_Matchers::isEmptyString();
}

/**
 * Matches if value is null or zero-length string.
 */
function isEmptyOrNullString()
{
  return Hamcrest_Matchers::isEmptyOrNullString();
}

/**
 * Tests if a string is equal to another string, regardless of the case.
 */
function equalToIgnoringCase($string)
{
  return Hamcrest_Matchers::equalToIgnoringCase($string);
}

/**
 * Tests if a string is equal to another string, ignoring any changes in
 * whitespace.
 */
function equalToIgnoringWhiteSpace($string)
{
  return Hamcrest_Matchers::equalToIgnoringWhiteSpace($string);
}

/**
 * Tests if the value contains a series of substrings in a constrained order.
 */
function stringContainsInOrder(array $substrings)
{
  return Hamcrest_Matchers::stringContainsInOrder($substrings);
}

/**
 * Evaluates to true only if each $matcher[$i] is satisfied by $array[$i].
 */
function anArray($array)
{
  return Hamcrest_Matchers::anArray($array);
}

/**
 * Evaluates to true if any item in an array satisfies the given matcher.
 * 
 * @param mixed $item as a {@link Hamcrest_Matcher} or a value.
 */
function hasItemInArray($item)
{
  return Hamcrest_Matchers::hasItemInArray($item);
}

/**
 * An array with elements that match the given matchers.
 */
function containsInAnyOrder(array $items)
{
  return Hamcrest_Matchers::containsInAnyOrder($items);
}

/**
 * An array with elements that match the given matchers in the same order.
 */
function contains(array $items)
{
  return Hamcrest_Matchers::contains($matchers);
}

/**
 * An array with elements that match the given matchers in the same order.
 */
function arrayContaining(array $items)
{
  return Hamcrest_Matchers::arrayContaining($items);
}

/**
 * Does array size satisfy a given matcher?
 */
function arrayWithSize($size)
{
  return Hamcrest_Matchers::arrayWithSize($size);
}

/**
 * Matches an empty array.
 */
function emptyArray()
{
  return Hamcrest_Matchers::emptyArray();
}

/**
 * Test if an array has both an key and value in parity with each other.
 */
function hasKeyValuePair($key, $value)
{
  return Hamcrest_Matchers::hasKeyValuePair($key, $value);
}
