//
//  OCHamcrest - HCStringEndsWith.h
//  Copyright 2009 www.hamcrest.org. See LICENSE.txt
//
//  Created by: Jon Reid
//

    // Inherited
#import <OCHamcrest/HCSubstringMatcher.h>


/**
    Tests if the argument is a string that ends with a substring.
 */
@interface HCStringEndsWith : HCSubstringMatcher
{
}

+ (HCStringEndsWith*) stringEndsWith:(NSString*)aSubstring;

@end


/**
    Tests if the argument is a string that ends with a substring.
 */
OBJC_EXPORT id<HCMatcher> HC_endsWith(NSString* aSubstring);

/**
    Shorthand for HC_endsWith, available if HC_SHORTHAND is defined.
 */
#ifdef HC_SHORTHAND
    #define endsWith HC_endsWith
#endif
