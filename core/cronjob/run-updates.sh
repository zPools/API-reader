#!/bin/sh
echo Start coin-name-updates at `date -u`
php7.0 /var/www/html/API-reader/core/crex/crex-complete.php
php7.0 /var/www/html/API-reader/core/poloniex/polo-complete.php
php7.0 /var/www/html/API-reader/core/southxchange/southxchange-complete.php
php7.0 /var/www/html/API-reader/core/kucoin/kucoin-complete.php
php7.0 /var/www/html/API-reader/core/novaexchange/novaexchange-complete.php
php7.0 /var/www/html/API-reader/core/stex/stex-complete.php
php7.0 /var/www/html/API-reader/core/cryptopia/cryptopia-complete.php

echo
echo
echo FINISHED at `date -u`
echo
echo
