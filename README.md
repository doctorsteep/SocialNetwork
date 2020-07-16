# SocialNetwork - `Lopper`
 
## Старт проекта
###### Для начала возьмём файл *[social.sql](social.sql)* импортируем его в `MySQL(PHPMyAdmin)` после чего заходим в файл `connect.php` и в место стандарных значений подключения к базе пишем свои **(Путь файла: vendor/connect.php)**
```php
$db_host = 'localhost'; // ХОСТ БАЗЫ ДАННЫХ - НАПРИМЕР, localhost
$db_user = 'root'; // ПОЛЬЗОВАТЕЛЬ ОТ БАЗЫ ДАННЫХ - НАПРИМЕР, root
$db_password = ''; // ПАРОЛЬ ОТ БАЗЫ ДАННЫХ - НАПРИМЕР, 1234
$db_name = 'social'; // ИМЯ БАЗЫ ДАННЫХ - НАПРИМЕР, doctorsteep
```
###### после всего этого, наша соц. сеть на минималках готова к работе!
> Что есть в соц. сети
- Система авторизации
- Просмотр любого профиля
- Общение путем личных сообщений
- Редактирование профиля
- Какая никакая система лайков
- Записи на странице (на главной странице у ваших подпищиков будет отображаться ваши записи)
- Система подписок
- Полноценная оптимизированная моб. версия
- Подтверждение почты при регистрации или входе если не подтвердили при регистрации
- Поиск по вашим подпискам/подпищикам
- Смена фотографии профиля
- Загрузка фотографий в профиль

> Что в планах ещё реализовать
- Уведомления при действии. Например, на вас подписались, вам пришло сообщение и т.д...
- Отметка онлайн
- Поиск по всем пользователям соц. сети

ПРИМЕР СОЦ. СЕТИ ДОСТУПЕН [ЗДЕСЬ](https://lopper.fun). ТЫ МОЖЕШЬ ПОЩУПАТЬ СОЦ. СЕТЬ СВОИМИ РУКАМИ!

`СОЦ. СЕТЬ СОЗДАНА ИНТУЗИАСТОМ НЕ ПРОФЕССИОНАЛОМ!!!`
