/*  Copyright (c) 2000-2006 hamcrest.org
 */
package org.hamcrest.core;

import static org.hamcrest.core.IsEqual.equalTo;
import org.hamcrest.AbstractMatcherTest;
import org.hamcrest.Matcher;
import static org.hamcrest.core.IsNot.not;

public class IsNotTest extends AbstractMatcherTest {

    protected Matcher<?> createMatcher() {
        return not("something");
    }

    public void testEvaluatesToTheTheLogicalNegationOfAnotherMatcher() {
        assertMatches("should match", not(equalTo("A")), "B");
        assertDoesNotMatch("should not match", not(equalTo("B")), "B");
    }

    public void testProvidesConvenientShortcutForNotEqualTo() {
        assertMatches("should match", not("A"), "B");
        assertMatches("should match", not("B"), "A");
        assertDoesNotMatch("should not match", not("A"), "A");
        assertDoesNotMatch("should not match", not("B"), "B");
        assertDescription("not \"A\"", not("A"));
    }

}
