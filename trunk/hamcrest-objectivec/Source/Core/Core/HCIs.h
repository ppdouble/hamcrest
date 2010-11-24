//
//  OCHamcrest - HCIs.h
//  Copyright 2009 www.hamcrest.org. See LICENSE.txt
//
//  Created by: Jon Reid
//

    // Inherited
#import <OCHamcrest/HCBaseMatcher.h>


/**
    Decorates another HCMatcher, retaining the behavior but allowing tests to be slightly more
    expressive.

    For example:
@code
assertThat(cheese, equalTo(smelly))
@endcode
    vs.
@code
assertThat(cheese, is(equalTo(smelly)))
@endcode
 */
@interface HCIs : HCBaseMatcher
{
    id<HCMatcher> matcher;
}

+ (HCIs*) is:(id<HCMatcher>)aMatcher;
- (id) initWithMatcher:(id<HCMatcher>)aMatcher;

@end


/**
    Decorates an item, providing shortcuts to the frequently used is(equalTo(x)).
    
    For example:
@code
assertThat(cheese, is(equalTo(smelly)))
@endcode
    vs.
@code
assertThat(cheese, is(smelly))
@endcode
 */
OBJC_EXPORT id<HCMatcher> HC_is(id item);

/**
    Shorthand for HC_is, available if HC_SHORTHAND is defined.
 */
#ifdef HC_SHORTHAND
    #define is HC_is
#endif
