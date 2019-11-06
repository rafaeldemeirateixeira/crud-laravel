## Sobre o projeto

Este projeto Laravel 6.x. Foi desenvolvido e testado utilizando Docker para provisionar o ambiente de desenvolvimento. Todo os JS e CSS foram implementados pelo pacote `laravel/ui` e compilados com `npm`:

- [Documentação do Laravel 6.x](https://laravel.com/docs/6.x).
- [Guia de uso do pacote laravel/ui](https://laravel.com/docs/6.x/frontend).
- [Documentação do Docker](https://docs.docker.com/compose/reference/up/).

## Instalação inicial
### 1. Usando Docker
Caso não utilize Docker, faça o `git clone` no ambiente desejado e ignore os comandos `docker-compose`.
```
~$ git clone <projeto git>
~$ docker-compose up -d
~$ docker-compose exec mindtec bash

//Docker bash ou qualquer que seja o ambiente que esteja rodando.
~$bash composer update
~$bash cp .env.example .env
//Altere o arquivo .env
~$bash vim .env

    DB_HOST=mindtec-mysql
    DB_DATABASE=mindtec
    DB_USERNAME=root
    DB_PASSWORD=root
    
~$bash php artisan migrate
~$bash php artisan ui bootstrap
~$bash npm install
~$bash npm run dev

```
