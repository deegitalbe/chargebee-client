#!/bin/bash

set -e

command -v doppler >/dev/null 2>&1 || { echo "Error: Doppler is not installed. Please install Doppler and authenticate with 'doppler login'."; exit 1; }
doppler me >/dev/null 2>&1 || { echo "Error: Doppler is not authenticated. Run 'doppler login' first."; exit 1; }

secret() {
    doppler secrets download \
        --project "$1" \
        --config local \
        --no-file \
        --format env | grep -Ev 'DOPPLER' \
    >> .env
}

append() {
    echo $1=\"$2\" >> .env
}

true > .env && \
# secret "chargebee-client" && \
append UID $(id -u) && \
append GID $(id -g)
