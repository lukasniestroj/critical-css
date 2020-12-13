# TYPO3 Extension critical-css

## Some advice

* this extension does not generate critical css for you!
* 

## Features

* load included CSS files asynchronously (only page.includeCSS and page.includeCSSLibs are supported)
* simple configuration

## Setup

```
composer require lukasniestroj/critical-css
```

## Configuration

If you install this extension every CSS file references in typoscript will be loaded asynchronously.
I advice you to mark your "critical" css file with the property critical=1. 
This will exclude the css file from loading asynchronously. Otherwise your website users will see a screen flicker based on their connection.   

## Example

```
page.includeCSS.<your-key> = <your-path-to-your-critical-css-file>.css
page.includeCSS.<your-key>.critical = 1
```