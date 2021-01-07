# MUSICALYZ

## Description
With Musicalyz, centralize all your playlists and import them easily from one music platform to another.


## Getting Started

### Prerequisites

What things you need to install the software and how to install them?

- [Docker CE](https://www.docker.com/community-edition)
- [Docker Compose](https://docs.docker.com/compose/install)

### Install

- (optional) Create your `docker-compose.override.yml` file

```bash
cp docker-compose.override.yml.dist docker-compose.override.yml
```
> Notice : Check the file content. If other containers use the same ports, change yours.

#### Init

```bash
cp .env.dist .env
docker-compose up -d
docker-compose exec web composer install
docker-compose exec web php bin/console d:s:u --force
docker-compose exec web php bin/console d:f:l
docker-compose exec web npm install
docker-compose exec npm run dev
```
#### Configure JWT
Open a bash from your docker-compose:
```bash
docker-compose exec web bash
```
And then, execute these commands:
```bash
mkdir -p config/jwt
openssl genpkey -out config/jwt/private.pem -aes256 -algorithm rsa -pkeyopt rsa_keygen_bits:4096
openssl pkey -in config/jwt/private.pem -out config/jwt/public.pem -pubout
```

#### Init node server for SpotifyAPI authentication:
```bash
cd auth-server/
npm install
npm run dev
```

### Functionalities

 - Get Spotify and Deezer top officials playlists
 - Get User Playsts from Spotify and Deezer
 - Import playlists from a streaming platform to an other
 
Notice: All these features are not yet fully implemented for the moment, you are welcome to join the ALYZ team to develop them :)

