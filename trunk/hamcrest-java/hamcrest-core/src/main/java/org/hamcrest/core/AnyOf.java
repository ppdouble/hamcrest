package org.hamcrest.core;

import java.util.ArrayList;
import java.util.Arrays;
import java.util.List;

import org.hamcrest.Description;
import org.hamcrest.Factory;
import org.hamcrest.Matcher;

/**
 * Calculates the logical disjunction of two matchers. Evaluation is
 * shortcut, so that the second matcher is not called if the first
 * matcher returns <code>true</code>.
 */
public class AnyOf<T> extends ShortcutCombination<T> {
    public AnyOf(Iterable<Matcher<? super T>> matchers) {
        super(matchers);
    }

    @Override
    public boolean matches(Object o) {
        return matches(o, true);
    }

    @Override
    public void describeTo(Description description) {
        describeTo(description, "or");
    }

	/**
     * Evaluates to true if ANY of the passed in matchers evaluate to true.
     */
    @Factory
    public static <T> Matcher<T> anyOf(Matcher<? super T>... matchers) {
        return anyOf(Arrays.asList(matchers));
    }

    /**
     * Evaluates to true if ANY of the passed in matchers evaluate to true.
     */
    @Factory
    public static <T> Matcher<T> anyOf(Matcher<T> first, Matcher<? super T> second) {
    	List<Matcher<? super T>> matchers = new ArrayList<Matcher<? super T>>();
    	matchers.add(first);
    	matchers.add(second);
        return anyOf(matchers);
    }

    /**
     * Evaluates to true if ANY of the passed in matchers evaluate to true.
     */
    @Factory
    public static <T> Matcher<T> anyOf(Matcher<T> first, Matcher<? super T> second, Matcher<? super T> third) {
    	List<Matcher<? super T>> matchers = new ArrayList<Matcher<? super T>>();
    	matchers.add(first);
    	matchers.add(second);
    	matchers.add(third);
        return anyOf(matchers);
    }

    /**
     * Evaluates to true if ANY of the passed in matchers evaluate to true.
     */
    @Factory
    public static <T> Matcher<T> anyOf(Matcher<T> first, Matcher<? super T> second, Matcher<? super T> third, Matcher<? super T> forth) {
    	List<Matcher<? super T>> matchers = new ArrayList<Matcher<? super T>>();
    	matchers.add(first);
    	matchers.add(second);
    	matchers.add(third);
    	matchers.add(forth);
    	return anyOf(matchers);
    }

    /**
     * Evaluates to true if ANY of the passed in matchers evaluate to true.
     */
    @Factory
    public static <T> Matcher<T> anyOf(Matcher<T> first, Matcher<? super T> second, Matcher<? super T> third, Matcher<? super T> forth, Matcher<? super T> fifth) {
    	List<Matcher<? super T>> matchers = new ArrayList<Matcher<? super T>>();
    	matchers.add(first);
    	matchers.add(second);
    	matchers.add(third);
    	matchers.add(forth);
    	matchers.add(fifth);
        return anyOf(matchers);
    }

    /**
     * Evaluates to true if ANY of the passed in matchers evaluate to true.
     */
    @Factory
    public static <T> Matcher<T> anyOf(Matcher<T> first, Matcher<? super T> second, Matcher<? super T> third, Matcher<? super T> forth, Matcher<? super T> fifth, Matcher<? super T> sixth) {
    	List<Matcher<? super T>> matchers = new ArrayList<Matcher<? super T>>();
    	matchers.add(first);
    	matchers.add(second);
    	matchers.add(third);
    	matchers.add(forth);
    	matchers.add(fifth);
    	matchers.add(sixth);
        return anyOf(matchers);
    }

    /**
     * Evaluates to true if ANY of the passed in matchers evaluate to true.
     */
    @Factory
    public static <T> Matcher<T> anyOf(Iterable<Matcher<? super T>> matchers) {
        return new AnyOf<T>(matchers);
    }
}
