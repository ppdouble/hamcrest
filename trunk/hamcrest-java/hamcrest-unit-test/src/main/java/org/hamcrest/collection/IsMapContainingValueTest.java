package org.hamcrest.collection;

import java.util.HashMap;
import java.util.Map;

import org.hamcrest.AbstractMatcherTest;
import org.hamcrest.Matcher;
import static org.hamcrest.collection.IsMapContainingValue.hasValue;

public class IsMapContainingValueTest extends AbstractMatcherTest {

    @Override
    protected Matcher<?> createMatcher() {
        return hasValue("foo");
    }

    public void testHasReadableDescription() {
        assertDescription("map with value \"a\"", hasValue("a"));
    }
    
    public void testDoesNotMatchEmptyMap() {
        Map<String,Integer> map = new HashMap<String,Integer>();
        assertMismatchDescription("map was []", hasValue(1), map);
    }
    
    public void testMatchesSingletonMapContainingValue() {
        Map<String,Integer> map = new HashMap<String,Integer>();
        map.put("a", 1);
        
        assertMatches("Singleton map", hasValue(1), map);
    }

//    No longer compiles -- SF
//    @SuppressWarnings("unchecked")
//    public void testMatchesSingletonMapContainingValueWithoutGenerics() {
//        Map map = new HashMap();
//        map.put("a", 1);
//
//        assertMatches("Singleton map", hasValue(1), map);
//    }

    public void testMatchesMapContainingValue() {
        Map<String,Integer> map = new HashMap<String,Integer>();
        map.put("a", 1);
        map.put("b", 2);
        map.put("c", 3);
        
        assertMatches("hasValue 1", hasValue(1), map);      
        assertMatches("hasValue 3", hasValue(3), map);      
        assertMismatchDescription("map was [<a=1>, <c=3>, <b=2>]", hasValue(4), map);      
    }
}
