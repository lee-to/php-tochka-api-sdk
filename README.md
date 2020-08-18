# Tochka API client for PHP

Tochka bank API client for PHP

## Installation

Tochka API client for PHP can be installed with [Composer](https://getcomposer.org/). Run this command:

```sh
composer require lee-to/php-tochka-api-sdk
```

## Использование

[Документация](https://enter.tochka.com/doc/v1/index.html)

### Импорт.
```php
use TochkaApi\TochkaApi;
use TochkaApi\HttpAdapters\CurlHttpClient;
```

### Инициализация.

```php

$tochkaApi = new TochkaApi("client_id", "client_secret", new CurlHttpClient);
//Для установки JWT токена
//$tochkaApi->setAccessToken("");
```

### OAuth2 авторизация.

```php
// Урл для авторизации, после подтверждения вернет $_GET["code"] на redirect_uri
$tochkaApi->getAuthorizeUrl();

//Вернет объект AccessToken для $tochkaApi->setAccessToken("");
$tochkaApi->token($_GET["code"]);
```

### Счета и организации
#### Список организаций
- https://enter.tochka.com/doc/v1/account.html#id2

``` php
$tochkaApi->organization()->list()
```

#### Список счетов
- https://enter.tochka.com/doc/v1/account.html#id3

``` php
$tochkaApi->account()->list()
```
### Выписки
#### Создание выписки
- https://enter.tochka.com/doc/v1/statement.html#id2

Параметры:

* account_code — номер счёта.
* bank_code — БИК банка.
* date_end — дата окончания срока выписки, формат даты ГГГГ-ММ-ДД.
* date_start — дата начала срока выписки, формат даты ГГГГ-ММ-ДД.

``` php
$tochkaApi->statement()->create(array $parameters);
```

#### Статус запроса
- https://enter.tochka.com/doc/v1/statement.html#c

Параметры:

* request_id — id запроса, получен на шаге «Создание запроса».

``` php
$tochkaApi->statement()->status($request_id);
```

#### Результат запроса
- https://enter.tochka.com/doc/v1/statement.html#id3

Параметры:

* request_id — id запроса, получен на шаге «Создание запроса».

``` php
$tochkaApi->statement()->result($request_id);
```
### Платежи
#### Создание платежа
- https://enter.tochka.com/doc/v1/payment.html#id2

Параметры:

* account_code (string) — счёт отправителя (20, цифры)
* bank_code (string) — БИК банка отправителя (9, цифры)
* counterparty_account_number (string) — счёт получателя (20, цифры)
* counterparty_bank_bic (string) — БИК банка получателя (9, цифры)
* counterparty_inn (string) — ИНН получателя (10, 12 цифры)
* counterparty_kpp (string) — КПП получателя (9, цифры)
* counterparty_name (string) — получатель платежа (до 160, кириллица, цифры, символы)
* payment_amount (string) — сумма платежа (до 18, цифры)
* payment_date (string) — дата платежа (В соответствии с Положением Банка России от 19.06.2012 № 383-П(ред. от 11.10.2018), в формате ДД.ММ.ГГГГ)
* payment_number (string) — номер платежа (6, цифры)
* payment_priority (string) — очерёдность платежа (1, цифры)
* payment_purpose (string) — назначение платежа (до 210)
* payment_purpose_code (string) — опциональное поле. Код вида дохода физ. лица («1», «2», «3» или пусто). Подробнее: ФЗ 229, Указание Банка России N 5286, ФЗ 12.
* supplier_bill_id (string) — код УИН (1, 20, 25 кириллица, цифры)
* tax_info_document_date (string) — дата бюджетного документа (1, 10 цифры)
* tax_info_document_number (string) — номер документа (до 15)
* tax_info_kbk (string) — КБК (1, 20, цифры)
* tax_info_okato (string) — код ОКАТО/ОКТМО (1, 8 цифры)
* tax_info_period (string) — налоговый период/Код таможенного органа (1,8,10 кириллица, цифры, символы)
* tax_info_reason_code (string) — основание платежа (2, кириллица)
* tax_info_status (string) — статус плательщика (2, цифры)

``` php
$tochkaApi->payment()->create(array $parameters);
```

#### Статус платежа
- https://enter.tochka.com/doc/v1/payment.html#id5

Параметры:

* request_id — id запроса, получен на шаге «Создание запроса».

``` php
$tochkaApi->payment()->status($request_id);
```

### Зарплатный проект
#### Запрос списка сотрудников
- https://enter.tochka.com/doc/v1/salary.html

Параметры:

* customer_code — id организации

``` php
$tochkaApi->salary()->employeeList($customer_code);
```

#### Получение списка сотрудников
- https://enter.tochka.com/doc/v1/salary.html

``` php
$tochkaApi->salary()->result($request_id);
```

#### Присоединение сотрудника
- https://enter.tochka.com/doc/v1/salary.html#id9

Параметры

customer_code (string) Идентификатор клиента.

employees (array) Список сотрудников.

* account_code (string) Номер банковского счёта сотрудника.
* bank_code (string) БИК банка сотрудника.
* birthdate (string) Дата рождения сотрудника.
* first_name (string) Имя сотрудника.
* last_name (string) Фамилия сотрудника.
* middle_name (string) Отчество сотрудника.

``` php
$tochkaApi->salary()->employeeAdd($customer_code, array $employees);
```

#### Запрос на создание платежной ведомости
- https://enter.tochka.com/doc/v1/salary.html#id15

Параметры

customer (object) Плательщик.

* customer_code (string) Идентификатор клиента.
* account_code (string) Номер банковского счёта плательщика.
* bank_code (string) БИК банка плательщика.
* |revenue_type| опциональное поле. Код вида дохода физ. лица («1», «2», «3» или пусто). Подробнее: ФЗ 229, Указание Банка России N 5286, ФЗ 12.

payments (array) Список платежей.

* account_code (string) Номер банковского счёта получателя.
* amount (string) Сумма платежа.
* bank_code (string) БИК банка получателя.
* birthdate (string) Дата рождения сотрудника.
* first_name (string) Имя сотрудника.
* last_name (string) Фамилия сотрудника.
* middle_name (string) Отчество сотрудника.
* |recoupment| опциональное поле. Взысканная сумма по |revenue_type|.

payment_period_start_date (string) Дата начала расчётного периода.

payment_period_end_date (string) Дата конца расчётного периода.

purpose_id (string) Идентификатор назначения.

``` php
$tochkaApi->salary()->payrollCreate(array $customer, array $payments, $payment_period_start_date, $payment_period_end_date, $purpose_id);
```

#### Запрос возможных назначений
- https://enter.tochka.com/doc/v1/salary.html#id15

``` php
$tochkaApi->salary()->purposes();
```

## Tests

1. [Composer](https://getcomposer.org/) is a prerequisite for running the tests. Install composer globally, then run `composer install` to install required files.
2. Get personal JWT token, then create `tests/TochkaTestCredentials.php` from `tests/TochkaTestCredentials.php.dist` and edit it to add your credentials.
3. The tests can be executed by running this command from the root directory:

```bash
$ ./vendor/bin/phpunit
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Credits

- [Danil Shutsky](https://github.com/lee-to)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Security

If you have found a security issue, please contact the maintainers directly at [leetodev@ya.ru](mailto:leetodev@ya.ru).