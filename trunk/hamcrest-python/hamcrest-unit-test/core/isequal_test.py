if __name__ == '__main__':
    import sys
    sys.path.insert(0, '..')
    sys.path.insert(0, '../..')

import unittest

from hamcrest.core.core.isequal import equal_to
from hamcrest.core.core.isnot import is_not
from hamcrest.core.matcher_assert import assert_that

from matcher_test import MatcherTest


class FakeArgument:
    def __str__(self):
        return 'ARGUMENT DESCRIPTION'


class IsEqualTest(MatcherTest):

    def testComparesObjectsUsingEquality(self):
        assert_that('hi', equal_to('hi'))
        assert_that('bye', is_not(equal_to('hi')))

        assert_that(1, equal_to(1))
        assert_that(1, is_not(equal_to(2)))

    def testIncludesTheResultOfCallingToStringOnItsArgumentInTheDescription(self):
        self.assert_description('<ARGUMENT DESCRIPTION>', equal_to(FakeArgument()))

    def testReturnsAnObviousDescriptionIfCreatedWithANestedMatcherByMistake(self):
        inner_matcher = equal_to('NestedMatcher')
        self.assert_description('<' + str(inner_matcher) + '>', equal_to(inner_matcher))


if __name__ == '__main__':
    unittest.main()
