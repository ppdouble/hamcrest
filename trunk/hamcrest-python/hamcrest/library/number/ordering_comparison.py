from hamcrest.core.base_matcher import BaseMatcher


def _comparison(compare):
    if compare > 0:
        return 'less than'
    elif compare == 0:
        return 'equal to'
    else:
        return 'greater than'


class OrderingComparison(BaseMatcher):
    """Is the value a number equal to a value within some range of acceptable error?"""
    
    def __init__(self, value, min_compare, max_compare):
        self.value = value
        self.min_compare = min_compare
        self.max_compare = max_compare

    def matches(self, item):
        compare = cmp(self.value, item)
        return self.min_compare <= compare and compare <= self.max_compare

    def describe_to(self, description):
        description.append_text('a value ').append_text(_comparison(self.min_compare))
        if self.min_compare != self.max_compare:
            description.append_text(' or ').append_text(_comparison(self.max_compare))
        description.append_text(' ').append_value(self.value)



def greaterthan(value):
    return OrderingComparison(value, -1, -1)

def greaterthan_or_equalto(value):
    return OrderingComparison(value, -1, 0)

def lessthan(value):
    return OrderingComparison(value, 1, 1)

def lessthan_or_equalto(value):
    return OrderingComparison(value, 0, 1)
