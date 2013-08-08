Getting Started With ArtBreadcrumbs
==================================

## Instalation

1. Download ArtBreadcrumbs using composer
2. Enable the bundle
3. Configure the bundle in your config file

### Step 1: Dowload ArtBreadcrumbs using composer
Add ArtBreadcrumbs in your composer.json:

```js
{
    "require": {
        "art/breadcrumbs-bundle": "0.1.*@dev"
    }
}
```

Now tell the composer to download the bundle by running the command:

``` bash
$ php composer.phar update art/breadcrumbs-bundle
```

Composer will install the bundle to your project's 'vendor/art' directory.

### Step 2: Enable the bundle

Enable the bundle in the kernel:

``` php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new Art\BreadcrumbsBundle\ArtBreadcrumbsBundle()
    );
}
```

### Step 3: Configure the bundle in your config file

In config.yml:

Add the following in your config.yml file

``` yaml
# app/config/config.yml
art_breadcrumbs:
    tempate: "ArtBreadcrumbsBundle::art_breadcrumbs.html.twig"
    schema: "%kernel.root_dir%/config/breadcrumbs.yml"
    builder_service: art_breadcrumbs.yml_builder
    separator: "/"
```

Or if you prefer XML:

``` xml
<!-- app/config/config.xml -->

<!-- other valid 'db-driver' values are 'mongodb' and 'couchdb' -->
<art_breadcrumbs:config
    tempate="ArtBreadcrumbsBundle::art_breadcrumbs.html.twig"
    schema = "%kernel.root_dir%/config/breadcrumbs.yml"
    builder_service = art_breadcrumbs.yml_builder
    separator = "/"
/>
```

There is no required values and you can simply ignore this