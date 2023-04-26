FROM nginx:1.17.8-alpine

# Copy the public directory
# COPY ./public/ /app/public/
COPY . /app/

# Copy the nginx config file
COPY ./dockerfile/nginx/nginx.conf /etc/nginx/conf.d/default.conf
