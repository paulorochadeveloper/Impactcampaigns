# Mage2 Module Rocha Impactcampaigns

    ``rocha/module-impactcampaigns``

 - [Main Functionalities](#markdown-header-main-functionalities)
 - [Installation](#markdown-header-installation)
 - [Configuration](#markdown-header-configuration)
 - [Specifications](#markdown-header-specifications)
 - [Attributes](#markdown-header-attributes)


## Main Functionalities

This module has been developed to streamline the creation of campaign pages within the Adobe Commerce Campaign Backoffice.

I have implemented a Magento 2 module with customized database tables to support this functionality.

The module incorporates campaign information, utilizing customized grids to display campaigns and their corresponding store views through Magento's UI components.

Additionally, the module dynamically generates routes for campaign pages and their associated products.

Products linked to a campaign will be appropriately labeled within the product list and across various store views.
Upon module installation, a menu is automatically generated in the back office, providing easy access to the module's administration listing route.


## Installation
\* = in production please use the `--keep-generated` option

### Type 1: Zip file

 - Unzip the zip file in `app/code/Rocha`
 - Enable the module by running `php bin/magento module:enable Rocha_Impactcampaigns`
 - Apply database updates by running `php bin/magento setup:upgrade`\*
 - Flush the cache by running `php bin/magento cache:flush`

### Type 2: Composer

 - Make the module available in a composer repository for example:
    - private repository `repo.magento.com`
    - public repository `packagist.org`
    - public github repository as vcs
 - Install the module composer by running `composer require rocha/module-impactcampaigns`
 - enable the module by running `php bin/magento module:enable Rocha_Impactcampaigns`
 - apply database updates by running `php bin/magento setup:upgrade`\*
 - Flush the cache by running `php bin/magento cache:flush`




