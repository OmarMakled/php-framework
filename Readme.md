# Installation

To start the project you need to run `docker compose up -d` it will pull the images if not exists and spin up the containers.

```
docker compose up -d
```

### Create database and tables

If this is the first time make sure you create the database and tables

username: root password: root
```
docker compose exec db /bin/bash
mysql -u root -p
create database oscar;
```

to create the tables
```
docker compose exec app ./src/bin/install.php
```

### PSR-12 

You can check the code against the PSR-12 coding standard by running 

```
docker compose exec app composer autofix
```

### Run test
```
docker compose exec app composer test-coverage
```

### Check code coverage
`http://localhost:3000/`


### Import data 
```
docker compose exec app ./src/bin/import.php src/bin/source-1.csv
docker compose exec app ./src/bin/import.php src/bin/source-2.json
docker compose exec app ./src/bin/import.php src/bin/source-3.json
```

### API 
base url `http://localhost:8000`

| type   | url                         |  description            |
| ------ | --------------------------- | ---------------------- |
| GET   | /api/cars             |  Get list of cars     |
| GET   | /api/cars/location?query=[term]            | Get list of cars by location    |
| GET   | /api/cars/year?query=[term]            | Get list of cars by year    |
| POST | /api/cars        | Create new car     |

#### Get list of cars

`GET /api/cars`
```
{
"total": 10
"items": [{
    "id": 3,
    "year": 2017,
    "location": "Calahonda",
    "fuelType": "Petrol",
    "model": "i10",
    "doors": 5,
    "transmission": "Manual",
    "seats": 5,
    "brand": "Hyundai",
    "type": "Small car",
    "typeGroup": "Car",
    "details": {
        "Inside width": null,
        "Inside height": null,
        "Inside length": null,
        "License plate": "0186  KDN"
    }
    },...]
}
```

#### Create new car
`POST /api/cars` 

| Field   |  description            |
| ------ | ---------------------- |
| Car km   | required, string     |
| Car year   | required, string    |
| Location | required, string     |
| Fuel type | required, string, `allow null`   |
| Car Model | required, string     |
| Number of doors | required, int, `greather than 0`     |
| Transmission | required, string, `allow null`     |
| Number of seats | required, int, `greather than 0`    |
| Car Brand | required, string     |
| Car Type Group | optional, string, `allow null`     |
| Car Type | optional, string, `allow null`     |
| Details | optional, array, `allow null`   [ 'Inside height', 'Inside length', 'Inside width', 'License plate']  |

*Created 201*
```
{
}
```
*Error 422*
```
{ "error": "The field doors should be greather than 0" }
```

### Access into container
```
docker compose exec db /bin/bash
docker compose exec  nginx sh
docker compose exec app /bin/bash
```