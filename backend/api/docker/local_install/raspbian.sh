#!/bin/bash

curl -fsSL get.docker.com -o get-docker.sh && sh get-docker.sh
sudo groupadd docker
sudo gpasswd -a pi docker
sudo apt-get update
sudo apt-get install -y python python-pip
sudo pip install docker-compose
