# Gilded Rose Refactoring Challenge

The goal of this challenge is to improve the design of the GuildedRose.php file and then to add the additional functionality described in the requirements.txt file.

## How to begin

The simplest way is to just clone the code and start hacking away improving the design. The requirements.txt explains what the code is for. 

I strongly advise you that you'll also need some tests if you want to make sure you don't break the code while you refactor.

You could write some unit tests yourself, using the requirements to identify suitable test cases. I've provided a failing unit test in phpunit as a starting point.

The idea of the exercise is to do some deliberate practice, and improve your skills at designing test cases and refactoring. The idea is not to re-write the code from scratch, but rather to practice designing tests, taking small steps, running the tests often, and incrementally improving the design.

# Requirements

**PHP 7:**

This is usually bundled with your operating system, or fetchable using a package manager like `apt` or `homebrew`.

If you want to compile from source code, that can be found here: https://www.php.net/downloads.php

**Composer:**

Composer is PHP's main package and dependency management tool.

It can be downloaded here: https://getcomposer.org/download/

# Running the test

Install the dependencies and run `phpunit`:

```
composer install
vendor/bin/phpunit
```

If the "install" command does not work, try running `composer update` instead.
This will tell composer that it has permission to look for a newer version of
its dependencies.

If things are still not cooperating, you can try this extreme approach:

```
composer remove phpunit/phpunit
composer require phpunit/phpunit
```
