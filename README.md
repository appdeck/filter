filter
=====

User input sanitization & validation

[![Build Status](https://travis-ci.org/appdeck/filter.png?branch=master)](https://travis-ci.org/appdeck/filter)
[![Latest Stable Version](https://poser.pugx.org/appdeck/filter/v/stable.png)](https://packagist.org/packages/appdeck/filter)
[![Total Downloads](https://poser.pugx.org/appdeck/filter/downloads.png)](https://packagist.org/packages/appdeck/filter)

Installation
------------
This library can be found on [Packagist](https://packagist.org/packages/appdeck/filter).
The recommended way to install this is through [composer](http://getcomposer.org).

Edit your `composer.json` and add:

```json
{
    "require": {
        "appdeck/filter": "0.1.*"
    }
}
```

And install dependencies:

```bash
$ curl -sS https://getcomposer.org/installer | php
$ php composer.phar install
```

Features
--------
 - PSR-0 compliant for easy interoperability

Examples
--------
Examples of basic usage are located in the examples/ directory.

Bugs and feature requests
-------------------------
Have a bug or a feature request? [Please open a new issue](https://github.com/appdeck/filter/issues).
Before opening any issue, please search for existing issues and read the [Issue Guidelines](https://github.com/necolas/issue-guidelines), written by [Nicolas Gallagher](https://github.com/necolas/).

Versioning
----------
filter will be maintained under the Semantic Versioning guidelines as much as possible.

Releases will be numbered with the following format:

`<major>.<minor>.<patch>`

And constructed with the following guidelines:

* Breaking backward compatibility bumps the major (and resets the minor and patch)
* New additions without breaking backward compatibility bumps the minor (and resets the patch)
* Bug fixes and misc changes bumps the patch

For more information on SemVer, please visit [http://semver.org/](http://semver.org/).

Authors
-------
**Flávio Heleno**

+ [http://twitter.com/flavioheleno](http://twitter.com/flavioheleno)
+ [http://github.com/flavioheleno](http://github.com/flavioheleno)

**Vinícius Campitelli**

+ [http://twitter.com/vcampitelli](http://twitter.com/vcampitelli)
+ [http://github.com/vcampitelli](http://github.com/vcampitelli)

Copyright and license
---------------------

Copyright 2014 appdeck under [GPL-3.0](LICENSE).