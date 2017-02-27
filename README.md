#Webtise Bugsnag (M2)

Bugsnag notifier for Magento 2

# Requirements

- Magento Composer Installer: To copy the module contents under app/code/ folder.
In order to install it run the below command on the root directory:

        composer require magento/magento-composer-installer

# Installation

- Add the module to composer:

        composer require webtise/bugsnag

- Deploy static content and compile DI:

        bin/magento setup:static:content:deploy
        bin/magento setup:di:compile

- Clear cache

#Usage

Once installed, login to the admin and navigate to **Stores > Configuration > Advanced > BugSnag**. Enable the extension and enter your BugSnag Project's API Key which can be found in your Bugsnag dashboard. Carry on through the configuration and set your Release Stage and the level of which you want Monolog erros to be sent to Bugsnag. Which ever level you select, errors of this level and above will be sent.

For more information on Monolog's erorr levels, [See their log level docs](https://github.com/Seldaek/monolog/blob/master/doc/01-usage.md#log-levels).

#Support

If you have any issues with this extension, open an issue on [GitHub](https://github.com/Webtise/bugsnag-magento2/issues).

#Contribution

Any contribution is highly appreciated. The best way to contribute code is to open a [pull request on GitHub](https://help.github.com/articles/using-pull-requests).

#License

[OSL - Open Software Licence 3.0](http://opensource.org/licenses/osl-3.0.php)

#Copyright

&copy; 2017 Webtise Ltd
