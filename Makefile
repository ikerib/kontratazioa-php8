#!/bin/bash

APP = kontratazioa_php_8
VERSION := $(shell cat ./VERSION)
DOCKER_REPO_NGINX = ikerib/${APP}_nginx:${VERSION}
DOCKER_REPO_APP = ikerib/${APP}_app:${VERSION}
USER_ID = $(shell id -u)
GROUP_ID= $(shell id -g)
user==www-data

help:
	@echo 'usage: make [target]'
	@echo
	@echo 'targets'
	@egrep '^(.+)\:\ ##\ (.+)' ${MAKEFILE_LIST} | column -t -c 2 -s ":#"

build: ## docker irudia sortu
	docker compose --env-file .env.local build

build-force:
	docker compose --env-file .env.local build --force-rm --no-cache

restart:
	$(MAKE) stop && $(MAKE) run

run:
	docker compose --env-file .env.local up -d

ssh:
	docker compose exec app zsh

stop:
	docker compose down
