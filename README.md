# SymfonyPhpSpecGeneratorBundle

[![Build Status](https://travis-ci.org/aeyoll/SymfonyPhpSpecGeneratorBundle.svg?branch=master)](https://travis-ci.org/aeyoll/SymfonyPhpSpecGeneratorBundle)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/aeyoll/SymfonyPhpSpecGeneratorBundle/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/aeyoll/SymfonyPhpSpecGeneratorBundle/?branch=master)
[![Test Coverage](https://codeclimate.com/github/aeyoll/SymfonyPhpSpecGeneratorBundle/badges/coverage.svg)](https://codeclimate.com/github/aeyoll/SymfonyPhpSpecGeneratorBundle/coverage)

This bundle is a basic generator for PhpSpec, based on the Doctrine defined in your Symfony project

## Installation

Begin by installing the package through Composer. Edit your project's `composer.json` file to require `aeyoll/symfony-php-spec-generator-bundle`.

  ```json
  "require": {
    "aeyoll/symfony-php-spec-generator-bundle": "dev-master"
  }
  ```
Next, use Composer to update your project from the the Terminal:

  ```
  php composer.phar update
  ```

You can also use the require command from Composer:

    ```
    composer require aeyoll/symfony-php-spec-generator-bundle
    ```

Once the package has been installed, you'll need to add the bundle to your kernel. Open your `app/AppKernel.php` configuration file, and add ```new Aeyoll\SymfonyPhpSpecGeneratorBundle\AeyollSymfonyPhpSpecGeneratorBundle(),``` to the bundle list.

## Usage

...
