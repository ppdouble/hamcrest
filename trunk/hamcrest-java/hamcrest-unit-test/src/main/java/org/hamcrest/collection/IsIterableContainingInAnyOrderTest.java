package org.hamcrest.collection;

import java.util.Collections;

import org.hamcrest.AbstractMatcherTest;
import org.hamcrest.Matcher;

import static org.hamcrest.collection.IsIterableContainingInAnyOrder.*;

import static java.util.Arrays.asList;

public class IsIterableContainingInAnyOrderTest extends AbstractMatcherTest {

    @Override
    protected Matcher<?> createMatcher() {
        return containsInAnyOrder(1, 2);
    }   

    public void testMatchesSingleItemIterable() {
      assertMatches("single item", containsInAnyOrder(1), asList(1));
    }

    public void testDoesNotMatchEmpty() {
        assertMismatchDescription("iterable was []", containsInAnyOrder(1, 2), Collections.<Integer>emptyList());
    }
    
    public void testMatchesIterableOutOfOrder() {
        assertMatches("Out of order", containsInAnyOrder(1, 2), asList(2, 1));
    }
    
    public void testMatchesIterableInOrder() {
        assertMatches("In order", containsInAnyOrder(1, 2), asList(1, 2));
    }
    
    public void testDoesNotMatchIfOneOfMultipleElementsMismatches() {
        assertMismatchDescription("iterable was [<1>, <2>, <4>]", containsInAnyOrder(1, 2, 3), asList(1, 2, 4));
    }
    
    public void testDoesNotMatchIfThereAreMoreElementsThanMatchers() {
        assertMismatchDescription("iterable was [<1>, <2>, <3>, <4>]", containsInAnyOrder(1, 2, 3), asList(1, 2, 3, 4));
    }
    
    public void testDoesNotMatchIfThereAreMoreMatchersThanElements() {
        assertMismatchDescription("iterable was [<1>, <2>, <3>]", containsInAnyOrder(1, 2, 3, 4), asList(1, 2, 3));
    }

    public void testHasAReadableDescription() {
        assertDescription("iterable over [<1>, <2>] in any order", containsInAnyOrder(1, 2));
    }
}
