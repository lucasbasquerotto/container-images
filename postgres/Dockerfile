FROM postgres:13.3-alpine

# Install some packages to use WAL
RUN echo "azure<5.0.0" > pip-constraints.txt
RUN apk add --no-cache \
      build-base \
      curl \
      libc6-compat \
      libffi-dev \
      linux-headers \
      python3-dev \
      py-pip \
      py-cryptography \
      pv \
      libressl-dev \
    && pip install --upgrade pip \
    && python3 -m pip --no-cache-dir install -c pip-constraints.txt wal-e[aws] envdir \
    && rm -rf /var/cache/apk/* /tmp/* /var/tmp/*

#Healthcheck to make sure container is ready
HEALTHCHECK CMD pg_isready -U "$POSTGRES_USER" -d "$POSTGRES_DB" || exit 1

# VOLUME ["/var/run/postgresql", "/usr/share/postgresql/", "/var/lib/postgresql/data", "/tmp", "/etc/wal-e.d/env"]
