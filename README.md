# SymfonyPhpSpecGeneratorBundle

This bundle is a basic generator for PhpSpec, based on the Doctrine defined in your Symfony project

## Installation

Begin by installing the package through Composer. Edit your project's `composer.json` file to require `aeyoll/aeyoll/symfony-php-spec-generator-bundle`.

  ```json
  "require": {
    "aeyoll/aeyoll/symfony-php-spec-generator-bundle": "dev-master"
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
