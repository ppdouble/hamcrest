/*  Copyright (c) 2000-2006 hamcrest.org
 */
package org.hamcrest.core;

import org.hamcrest.AbstractMatcherTest;
import org.hamcrest.Matcher;
import static org.hamcrest.MatcherAssert.assertThat;
import static org.hamcrest.core.IsInstanceOf.instanceOf;
import static org.hamcrest.core.IsNot.not;

public class IsInstanceOfTest extends AbstractMatcherTest {

    protected Matcher<?> createMatcher() {
        return instanceOf(Number.class);
    }

    public void testEvaluatesToTrueIfArgumentIsInstanceOfASpecificClass() {
        assertThat(1, instanceOf(Number.class));
        assertThat(1.0, instanceOf(Number.class));
        assertThat(null, not(instanceOf(Number.class)));
        assertThat("hello", not(instanceOf(Number.class)));
    }

}
