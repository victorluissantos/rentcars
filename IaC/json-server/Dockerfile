FROM node:latest

WORKDIR /app

COPY db1.json /app/db1.json
COPY db2.json /app/db2.json
COPY db3.json /app/db3.json
COPY db4.json /app/db4.json

RUN npm install -g json-server

CMD json-server --watch db1.json --port 3001 & wait & \
    json-server --watch db2.json --port 3002 & wait & \
    json-server --watch db3.json --port 3003 & wait & \
    json-server --watch db4.json --port 3004 && wait
