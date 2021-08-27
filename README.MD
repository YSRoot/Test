# Мое первое тестовое задание

```text
Необходимо реализовать сервис на PHP для генерации случайных идентификаторов

Сервис реализует JSON API работающее по HTTP. Каждое создание присваивает уникальный id, по которому можно получить результат генерации методом GET.

Реализовать методы

• POST /api/indicators/ - генерация случайного значения и его идентификатора

• GET /api/indicators/{id} - получение значения по id, которое вернулось в методе создания

• возможность задать входные параметры для метода POST /api/indicators/

• type - тип возвращаемого случайного значения

• Строка

• Число

• Guid

• Цифробуквенное

• длина возвращаемого значения

• возможность идемпотентных запросов (несколько запросов с одним id вернут то же самое число)

• написать Unit тесты
```

## Инструкции как пользоваться

1. php -S localhost:8000 
```bash
GET запрос http://localhost:8000/q?api/indicators/{id} - берет из базы значение по id
POST запрос http://localhost:8000/q?api/indicators/ остальное в теле запроса - записывает в базу рандомное значение с новым id (строку, число, guid, или числобуквенное значение)

```

###POST запрос поддерживает параметр `type = 'string'|'alphanumeric'|'guid'` в любом другом случае возвращает числа рандомные

2. Эндпоинт для просмотра всех данных из базы 
```bash
    http://localhost:8000/test.php - выводит все данные из базы
   ```