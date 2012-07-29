
## 1.5.0
 * Factual::rawGet() now takes only array of key/values, and performs encoding
 * Factual::debug() now outputs exclusively to stderr
 * Added Diffs API support
 * Added Submit API support
 * Normalized Response Class inheritance
 * Added Flag API support
 * Removed MulitResponse::getData(); now returns only array of Response objects
 * Removed syntactic sugar (old, deprecated) version of Crosswalk
 * Moved documentation to [GitHub Wiki](https://github.com/Factual/factual-php-driver/wiki) from readme.md
 * Added Match API support
 * Factual::resolve() shortcut supported; now returns ResolveResponse
 
## 1.4.3
 * Deprecated syntactic sugar version of Crosswalk; now use regular table read
 * Added Monetize API support.
 * Added debug mode

## 1.4.0
 * Added Multi API support
 * Added Geopulse API support
 * Added Factual Reverse Geocode API support
 * Added World Geographies documentation
 * Improved autoload() compatibility

## 1.2.1
 * Added Facets
 * Moved exception detection and handling to class Factual (from the native Oauth class which failed to pass through important debug info)
 * Added Factual::rawGet()

## 1.0.2
 * Updated test CLI for Windows 

## 1.0.1
 * Filters now accept only arrays

## 1.0
 * Initial release
