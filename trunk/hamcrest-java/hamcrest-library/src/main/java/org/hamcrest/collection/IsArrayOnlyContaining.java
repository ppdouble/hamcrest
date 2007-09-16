package org.hamcrest.collection;

import static org.hamcrest.core.AnyOf.anyOf;
import static org.hamcrest.core.IsEqual.equalTo;

import java.util.ArrayList;
import java.util.List;

import org.hamcrest.Description;
import org.hamcrest.Factory;
import org.hamcrest.Matcher;
import org.hamcrest.TypeSafeMatcher;

/**
 * Matches arrays where all elements satisfy the specified matcher. 
 * This is the array equivalent of {@link IsCollectionOnlyContaining}
 * 
 * @author ngd
 */
public class IsArrayOnlyContaining<T> extends TypeSafeMatcher<T[]> {

	private final Matcher<? super T> matcher;
	
	public IsArrayOnlyContaining(Matcher<? super T> matcher) {
		this.matcher = matcher;
	}
	
	@Override
	public boolean matchesSafely(T[] items) {
		if (items.length == 0) {
			return false;
		}
		for (T item : items) {
			if (!matcher.matches(item)) {
				return false;
			}
		}		
		return true;
	}

	public void describeTo(Description description) {
		description
			.appendText("is array containing items matching ")
			.appendDescriptionOf(matcher);		
	}

	@Factory 
	public static <T> Matcher<T[]> isArrayOnlyContaining(T...items) {
		List<Matcher<? super T>> matchers = new ArrayList<Matcher<? super T>>();
		for (T item : items) {
			matchers.add(equalTo(item));
		}
		return new IsArrayOnlyContaining<T>(anyOf(matchers));
	}
	
	@Factory 
	public static <T> Matcher<T[]> isArrayOnlyContaining(Matcher<? super T>...matchers) {
		return new IsArrayOnlyContaining<T>(anyOf(matchers));
	}
}
