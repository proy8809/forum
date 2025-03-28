#!/bin/bash

NETWORK=forum

if ! docker network inspect "${NETWORK}" >/dev/null 2>&1; then
    docker network create --driver bridge ${NETWORK}
fi

docker compose -p forum-application up -d --force-recreate --build
