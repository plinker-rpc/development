title: Home
description: PlinkerRPC PHP client/server allows you to securely execute generic PHP code and components on remote sites, while maintaining the feel of a local method call.

PlinkerRPC PHP client/server allows you to securely execute generic PHP 
code and components on remote sites, while maintaining the feel of a local method call.

### Components

Each component is a composer package, you can find them [on packagist](https://packagist.org/packages/plinker/).

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

!!! tip "Did you know?"
    PlinkerRPC PHP client/server is also [available as a C extension](https://github.com/plinker-rpc/php-ext) which can be installed with Zephir.

---

### Development Repository

The development repository is used to develop the entire project to make it easy to work on many parts at the same time without forgetting what was done,
it contains a bash script which will commit and do semantic versioning for each sub component.

#### Installing

 - `git clone git@github.com:plinker-rpc/development.git .`
 - `composer install`

#### Committing Changes

Bash scripts have been added to automate this, do not do it manually.

 - `bash ./commit.sh "A really informative commit message."`

The above 1 liner will ask:

`Do you wish to [c]ommit, [d]eploy or [e]xit?`

 - If you choose commit, it will push your changes and docs to github.
 - If you choose deploy, it will ask: `Which type of changes has been done: [p]atch, [m]inor, [M]ajor?`, upon choice it will increment the semantic version, tag then push your changes and docs to github.

`bash ./dev_mkdocs.sh` is used to write docs with hot reloading at `http://127.0.0.0:8000`

#### New Components

To create a new component simply edit the `component-generator.php` file then run it.

It will generate the following structure in vendor, ready to start 
creating your component package.

    component ┐
              ├── src
              │   ├── Component.php
              ├── tests
              │   ├── fixtures
              │   ├── ComponentTest.php
              │   └── bootstrap.php
              ├── .gitignore
              ├── .scrutinizer.yml
              ├── .styleci.yml
              ├── .travis.yml
              ├── CONTRIBUTING.md
              ├── LICENSE
              ├── phpunit.xml
              ├── README.md
              └── composer.json

**When ready:**

 - Make sure `README.md` conforms to docs structure.
 - Create a github repository in the organisation, push your changes.
 - Add the new component to `commit.sh`, `dev_mkdocs.sh` and `mkdocs.sh` component arrays.
 - Run `bash ./commit.sh "Inital Commit"`
 - Add to packagist.
 - Enable on [StyleCI](https://styleci.io), [TravisCI](https://travis-ci.org), [ScrutinizerCI](https://scrutinizer-ci.com).

## Request a Component

If you've got an idea for a component and would like to see it added, feel free to [open an issue](https://github.com/plinker-rpc/development/issues/new).

## Development Encouragement

If you use this project and make money from it or want to show your appreciation,
please feel free to make a donation [https://www.paypal.me/lcherone](https://www.paypal.me/lcherone), thanks.

## Sponsors

Get your company or name listed throughout the documentation and on each github repository, contact me at [https://cherone.co.uk](https://cherone.co.uk) for further details.

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
