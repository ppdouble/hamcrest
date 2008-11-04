package org.hamcrest.internal;

import java.util.Iterator;

public class ArrayIterator implements Iterator<Object> {
    private final Object array;
    private int currentIndex = 0;
    
    public ArrayIterator(Object array) {
        if (!array.getClass().isArray()) {
            throw new IllegalArgumentException("not an array");
        }
        this.array = array;
    }
    
    public boolean hasNext() {
        return currentIndex < ArrayAccess.getLength(array);
    }

    public Object next() {
        return ArrayAccess.get(array, currentIndex++);
    }
    
    public void remove() {
        throw new UnsupportedOperationException("cannot remove items from an array");
    }
}
