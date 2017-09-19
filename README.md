**Plinker-RPC**
=========

Plinker PHP RPC client/server makes it really easy to link and execute PHP component classes on remote systems, while maintaining the feel of a local method call.

Development repository
----------------------

This repository is used to develop the entire project to make it easy to work on many parts at the same time without forgetting what was done,
it contains a bash script which will commit and do semantic versioning for each sub component.

**Installing:**

 - `git clone git@github.com:plinker-rpc/development.git .`
 - `composer install`

**Committing changes:**

 - `./php-cs-fixer fix ./vendor/plinker --verbose --rules=@PSR2 --dry-run --diff`
 - `bash ./commit.sh "A really informative commit message, and not just ."`


