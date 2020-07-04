#!/bin/bash

if [ "$1" == "download" ]; then
  unlink phpDocumentor.phar
fi

if [ ! -f phpDocumentor.phar ]; then
  echo "========================================================================="
  echo "   Downloading phpDocumentor..."
  echo "========================================================================="
  wget https://www.phpdoc.org/phpDocumentor.phar --no-verbose
fi

rm -rf docs/api

echo "========================================================================="
echo "   Creating api docs..."
echo "========================================================================="

php -d error_reporting=0 phpDocumentor.phar

rm -rf docs/tmp

echo "========================================================================="
echo "   Done."
echo "========================================================================="
