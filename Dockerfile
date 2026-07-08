FROM node:20-alpine AS frontend-builder
WORKDIR /app
COPY package*.json ./
RUN npm ci
COPY . .
RUN npm run build
FROM php:8.2-cli-alpine
RUN docker-php-ext-install pdo pdo_mysql
WORKDIR /var/www/html
COPY . .
COPY --from=frontend-builder /app/public/build ./public/build
ENV PORT=8080
EXPOSE 8080
CMD ["sh", "-c", "php artisan serve --host=0.0.0.0 --port=${PORT:-8080}"]
