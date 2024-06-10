## Laravel Users / Orders / Products App

### Start App

- clone githab [repo](https://github.com/OlegMarko/laravel-user-orders)
- `cd laravel-user-orders`
- `cp .env.example .env`
- setup envs
- install vendors `composer install`
- start docker `./vendor/bin/sail up -d`

### API

- endpoint POST `/api/v1/products`

example
```shell
curl --location 'http://localhost/api/v1/products' \
--header 'Content-Type: application/json' \
--header 'Accept: application/json' \
--data '{
    "name": "Test Product",
    "price": 100,
    "description": "Test Product Description"
}'
```

- endpoint POST `/api/v1/users`

example
```shell
curl --location 'http://localhost/api/v1/users' \
--header 'Content-Type: application/json' \
--header 'Accept: application/json' \
--data '{
    "name": "Test User",
    "email": mail@test.com,
    "password": "12323123a"
    "password_confirmation": "12323123a"
}'
```

- endpoint POST `/api/v1/orders`

example
```shell
curl --location 'http://localhost/api/v1/orders' \
--header 'Content-Type: application/json' \
--header 'Accept: application/json' \
--data '{
    "user_id": 1,
    "product_id": 1,
    "quantity": 2
}'
```

- endpoint GET `/api/v1/orders`

example
```shell
curl --location 'http://localhost/api/v1/orders' \
--header 'Accept: application/json' \
--header 'Content-Type: application/json'
```
