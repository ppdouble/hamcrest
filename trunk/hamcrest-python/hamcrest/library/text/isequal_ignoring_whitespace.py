from hamcrest.core.base_matcher import BaseMatcher


class IsEqualIgnoringWhiteSpace(BaseMatcher):

    def __init__(self, string):
        if not isinstance(string, str):
            raise TypeError('IsEqualIgnoringWhiteSpace requires string')
        self.string = string
    
    def matches(self, item):
        if not isinstance(item, str):
            return False
        return stripspace(self.string) == stripspace(item)

    def describe_to(self, description):
        description.append_text('eqIgnoringWhiteSpace(')    \
                    .append_value(self.string)              \
                    .append_text(')')


def stripspace(string):
    result = ''
    last_was_space = True
    for character in string:
        if character.isspace():
            if not last_was_space:
                result += ' '
            last_was_space = True
        else:
            result += character
            last_was_space = False
    return result.strip()


equal_to_ignoring_whitespace = IsEqualIgnoringWhiteSpace
