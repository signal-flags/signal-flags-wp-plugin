#!/bin/bash

VERSION="$1"

KEBAB="signal-flags"
PASCAL="SignalFlags"

echo
echo "Updating version to ${VERSION}"

echo
echo "In ${KEBAB}.php"
sed -i -E "s/(Version:\s*)[0-9].*$/\1${VERSION}/" ${KEBAB}.php
grep -n "Version:" ${KEBAB}.php

echo
echo "In ${KEBAB}/${KEBAB}.php"
sed -i -E "s/(Version:\s*)[0-9].*$/\1${VERSION}/" ${KEBAB}/${KEBAB}.php
grep -n "Version:" ${KEBAB}/${KEBAB}.php

echo
echo "In ${KEBAB}/src/${PASCAL}.php"
sed -i -E "s/(version = ')[0-9].*(')/\1${VERSION}\2/" ${KEBAB}/src/${PASCAL}.php
grep -n "version = '" ${KEBAB}/src/${PASCAL}.php

echo
echo "In phpdoc.xml"
sed -i -E "s/(v)[0-9].*(<\/title>)/\1${VERSION}\2/" phpdoc.xml
grep -n "<title>" phpdoc.xml
