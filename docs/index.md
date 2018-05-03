title: Home
description: PlinkerRPC PHP client/server makes it really easy to link and execute generic PHP components on remote systems, while maintaining the feel of a local method call.

PlinkerRPC PHP client/server makes it really easy to link and execute generic PHP 
components on remote systems, while maintaining the feel of a local method call.

## Install

Each component is in a composer package.

| Component    | Description | Version |
| ----------   | ------------- |  ------------- | 
| [core](/core/)         | Required base component which contains the client and server. | [![Packagist Version](https://img.shields.io/packagist/v/plinker/core.svg?style=flat-square)](https://github.com/plinker-rpc/core/releases) |

<em>*Some components require further steps.</em>

Development repository
----------------------

If you would like to contribute then use the [development repository](https://github.com/plinker-rpc/development).

The repository is used to develop the entire project, to make it easy to work on many parts at the same time without forgetting what was done,
it also contains bash scripts which will commit and do semantic versioning for each sub component and build this documentation.

## Install

 - `git clone git@github.com:plinker-rpc/development.git .`
 - `composer install`

* [x] Lorem ipsum dolor sit amet, consectetur adipiscing elit
* [x] Nulla lobortis egestas semper
* [x] Curabitur elit nibh, euismod et ullamcorper at, iaculis feugiat est
* [ ] Vestibulum convallis sit amet nisi a tincidunt
    * [x] In hac habitasse platea dictumst
    * [x] In scelerisque nibh non dolor mollis congue sed et metus
    * [x] Sed egestas felis quis elit dapibus, ac aliquet turpis mattis
    * [ ] Praesent sed risus massa
* [ ] Aenean pretium efficitur erat, donec pharetra, ligula non scelerisque
* [ ] Nulla vel eros venenatis, imperdiet enim id, faucibus nisi

**Committing changes:**

 - `#!js ./php-cs-fixer fix ./vendor/plinker --verbose --rules=@PSR2 --dry-run --diff`
 - `bash ./commit.sh "An informative commit message"`

## Development Encouragement

If you use this code and make money from it and want to show your appreciation,
please feel free to make a donation [https://www.paypal.me/lcherone](https://www.paypal.me/lcherone), thanks.

## Sponsors

Get your company or name listed here.
