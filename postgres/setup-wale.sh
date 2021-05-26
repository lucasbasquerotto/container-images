#!/bin/bash

# wal-e specific configuration
{
    echo "wal_level = $WAL_LEVEL";
    echo "archive_mode = $ARCHIVE_MODE";
    echo "archive_command = '/usr/bin/wal-e wal-push %p'";
    echo "archive_timeout = $ARCHIVE_TIMEOUT"
} >> "$PGDATA/postgresql.conf"