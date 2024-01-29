FROM node:20.11.0

RUN curl -sS http://dl.yarnpkg.com/debian/pubkey.gpg | apt-key add - && \
  echo "deb http://dl.yarnpkg.com/debian/ stable main" | tee /etc/apt/sources.list.d/yarn.list && \
  apt-get update -qq && apt-get install -yq --no-install-recommends && \
  apt-get install -y yarn

WORKDIR /var/www/

EXPOSE 3000

CMD ["/bin/sh", "-c", "yarn install; yarn dev"]