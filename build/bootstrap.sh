#!/usr/bin/env bash

# fix locales (mongo cli access is broken otherwise)
export LANGUAGE="en_US.UTF-8"
echo 'LANGUAGE="en_US.UTF-8"' >> /etc/default/locale
echo 'LC_ALL="en_US.UTF-8"' >> /etc/default/locale

# add repositories
add-apt-repository ppa:ondrej/php
curl -s https://packagecloud.io/install/repositories/phalcon/stable/script.deb.sh | bash
apt-key adv --keyserver hkp://keyserver.ubuntu.com:80 --recv 7F0CEB10
echo "deb http://repo.mongodb.org/apt/ubuntu "$(lsb_release -sc)"/mongodb-org/3.0 multiverse" | tee /etc/apt/sources.list.d/mongodb-org-3.0.list
apt-get update

# setup mongo
apt-get install -y mongodb-org

# setup php
apt-get install -y python-software-properties
apt-get install -y php7.1 php7.1-fpm php7.1-cli php7.1-phalcon php7.1-mongo php7.1-mbstring

# setup composer
apt-get install -y git unzip
curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# clean up
apt-get --purge -y autoremove

# install configurations
if [ ! -f /vagrant/config/config.ini ]; then
    cp /vagrant/config/config.dist.ini /vagrant/config/config.ini
fi

# setup swap
# https://www.digitalocean.com/community/tutorials/how-to-add-swap-on-ubuntu-14-04
if ! [ -f /swapfile ]; then
    fallocate -l 2G /swapfile
    chmod 600 /swapfile
    mkswap /swapfile
    swapon /swapfile
    echo "/swapfile   none    swap    sw    0   0" >> /etc/fstab
fi