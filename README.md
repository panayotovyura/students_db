<a href="https://travis-ci.org/panayotovyura/students_db"><img src="https://travis-ci.org/panayotovyura/students_db.svg?branch=master"></a>

students_db
===========

A Symfony3 forth test project for Levi9 training

Run project:

1. composer install

2. php bin/console doctrine:database:create

3. php bin/console doctrine:schema:create

4. php bin/console hautelook_alice:doctrine:fixtures:load

5. php bin/console assets:install

6. php bin/console server:run

PhpUnit:

1. php bin/console doctrine:database:create --env=test

2. php bin/console doctrine:schema:create --env=test

3. php bin/console hautelook_alice:doctrine:fixtures:load --env=test

4. ./vendor/bin/phpunit

Analysis Tools:

1. PHP_CodeSniffer: ./vendor/bin/phpcs --standard=psr2 src

2. PHP Mess Detector: ./vendor/bin/phpmd src text cleancode,codesize,controversial,design,unusedcode

3. PHP Copy/Paste Detector: ./vendor/bin/phpcpd src
