FROM python:3.7.2-alpine3.8

ARG CLI_VERSION=1.16.81

RUN apk -uv add --no-cache groff jq less bash && \
    pip install --no-cache-dir awscli==$CLI_VERSION

WORKDIR /aws

CMD sh