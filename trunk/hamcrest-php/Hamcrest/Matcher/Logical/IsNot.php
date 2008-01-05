<?php
/*  Copyright (c) 2000-2008 hamcrest.org
 */
namespace Hamcrest;

/**
 * Calculates the logical negation of a matcher.
 */
class IsNot extends BaseMatcher  {
    private $matcher;

    public function __construct(Matcher $matcher) {
        $this->matcher = $matcher;
    }

    public function matches($arg) {
        return !$this->matcher->matches($arg);
    }

    public function describeTo(Description $description) {
        $description->appendText('not ')->appendDescriptionOf($this->matcher);
    }
}

/**
 * Inverts the rule.
 */
function not($matcherOrValue) {
    if ($matcherOrValue instanceof Matcher) {
        return new IsNot($matcherOrValue);
    } else {
        return new IsNot(equalTo($matcherOrValue));
    }
}
