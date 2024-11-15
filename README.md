# GB Null Driver

![License](https://img.shields.io/badge/license-MIT-blue.svg) ![Current Version](https://img.shields.io/packagist/v/glowingblue/null-driver) ![Downloads](https://img.shields.io/packagist/dt/glowingblue/null-driver)


[![open-graph-image](https://flarum.org/extension/glowingblue/null-driver/card.png)](https://flarum.org/extension/glowingblue/null-driver)


## About

This extension exposes the `NullDriver` of Flarum to be used as an email driver in the email settings in the Admin Panel. This is particularly useful for migrations to Flarum or when running some kind of recalculation logic, which would normally flood either the inbox of forum users or the Flarum logs.

## Warning
This extension is only meant to be installed and enabled while developing a Community or on non production instances. E-Mails that would've been sent while the null driver is enabled can't be restored.


## Installation

Install with composer:

```sh
composer require glowingblue/null-driver:"*"
```

## Updating

```sh
composer update glowingblue/null-driver:"*"
php flarum cache:clear
```

## Links

- [Packagist](https://packagist.org/packages/glowingblue/null-driver)
- [GitHub](https://github.com/glowingblue/flarum-ext-null-driver)
- [Discuss](https://discuss.flarum.org/d/36338-gb-null-driver)
