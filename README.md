# Proxy-Scheduler

Project aims to simplify web debugging via proxy, but would be also useful for some tricky network setup with multiple different proxies for different domains. 

## Installation

First you need to clone the repo and open it in the terminal. There is no preferred way to deploy, but we find docker to be the easy way. 

### Docker

```
docker-compose up -d
```

### Development

For the small deployments and development purposes built-in PHP server should be enough:

```
composer install
php -S 0.0.0.0:8905
```
