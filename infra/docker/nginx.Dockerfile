FROM nginx:1.27.3
WORKDIR /var/www
COPY public /var/www/public
COPY infra/nginx/conf/app.conf /etc/nginx/conf.d/
