Behavior Bundle
===============

*By [endroid](http://endroid.nl/)*

[![Latest Stable Version](http://img.shields.io/packagist/v/endroid/behavior-bundle.svg)](https://packagist.org/packages/endroid/behavior-bundle)
[![Build Status](http://img.shields.io/travis/endroid/EndroidBehaviorBundle.svg)](http://travis-ci.org/endroid/EndroidBehaviorBundle)
[![Latest Stable Version](https://poser.pugx.org/endroid/behavior-bundle/v/stable.png)](https://packagist.org/packages/endroid/behavior-bundle)
[![Total Downloads](http://img.shields.io/packagist/dt/endroid/behavior-bundle.svg)](https://packagist.org/packages/endroid/behavior-bundle)
[![License](http://img.shields.io/packagist/l/endroid/behavior-bundle.svg)](https://packagist.org/packages/endroid/behavior-bundle)

This bundle provides default behaviors you can apply to your classes via
interfaces and traits. Admin extensions, Doctrine filters and event listeners
are provided to enforce the behaviors.

[![knpbundles.com](http://knpbundles.com/endroid/EndroidBehaviorBundle/badge-short)](http://knpbundles.com/endroid/EndroidBehaviorBundle)

## Requirements

* Symfony
* Dependencies:
 * [`cocur/slugify`](https://github.com/cocur/slugify)

## Installation

Use [Composer](https://getcomposer.org/) to install the bundle.

``` bash
$ composer require endroid/behavior-bundle
```

Then enable the bundle via the kernel.

``` php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new Endroid\Bundle\BehaviorBundle\EndroidBehaviorBundle(),
    );
}
```

## Configuration

### Doctrine filters

By default only published content for the current language should be retrieved
from the database. The following configuration enforces this behavior.

```yaml
doctrine:
    orm:
        filters:
            publishable:
                class:   Endroid\Bundle\BehaviorBundle\Filter\PublishableFilter
                enabled: false
```

Of course these filters are optional and you can enable or disable them at any point.

### Admin extensions

Admin extensions for Sonata Admin add functionality to the backend and
enable you to publish, sort and traverse items. The following
configuration adds this functionality to all admin classes implementing
the described interfaces.

```yaml
sonata_admin:
    extensions:
        endroid_behavior.admin.extension.publishable:
            implements:
                - Endroid\Bundle\BehaviorBundle\Model\PublishableInterface
        endroid_behavior.admin.extension.sortable:
            implements:
                - Endroid\Bundle\BehaviorBundle\Model\SortableInterface
        endroid_behavior.admin.extension.traversable:
            implements:
                - Endroid\Bundle\BehaviorBundle\Model\TraversableInterface
```

## Versioning

Version numbers follow the MAJOR.MINOR.PATCH scheme. Backwards compatible
changes will be kept to a minimum but be aware that these can occur. Lock
your dependencies for production and test your code when upgrading.

## License

This bundle is under the MIT license. For the full copyright and license
information please view the LICENSE file that was distributed with this source code.
