FROM nginx:1.26

ENV TZ=UTC

COPY ./infra/docker/nginx/*.conf /etc/nginx/conf.d/

COPY ./src/public /work/src/public

WORKDIR /work/src
