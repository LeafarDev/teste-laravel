# API do Teste
### Dependencias:
#### Tenha instalado o [Docker](https://docs.docker.com/engine/install/) e o [Docker Compose](https://docs.docker.com/compose/install/)
#
### Instalação:
```docker-compose up --build -d```
#### Após o build do comando anterior estiver finalizado e tudo estiver executando corretamente, execute as instruções abaixo:
##### *Se estiver executando o Docker no Windows, utilize o PowerShell
* Crie o arquivo ```.env``` a partir do ```.env.example``` e preencha as informações do banco de dados:
    * DB_CONNECTION=mysql
    * DB_HOST=laravel-teste-mysql
    * DB_PORT=3306
    * DB_DATABASE=car
    * DB_USERNAME=root
    * DB_PASSWORD=123456
* instalação de dependencias(se estiver no Linux): ```docker run -it --rm -v `pwd`:/app composer install```

* instalação de dependencias(se estiver no Windows): ```docker run -it --rm -v ${pwd}:/app composer install```

* Permissão pasta storage: ```docker-compose run --rm --no-deps php-fpm chmod -R 777 storage/```

* gerar chave: ```docker-compose exec php-fpm ./artisan key:generate```

* gerar as tabelas do banco de dados: ```docker-compose exec php-fpm ./artisan migrate```
#
### API
* A api funcionará em `https://localhost:3000/api`
    * https://localhost:3010/api/cars (PUT, DELETE, POST, GET)
#    
## Cadastrar Carro

### Request

`POST /api/cars`

    curl -XPOST -H "Content-type: application/json" -d '{"name": "teste 123","model": "Teste 111","year": "12365"}' http://localhost:3000/api/cars
    
### Response
```JSON
    {
        "data": {
            "id": 1,
            "name": "teste 123",
            "model": "Teste 111",
            "year": 12365,
            "created_at": "2020-09-28T18:45:54.000000Z",
            "updated_at": "2020-09-28T18:45:54.000000Z"
        },
        "message": "Car created successfully !"
    }  
```
#

## Atualizar Carro

### Request

`PUT /api/cars/:id`

    curl -XPUT -H "Content-type: application/json" -d '{"id": 1,"name": "Teste update 123","model": "Teste update","year": "12365"}' 'http://localhost:3000/api/cars/1'
    
### Response
```JSON
    {
           "data": {
               "id": 1,
               "name": "Teste update 123",
               "model": "Teste update",
               "year": "12365",
               "created_at": "2020-09-28T18:45:54.000000Z",
               "updated_at": "2020-09-28T18:46:10.000000Z"
           },
           "message": "Car updated successfully !"
       }   
```
#
## Listar carros

### Request

`GET /api/cars`

    curl -i -H 'Accept: application/json' http://localhost:3000/api/cars
    
### Response
```JSON
    [
        {
            "id": 1,
            "name": "Teste update 123",
            "model": "Teste update",
            "year": 12365,
            "created_at": "2020-09-28T18:45:54.000000Z",
            "updated_at": "2020-09-28T18:46:10.000000Z"
        }
    ]   
```    
#
## Visualizar carro pelo ID

### Request

`GET /api/cars/id`

    curl -i -H 'Accept: application/json' http://localhost:3000/api/cars/1
    
### Response
```JSON
    {
        "id": 1,
        "name": "teste 123",
        "model": "Teste 111",
        "year": 12365,
        "created_at": "2020-09-28T18:45:54.000000Z",
        "updated_at": "2020-09-28T18:45:54.000000Z"
    }  
```    
#
## Deletar Carro

### Request

`DELETE /api/cars/id`

    curl -XDELETE -H "Content-type: application/json" 'http://localhost:3000/api/cars/1'
    
### Response
```JSON
    {
        "message": "Car deleted successfully !"
    } 
```
#

