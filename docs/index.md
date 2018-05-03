title: Home
description: PlinkerRPC PHP client/server makes it really easy to link and execute generic PHP components on remote systems, while maintaining the feel of a local method call.

PlinkerRPC PHP client/server makes it really easy to link and execute generic PHP 
components on remote systems, while maintaining the feel of a local method call.

## Install

Each component is a composer package.

| Component    | Description | Version |
| ----------   | ------------- |  ------------- | 
| [core](/core/) | Required base component which contains the client and server. | [![Packagist Version](https://img.shields.io/packagist/v/plinker/core.svg?style=flat-square)](https://github.com/plinker-rpc/core/releases) |
| [asterisk](/asterisk/) | An Asterisk component which hooks into the Asterisk Management Interface on remote systems. | [![Packagist Version](https://img.shields.io/packagist/v/plinker/asterisk.svg?style=flat-square)](https://github.com/plinker-rpc/asterisk/releases)  |
| [base91](/base91/) | A core component, which base91 encodes the payload. | [![Packagist Version](https://img.shields.io/packagist/v/plinker/base91.svg?style=flat-square)](https://github.com/plinker-rpc/base91/releases) |
| [cron](/cron/) | A cron component which allows you to read and control cron tasks. | [![Packagist Version](https://img.shields.io/packagist/v/plinker/cron.svg?style=flat-square)](https://github.com/plinker-rpc/cron/releases) |
| [files](/files/) | Read and write files on remote systems. | [![Packagist Version](https://img.shields.io/packagist/v/plinker/files.svg?style=flat-square)](https://github.com/plinker-rpc/files/releases) |
| [iptables](/iptables/) | Control IPtables on remote systems, mainly for purpose of port forwarding. | [![Packagist Version](https://img.shields.io/packagist/v/plinker/iptables.svg?style=flat-square)](https://github.com/plinker-rpc/iptables/releases) |
| [lxc](/lxc/) | WIP: An older/deprecated component which controls LXC1.0 containers. | [![Packagist Version](https://img.shields.io/packagist/v/plinker/lxc.svg?style=flat-square)](https://github.com/plinker-rpc/lxc/releases) |
| [nginx](/nginx/) | Manage nginx as a reverse proxy. | [![Packagist Version](https://img.shields.io/packagist/v/plinker/nginx.svg?style=flat-square)](https://github.com/plinker-rpc/nginx/releases) |
| [redbean](/redbean/) | RedBeanPHP component which will enable you to directly manage databases on remote sites. | [![Packagist Version](https://img.shields.io/packagist/v/plinker/redbean.svg?style=flat-square)](https://github.com/plinker-rpc/redbean/releases) |
| [system](/system/) | A system component which gives you access to server information. | [![Packagist Version](https://img.shields.io/packagist/v/plinker/system.svg?style=flat-square)](https://github.com/plinker-rpc/system/releases) |
| [tasks](/tasks/) | The tasks component allows you to write code based tasks which are completed by a daemon, this could allow you to create a single interface to control a cluster of servers tasks. | [![Packagist Version](https://img.shields.io/packagist/v/plinker/tasks.svg?style=flat-square)](https://github.com/plinker-rpc/tasks/releases) |
| [test](/test/) | A test component which simply returns back what you sent, for testing/example purposes. | [![Packagist Version](https://img.shields.io/packagist/v/plinker/test.svg?style=flat-square)](https://github.com/plinker-rpc/test/releases) |

PlinkerRPC PHP client/server is also [available as a C extension](https://github.com/plinker-rpc/php-ext) which can be installed with Zephir.


Development repository
----------------------

If you would like to contribute then use the [development repository](https://github.com/plinker-rpc/development).

The repository is used to develop the entire project, to make it easy to work on many parts at the same time without forgetting what was done,
it also contains bash scripts which will commit and do semantic versioning for each sub component and build this documentation.

## Install

 - `git clone git@github.com:plinker-rpc/development.git .`
 - `composer install`

<!--
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
-->

**Committing changes:**

 - `#!js ./php-cs-fixer fix ./vendor/plinker --verbose --rules=@PSR2 --dry-run --diff`
 - `bash ./commit.sh "An informative commit message"`

## Development Encouragement

If you use this code and make money from it and want to show your appreciation,
please feel free to make a donation [https://www.paypal.me/lcherone](https://www.paypal.me/lcherone), thanks.

## Sponsors

Get your company or name listed here.
