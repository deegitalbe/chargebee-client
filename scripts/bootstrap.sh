#!/bin/bash

set -e

command -v docker >/dev/null 2>&1 || { echo "Error: Docker is not installed. Please install Docker first."; exit 1; }
command -v doppler >/dev/null 2>&1 || { echo "Error: Doppler is not installed. Please install Doppler and authenticate with 'doppler login'."; exit 1; }
doppler me >/dev/null 2>&1 || { echo "Error: Doppler is not authenticated. Run 'doppler login' first."; exit 1; }

./scripts/set_env.sh

docker compose build

docker compose run --rm --no-deps --entrypoint="" chargebee-client-app composer install

./scripts/start.sh
