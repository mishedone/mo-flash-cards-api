#!/usr/bin/env bash

# add repositories
add-apt-repository ppa:ondrej/php
curl -s https://packagecloud.io/install/repositories/phalcon/stable/script.deb.sh | bash
apt-get update

# setup php
apt-get install -y python-software-properties
apt-get install -y php7.0 php7.0-fpm php7.0-cli php7.0-phalcon

# setup composer
apt-get install -y git unzip
curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# clean up
apt-get --purge -y autoremove

# setup swap before composer install
# https://www.digitalocean.com/community/tutorials/how-to-add-swap-on-ubuntu-14-04
if ! [ -f /swapfile ]; then
    fallocate -l 2G /swapfile
    chmod 600 /swapfile
    mkswap /swapfile
    swapon /swapfile
    echo "/swapfile   none    swap    sw    0   0" >> /etc/fstab
fi
