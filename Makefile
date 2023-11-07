refresh-docker:
	docker stop wip-administrative-app_mailer_1 
	docker stop wip-administrative-app_www_1
	docker stop wip-administrative-app_database_1 
	docker container prune -f
	docker-compose build www
	docker-compose up -d
