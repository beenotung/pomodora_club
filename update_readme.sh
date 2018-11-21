#!/bin/bash
set -e
set -o pipefail
asciidoctor README.adoc
mv README.html web/
