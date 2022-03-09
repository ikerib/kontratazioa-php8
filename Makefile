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



build:
	docker-compose --env-file .env.local build --force-rm --no-cache

restart:
	$(MAKE) stop && $(MAKE) run

run:
	USER_ID=${USER_ID} docker-compose up -d

ssh:
	docker-compose exec app zsh

stop:
	USER_ID=${USER_ID} docker-compose down
