SHELL='/bin/bash'

run:
	@docker run \
			--rm \
			--tty \
			--interactive \
			--volume "$(PWD)/../project":/usr/src/myapp \
			--user $(shell id -u):$(shell id -g) \
			--workdir /usr/src/myapp \
			php:7.2-cli php public/index.php

unit-test:
	docker run \
			--rm \
			--tty \
			--interactive \
			--volume "$(PWD)/../project":/usr/src/myapp \
			--user $(shell id -u):$(shell id -g) \
			--workdir /usr/src/myapp \
			php:7.2-cli php vendor/bin/phpunit tests

composer-install:
	docker run \
			--rm \
			--tty \
			--interactive \
			--volume "$(PWD)/../project":/usr/src/myapp \
			--user $(shell id -u):$(shell id -g) \
			composer install --no-dev

composer-install-dev:
	docker run \
			--rm \
			--tty \
			--interactive \
			--volume "$(PWD)/../project":/usr/src/myapp \
			--user $(shell id -u):$(shell id -g) \
			--workdir /usr/src/myapp \
			composer install --no-dev

composer-require:
	docker run \
			--rm \
			--tty \
			--interactive \
			--volume "$(PWD)/../project":/app \
			--user $(shell id -u):$(shell id -g) \
			composer require

composer-require-dev:
	docker run \
			--rm \
			--tty \
			--interactive \
			--volume "$(PWD)/../project":/app \
			--user $(shell id -u):$(shell id -g) \
			composer require --dev
