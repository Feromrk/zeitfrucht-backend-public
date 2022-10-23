FROM mysql:5.6

ARG HOST_GID_ARG
ENV HOST_GID=$HOST_GID_ARG
ARG HOST_UID_ARG
ENV HOST_UID=$HOST_UID_ARG

RUN usermod -u $HOST_UID www-data
RUN groupmod -g $HOST_GID www-data

COPY docker/mysql/db/* /docker-entrypoint-initdb.d/

#RUN apt-get update
#RUN apt-get install -y nano