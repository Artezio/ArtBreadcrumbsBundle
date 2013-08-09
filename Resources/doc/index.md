Getting Started With ArtBreadcrumbs
==================================

## Instalation

1. Download ArtBreadcrumbs using composer
2. Enable the bundle
3. Configure the bundle in your config file
4. Write your schema for breadcrumbs tree
5. Call twig function in your template

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
    dev_mode: false
```

Or if you prefer XML:

``` xml
<!-- app/config/config.xml -->

<!-- other valid 'db-driver' values are 'mongodb' and 'couchdb' -->
<art_breadcrumbs:config
    tempate = "ArtBreadcrumbsBundle::art_breadcrumbs.html.twig"
    schema = "%kernel.root_dir%/config/breadcrumbs.yml"
    builder_service = art_breadcrumbs.yml_builder
    separator = "/"
    dev_mode = "false"
/>
```
If dev_mode argument is set then whenever you call twig function and it doesnt' find suitable breadcrumbs structure - it will
show a message about that. This works only in dev environment.

There is no required values and you can simply ignore this

### Step 4: Write your schema for breadcrumbs tree

By default the bundle is looking for breadcrumbs.yml file in your app/config directory. But you can specify different
location of your schema file using the schema parameter in config.yml:

``` yaml
# app/config/config.yml
art_breadcrumbs:
    schema: "%kernel.root_dir%/../src/<Vendor>/<BundleName>/config/breadcrumbs.yml"
```

The schema should looks like this:

``` yaml
# breadcrumbs.yml
label: "breadcrumbs.home"
route: "front"
children:
    User list:
        label: "breadcrumbs.admin_user_list"
        route: "admin_user_list"
        children:
            Edit user:
                label: "breadcrumbs.admin_user_edit"
                route: "admin_user_edit"
            Create user:
                label: "breadcrumbs.admin_user_create"
                route: "admin_user_create"
    Organization list:
        label: "breadcrumbs.admin_organization_list"
        route: "admin_organization_list"
        children:
            Edit organization:
                label: "breadcrumbs.admin_organization_edit"
                route: "admin_organization_edit"
            Create organization:
                label: "breadcrumbs.admin_organization_create"
                route: "admin_organization_create"
    Organization list:
            label: "breadcrumbs.admin_organization_list"
            route: "admin_organization_list"
            children:
                Organization address list:
                    label: "breadcrumbs.admin_organization_address_list"
                    route: "admin_organization_address_list"
                    children:
                        Create organization address:
                            label: "breadcrumbs.admin_organization_address_create"
                            route: "admin_organization_address_create"
                        Edit organization address:
                            label: "breadcrumbs.admin_organization_address_edit"
                            route: "admin_organization_address_edit"
```

The names of nodes doesn't matter.

### Step 5: Call twig function in your template

To show your breadcrumbs on page simply add next in the template of you page:

``` html+jinja
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
    </head>
    <body>
    <!-- your code ... -->

    {{ build_breadcrumbs()|raw }}

    <!-- your code ... -->
    </body>
</html>
```