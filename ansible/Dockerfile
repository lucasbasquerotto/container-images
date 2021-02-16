FROM ubuntu:18.04

RUN apt update \
 && apt install -y software-properties-common \
 && apt-add-repository ppa:ansible/ansible -y \
 && apt update \
 && apt install -y python-pip python3-pip \
 && pip3 install ansible \
 && rm -rf /var/lib/apt/lists/*
