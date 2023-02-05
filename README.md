# Fibonacci numbers service

Сервис возвращает ряд чисел Фибоначчи

Стек микросервиса: lumen(PHP 8.2) + redis + nginx

## Installation


```bash
cp .env.example .env
```

## Usage

#### Получение ряда Фибоначчи:

```http request
GET http://localhost/fibonacci

Content-Type: application/json
```

Params
```json
{
  "from": "integer|min 0",
  "to": "integer|min 1"
}
```

Success response:
```json
{
  "message": "success",
  "set_of_numbers": [2, 3, 5],
  "fibonacci_set_of_numbers": [0, 1, 1, 2, 3, 5, 8, 13, 21]
}
```

Validation error example:
```json
{
    "from": [
        "The from must be an integer."
    ],
    "to": [
        "The to must be an integer."
    ]
}
```
