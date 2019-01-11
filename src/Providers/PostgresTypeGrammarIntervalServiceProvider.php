<?php

namespace Urameshibr\PgIntervalSupport\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Fluent;
use Illuminate\Database\Query\Builder;

use Illuminate\Database\Schema\Grammars\PostgresGrammar as SchemaPostgresGrammar;
use Illuminate\Database\Query\Grammars\PostgresGrammar as QueryPostgresGrammar;

class PostgresTypeGrammarIntervalServiceProvider extends ServiceProvider
{
    public function boot()
    {
        SchemaPostgresGrammar::macro('typeInterval', function (Fluent $column) {

            return "interval NOT NULL";
        });

        QueryPostgresGrammar::macro('whereInterval', function (Builder $query, $where) {
            $value = $this->parameter($where['value']);

            return $this->wrap($where['column']) . '::interval ' . $where['operator'] . ' ' . $value . '::interval';
        });

        Builder::macro('whereInterval', function ($column, $operator, $value = null, $boolean = 'and') {
            list($value, $operator) = $this->prepareValueAndOperator(
                $value, $operator, func_num_args() === 2
            );

            if ($value instanceof DateTimeInterface) {
                $value = $value->format('H:i:s');
            }

            return $this->addDateBasedWhere('Interval', $column, $operator, $value, $boolean);
        });
    }
}