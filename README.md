# Products API

## Installation

```bash
docker compose up -d
```

## Configuration

Add Pusher keys to the `.env` file.

```bash
BROADCAST_DRIVER=pusher
PUSHER_APP_ID=your_app_id
PUSHER_APP_KEY=your_app_key
PUSHER_APP_SECRET=your_app_secret
PUSHER_APP_CLUSTER=your_app_cluster
```

## Usage

Login:

```bash
curl -X POST http://localhost:6880/login \
     -H "Accept: application/json" \
     -H "Content-Type: application/json" \
     -d '{"email": "admin@admin.com", "password": "password"}'
```

Create a product:

```bash
curl -X POST http://localhost:6880/products \
     -H "Accept: application/json" \
     -H "Content-Type: application/json" \
     -d '{"name": "Product 1", "description": "Description 1", "category_id": 1, "status_id": 1, "country_id": 1}' \
     -H "Authorization: Bearer <token>"
```

Get product list

```bash
curl -X GET http://localhost:6880/products \
     -H "Accept: application/json" \
     -H "Content-Type: application/json" \
     -H "Authorization: Bearer <token>"
```

Get products dropdown

```bash
curl -X GET http://localhost:6880/products/dropdown \
     -H "Accept: application/json" \
     -H "Content-Type: application/json" \
     -H "Authorization: Bearer <token>"
```

Get product by id

```bash
curl -X GET http://localhost:6880/products/1 \
     -H "Accept: application/json" \
     -H "Content-Type: application" \
     -H "Authorization: Bearer <token>"
```

Update product

```bash
curl -X PATCH http://localhost:6880/products/1 \
     -H "Accept: application/json" \
     -H "Content-Type: application/json" \
     -d '{"name": "Product 1", "description": "Description 1", "category_id": 1, "status_id": 1, "country_id": 1}' \
     -H "Authorization: Bearer <token>"
```

Delete product

```bash
curl -X DELETE http://localhost:6880/products/1 \
     -H "Accept: application/json" \
     -H "Content-Type: application/json" \
     -H "Authorization: Bearer <token>"
```

