#!/bin/sh
echo Start cleaning at `date -u`
php7.0 /var/www/html/API-reader/core/cronjob/delete-old.php
echo
echo
echo FINISHED at `date -u`
echo
echo