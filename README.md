# WiP-administrative-app

default docker_www_image_name: wip-administrative-app_www_1

To set up application you need to run commands:

docker-compose up -d // Running docker containers

docker cp migrations/Version20231107195506.php {{docker_www_image_name}}:/var/www/migrations // Copy migration files to docker,

Then you need to run copied migration file:
docker exec -it {{docker_www_image_name}} php bin/console doctrine:migrations:migrate

That's it! Application should be running by now.
To access mails, just type localhost:1080 in your browser.

Access Symfony CMS app via url https://localhost:8080
