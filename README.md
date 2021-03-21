# Proxy-Scheduler

Project aims to simplify web debugging via proxy, but would be also useful for some tricky network setup with multiple different proxies for different domains. 

## Installation

First you need to clone the repo and open it in the terminal. There is no preferred way to deploy, but we find docker to be the easy way. 

### Docker

```
chmod a+w configurate.csv
docker-compose up -d
```

or 

```
chmod a+w configurate.csv
docker run -d -v "./:/var/www/html" -p "8905:80" php:8-apache
```

### Development

For the small deployments and development purposes built-in PHP server should be enough:

```
php -S 0.0.0.0:8905
```
