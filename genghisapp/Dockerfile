FROM ruby:2.2

RUN gem install --no-ri --no-rdoc \
      bson_ext:1.9.2 \
      genghisapp:2.3.11

CMD `which genghisapp` --foreground --no-launch --no-update-check --port=80 --servers db:27017