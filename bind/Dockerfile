FROM alpine:3.11.6

RUN apk --update add --no-cache bind

CMD ["named", "-c", "/etc/bind/named.conf", "-g", "-u", "named"]