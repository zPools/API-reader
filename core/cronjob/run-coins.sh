#!/bin/sh
echo Start updates at `date -u`
php7.0 /var/www/html/API-reader/core/cronjob/update-coins.php
echo
echo
echo FINISHED at `date -u`
echo
echo