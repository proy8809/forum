FROM nginx:alpine

COPY ./nginx/nginx.conf /etc/nginx/
COPY ./nginx/templates /etc/nginx/templates/
RUN echo "upstream php-upstream { server php:9000; }" > /etc/nginx/conf.d/upstream.conf

EXPOSE 80
EXPOSE 443