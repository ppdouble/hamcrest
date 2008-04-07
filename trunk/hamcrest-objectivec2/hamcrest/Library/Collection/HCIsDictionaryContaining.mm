#import "HCIsDictionaryContaining.h"

#import "HCDescription.h"
#import "HCWrapShortcut.h"


@implementation HCIsDictionaryContaining

+ (HCIsDictionaryContaining*) isDictionaryContainingKey:(id<HCMatcher>)theKeyMatcher
                                                  value:(id<HCMatcher>)theValueMatcher;
{
    return [[[HCIsDictionaryContaining alloc]
                    initWithKeyMatcher:theKeyMatcher valueMatcher:theValueMatcher] autorelease];
}


- (id) initWithKeyMatcher:(id<HCMatcher>)theKeyMatcher valueMatcher:(id<HCMatcher>)theValueMatcher;
{
    self = [super init];
    if (self != nil)
    {
        keyMatcher = [theKeyMatcher retain];
        valueMatcher = [theValueMatcher retain];
    }
    return self;
}


- (void) dealloc
{
    [valueMatcher release];
    [keyMatcher release];
    
    [super dealloc];
}


- (BOOL) matches:(id)dict
{
    if ([dict isKindOfClass:[NSDictionary class]])
        for (id oneKey in dict)
            if ([keyMatcher matches:oneKey] && [valueMatcher matches:[dict objectForKey:oneKey]])
                return YES;
    return NO;
}


- (void) describeTo:(id<HCDescription>)description
{
    [[[[[description appendText:@"dictionary containing ["]
                    appendDescriptionOf:keyMatcher]
                    appendText:@"->"]
                    appendDescriptionOf:valueMatcher]
                    appendText:@"]"];
}

@end


extern "C" {

id<HCMatcher> HC_hasEntry(id key, id value)
{
    return [HCIsDictionaryContaining isDictionaryContainingKey:HC_wrapShortcut(key)
                                                         value:HC_wrapShortcut(value)];
}

}   // extern "C"
