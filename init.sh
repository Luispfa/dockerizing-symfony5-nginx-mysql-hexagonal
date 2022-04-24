#!/usr/bin/env bash

# docker stop $(docker ps -a -q)
# docker rm $(docker ps -a -q)
# docker volume rm $(docker volume ls -q)
# docker rmi -f $(docker images -a -q)
#### SIMPLIFIED METHOD #####
docker system prune --force
#### SIMPLIFIED METHOD #####

#### FLAG WHEN RUNNING THE COMMAND TO PRUNE VOLUMES AS WELL #####
# docker system prune -a --volumes
#### FLAG WHEN RUNNING THE COMMAND TO PRUNE VOLUMES AS WELL #####

rm -rf build/data
docker-compose up -d