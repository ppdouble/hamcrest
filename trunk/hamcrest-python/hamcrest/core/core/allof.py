from shortcut_combination import ShortcutCombination


class AllOf(ShortcutCombination):
    """Calculates the logical conjunction of multiple matchers.
    
    Evaluation is shortcut, so subsequent matchers are not called if an earlier
    matcher returns False.
    """
    
    def __init__(self, *matchers):
        super(AllOf, self).__init__(*matchers)
    
    def matches(self, item):
        return self._matches(item, False)
    
    def describe_to(self, description):
        self._describe_to(description, 'and')


"""Evaluates to true only if ALL of the passed in matchers evaluate to true."""
all_of = AllOf  # Can use directly without a function.
