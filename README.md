# ita-profiles-backend

## Introduction

ITA Profiles Backend is a project from IT Academy post-specialization course that allows students from our academy to
gain experience in a team that is using SCRUM methodology, and several tecnologies often used by most tech companies.
So, the main focus of Project is to help grow our students so they can learn to work in a team, question, think
solutions and face the usual

The backend of Profiles project gives solution to a frontend by providing an API Rest well documented with Swagger.

## How to install the project

We do use docker containers to share the same versions of PHP and MySQL around all the backend team. So, in first term
and after have cloned the project in your local, you'll need to install docker.

To install docker, [click here and follow the instructions](https://docs.docker.com/engine/install/).

Once docker is installed in your machine, you'll have to build the containers. Go to your project's root folder, and
type (remember the command as you'll have to type this every time you want to create the containers):

```shell
docker-compose up -d
```

You'll see a lot of things building up, and then you'll return to the same folder. So, when the building is done, you'll
be able to check that everything went well by typing the following:

```shell
docker ps
```

You'll see a table where you should see the container names: `itaprofilesbackend-app` and `itaprofilesbackend-mysql`.

Now you'll be able to run commands inside the container using linux shell commands, as follows:

```shell
docker exec -it itaprofilesbackend-app <the-command>

# EXAMPLES:
# To setup the libraries with composer:
docker exec -it itaprofilesbackend-app composer install

# To update libraries with composer: 
docker exec -it itaprofilesbackend-app composer update

# To run the tests with phpunit:
docker exec -it itaprofilesbackend-app ./vendor/bin/phpunit ./tests

# To use php artisan:
docker exec -it itaprofilesbackend-app php artisan ... <whatever...>

# For example, when installing you'll find useful to do:
docker exec -it itaprofilesbackend-app php artisan migrate:fresh
docker exec -it itaprofilesbackend-app php artisan db:seed
```

You'll have to run the previous composer install to get the project libraries and setup the project.
