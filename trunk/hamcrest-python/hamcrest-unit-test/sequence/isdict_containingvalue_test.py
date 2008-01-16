if __name__ == '__main__':
    import sys
    sys.path.insert(0, '..')
    sys.path.insert(0, '../..')

import unittest

from hamcrest.core.core.isequal import equalto
from hamcrest.library.sequence.isdict_containingvalue import hasvalue

from matcher_test import MatcherTest
from quasidict import QuasiDictionary


class IsDictContainingValueTest(MatcherTest):

    def testHasReadableDescription(self):
        self.assert_description("dictionary with value 'a'", hasvalue('a'))

    def testDoesNotMatchEmptyMap(self):
        self.assert_does_not_match('Empty dictionary', hasvalue(1), {});

    def testMatchesSingletonDictContainingValue(self):
        d = {'a': 1}
        self.assert_matches('Matches single value', hasvalue(equalto(1)), d)

    def testMatchesDictContainingValue(self):
        d = {'a': 1, 'b': 2, 'c': 3}
        self.assert_matches('hasvalue 1', hasvalue(equalto(1)), d)
        self.assert_matches('hasvalue 3', hasvalue(equalto(3)), d)

    def testProvidesConvenientShortcutForMatchingWithIsEqualTo(self):
        d = {'a': 1, 'b': 2, 'c': 3}
        self.assert_matches('Matches c', hasvalue(3), d)

    def testDoesNotMatchMapMissingValue(self):
        d = {'a': 1, 'b': 2, 'c': 3}
        self.assert_does_not_match('Dictionary without matching value',
                                    hasvalue(4), d)

    def testMatchesQuasiDictionary(self):
        quasi = QuasiDictionary()
        self.assert_matches('quasi', hasvalue('1'), quasi)
        self.assert_does_not_match('other', hasvalue('1'), object())


if __name__ == '__main__':
    unittest.main()
