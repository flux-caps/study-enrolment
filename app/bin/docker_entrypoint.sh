#!/bin/bash
set -e

function startServer {
  php /app/server.php  &&  echo "http server started";
}

startServer