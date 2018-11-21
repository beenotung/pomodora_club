#!/bin/bash
set -e
set -o pipefail

## start mysql server
sudo systemctl start mysqld

## start php web server
cd web
php -S 127.0.0.1:8082
