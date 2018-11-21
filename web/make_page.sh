#!/bin/bash
set -e
set -o pipefail

name="$1"
if [ "$name" == "" ]; then
  read -p "page file name: " name
fi

cp -v empty.html "$name.html"
cp -v empty.php "$name.php"
