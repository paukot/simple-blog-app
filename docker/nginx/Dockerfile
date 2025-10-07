FROM nginx:alpine

RUN apk add --no-cache openssl
RUN mkdir -p /etc/nginx/certs

RUN openssl req -x509 -nodes -days 365 \
    -newkey rsa:2048 \
    -keyout /etc/nginx/certs/selfsigned.key \
    -out /etc/nginx/certs/selfsigned.crt \
    -subj "/C=US/ST=State/L=City/O=Dev/OU=Dev/CN=localhost"

COPY docker/nginx/default.conf /etc/nginx/conf.d/default.conf


EXPOSE 80 443