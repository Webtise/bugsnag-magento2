# Webtise Bugsnag (M2)

Bugsnag notifier for Magento 2

# Requirements

- Magento Composer Installer: To copy the module contents under app/code/ folder.
In order to install it run the below command on the root directory:

        composer require magento/magento-composer-installer

# Installation

- Add the module to composer:

        composer require webtise/bugsnag

- Enable the module:

        bin/magento module:enable Webtise_BugSnag

- Deploy static content and compile DI:

        bin/magento setup:static:content:deploy
        bin/magento setup:di:compile

- Clear cache

# Usage

Once installed, you will need to add your API Key into your install's ***app/etc/env.php*** file in array format like below:

        'bugsnag' => array(
            'api_key' => 'YOUR_API_KEY_HERE'
        ),

# Support

If you have any issues with this extension, open an issue on [GitHub](https://github.com/Webtise/bugsnag-magento2/issues).

# Contribution

Any contribution is highly appreciated. The best way to contribute code is to open a [pull request on GitHub](https://help.github.com/articles/using-pull-requests).

# License

[OSL - Open Software Licence 3.0](http://opensource.org/licenses/osl-3.0.php)

# Copyright

&copy; 2017 Webtise Ltd
