# pg-interval-support
Support for interval field type in PostgreSQL databases.

### How to install
```
composer require urameshibr/pg-interval-support
```

* Add the service provider in config/app.php

```
'providers' => [
    // Other providers

    Urameshibr\PgIntervalSupport\Providers\PostgresTypeGrammarIntervalServiceProvider::class,
],
```

### Usage

* How to add a field with "interval" type in your migration file

```php
$table->addColumn('interval', 'field_name')
```

* How to query that interval field

```php
// The format: 
DB::table('table_name')->whereInterval('field_name', 'operator', 'interval')

// Example 1
DB::table('tours')->whereInterval('duration', '>=', '02:00:00')->get()

// Example 2
DB::table('tours')->whereInterval('duration', '>=', '2 hours')->get()

// Example 3
YourModel::whereInterval('duration', '>=', '2 hours')->get()
```

* Observation: The method "whereInterval( )" work's with Query Builder Object

Enjoy!
