<?php /* #?ini charset="utf-8"?
[AvailableTests]
Tests[]
Tests[]=inisettings
Tests[]=environment


[inisettings]
Name=System INI Checks
# These should look like:
# SystemINIChecks[]=eq;file.ini;BlockName;SettingName;expectedValue;Friendly Name
# The first parameter is the test type. Currently you can do:
# eq: Test for equality
# ne: Test for inequality
# gt: Test that the system value is greater than the specified one
# lt: Test that the system value is less than the specified one
# all_eq: Test that all values in a list are equal

SystemINIChecks[]
SystemINIChecks[]=eq;site.ini;TemplateSettings;TemplateCompile;enabled;Template compilation
SystemINIChecks[]=eq;site.ini;TemplateSettings;TemplateCache;enabled;Template cache
SystemINIChecks[]=eq;site.ini;TemplateSettings;TemplateOptimization;enabled;Template optimization 
SystemINIChecks[]=eq;site.ini;OverrideSettings;Cache;enabled;Override cache
SystemINIChecks[]=ne;site.ini;TemplateSettings;DevelopmentMode;enabled;Template development mode
SystemINIChecks[]=eq;site.ini;ContentSettings;ViewCaching;enabled;View caching
SystemINIChecks[]=eq;site.ini;SearchSettings;DelayedIndexing;enabled;Delayed search engine indexing

[environment]
Name=Server Environment Checks

PHPSettings[]
PHPSettings[]=gt;memory_limit;32M;PHP memory limit
PHPSettings[]=eq;register_globals;0;Register global variables from request data
PHPSettings[]=eq;display_errors;0;Display PHP errors inline in output
PHPSettings[]=eq;magic_quotes_gpc;0;Automatic escaping of GET/POST/cookie data
PHPSettings[]=eq;magic_quotes_runtime;0;Automatic escaping of runtime data such as SQL results
 */ ?>
