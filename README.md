## Настройка проекта

- `composer install`
- npm install
- настроить `.env` файл
- `php artisan key:generate`
_____________
###Настройка БД
1) создать БД локально или на сервере и указать ее в .env файле 
2) php artisan migrate

_____________

## Запуск приложения

* php artisan serve
______
### При необходимости 
*  npm run watch


## Получение токенов для работы

- 6 запросов в минуту макс
- Отправить POST запрос multipart/form-data  на ./api/create/user c данными 
- {
name => обязательно, email => обязательно, password => обязательно}
- полученный ключ сохранить для дальнейших запросов
- при потере ключа можно получить новый ключ
- Отправить POST запрос multipart/form-data на ./api/gettoken с данными
- {email => Ваш email, password => Ваш пароль} если пользователь найден и совпадает пароль, то Вам вернется ключ, который нужно сохранить 
- 
