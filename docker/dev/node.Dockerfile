FROM node:10

RUN npm install --global gulp-cli && npm install gulp

USER node

WORKDIR /var/www