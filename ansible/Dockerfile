FROM ubuntu:18.04

RUN apt update \
 && apt install -y software-properties-common \
 && apt-add-repository ppa:ansible/ansible -y \
 && apt update \
 && apt install -y python-pip python3-pip \
 && pip3 install ansible \
 # end
#  && apt install -y ansible git python-pip python3-pip \
 # end
#  && yes | pip install docker-py 'dopy>=0.3.5,<=0.3.5' \
#  && yes | pip3 install boto boto3 botocore