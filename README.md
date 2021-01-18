# POKEDEX-V1
## Requisitos
Esta guía asume que estás usando Ubuntu o una distribución similar.
Para poder trabajar con esto necesitamos tener los siguientes items preinstalado:

- Docker -> ("https://docs.docker.com/engine/install/ubuntu/")
- Docker-Compose -> ("https://docs.docker.com/compose/install/")

-------------
## Pasos a seguir
- Clona este repositorio `git clone https://github.com/JLeninPerez/pokedex.git`
- Correr el comando `sudo docker-compose up -d`
- Correr `sudo docker-compose exec app composer install && sudo docker-compose exec app php -r "file_exists('.env') || copy('.env.example', '.env');" && sudo docker-compose exec app php artisan key:generate --ansi && sudo docker-compose up -d`
- El proyecto esta expuesto en el puerto `http://localhost:8030/pokedex`
-------------
## Tests
- Para correr los tests `vendor/bin/phpunit`
