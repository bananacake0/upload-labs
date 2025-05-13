# Use an older Ubuntu version as base
FROM ubuntu:14.04

# Set maintainer label (replacing deprecated MAINTAINER)
LABEL maintainer="c0ny1 <root@gv7.me>"

# Set environment variables
ENV LC_ALL=C.UTF-8 \
    TZ=Asia/Shanghai

# Update and install necessary packages
RUN apt-get update && \
    apt-get install -y software-properties-common && \
    apt-get update && \
    apt-get install -y \
    apache2 \
    curl \
    libcurl3 \
    libcurl3-dev \
    php5 \
    php5-cli \
    libapache2-mod-php5 \
    php5-gd \
    php5-json \
    php5-ldap \
    php5-mysql \
    php5-pgsql \
    php5-curl \
    git && \
    rm -rf /var/lib/apt/lists/*

# Copy custom configuration files
COPY . /tmp/
RUN mkdir -p /etc/php5/apache2/conf.d/ && \
    cp /tmp/docker-php.conf /etc/apache2/conf-available/docker-php.conf && \
    cp /tmp/php.ini /etc/php5/apache2/php.ini && \
    cp /tmp/php.ini /etc/php5/apache2/conf.d/custom.ini && \
    a2enconf docker-php

# Enable Apache rewrite module
RUN a2enmod rewrite

# Install upload-labs
RUN cd /tmp/ && \
    git clone https://github.com/bananacake0/upload-labs.git && \
    rm -rf /var/www/html/* && \
    mv /tmp/upload-labs/* /var/www/html/ && \
    chown www-data:www-data -R /var/www/html/ && \
    rm -rf /tmp/*

# Expose port 80
EXPOSE 80

# Start Apache in the foreground
CMD ["apache2ctl", "-D", "FOREGROUND"]
