//
//  OCHamcrest - HCIsDictionaryContainingValue.h
//  Copyright 2011 hamcrest.org. See LICENSE.txt
//
//  Created by: Jon Reid
//

    // Inherited
#import <OCHamcrest/HCBaseMatcher.h>


/**
    Matches dictionaries containing a value satisfying a given matcher.
    @ingroup collection_matchers
 */
@interface HCIsDictionaryContainingValue : HCBaseMatcher
{
    id<HCMatcher> valueMatcher;
}

+ (id) isDictionaryContainingValue:(id<HCMatcher>)theValueMatcher;
- (id) initWithValueMatcher:(id<HCMatcher>)theValueMatcher;

@end


/**
    Matches dictionaries containing a value satisfying a given matcher.
 
    @b Synonym: @ref hasValue
    @param matcherOrValue  A matcher, or a value for @ref equalTo matching.
    @see HCIsDictionaryContainingValue
    @ingroup collection_matchers
 */
OBJC_EXPORT id<HCMatcher> HC_hasValue(id matcherOrValue);

/**
    Synonym for @ref HC_hasValue, available if @c HC_SHORTHAND is defined.
    @ingroup collection_matchers
 */
#ifdef HC_SHORTHAND
    #define hasValue HC_hasValue
#endif
