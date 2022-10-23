#!/bin/bash

DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" >/dev/null 2>&1 && pwd )"
PRIVATE="$DIR/private.key"
PUBLIC="$DIR/public.key"

if [ -f  "$PRIVATE" ]; then
    rm -v "$PRIVATE"
fi
touch "$PRIVATE"

if [ -f  "$PUBLIC" ]; then
    rm -v "$PUBLIC"
fi
touch "$PUBLIC"

openssl genrsa -out "$PRIVATE" 2048
openssl rsa -in "$PRIVATE" -pubout -out "$PUBLIC"

#this is a security risk
#chmod +r "$PRIVATE"