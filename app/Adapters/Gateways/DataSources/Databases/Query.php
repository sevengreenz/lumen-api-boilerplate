<?php

namespace App\Adapters\Gateways\DataSources\Databases;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\Builder;
use App\Adapters\Gateways\NotFoundException;

trait Query
{
    // テーブル名
    abstract public function table(): string;

    // JSON 型のカラム
    abstract public function jsonColumn(): array;

    /**
     * レコード一覧取得
     *
     * @param array $options select array 取得するカラム
     *                       where  array 取得条件
     *                       sort   array ソート条件  e.g. $sort=['column1' => 'asc', 'column2' => 'desc']
     *                       limit  int   取得件数
     *
     * @return array
     */
    public function find(array $options = []): array
    {
        $builder = DB::table($this->table());
        $builder = $this->where($builder, $options['where'] ?? []);
        $builder = $this->sort($builder, $options['sort'] ?? []);

        if (isset($options['limit'])) {
            $builder->limit($options['limit']);
        }

        app('log')->debug('query', ['sql' => $builder->toSql()]);

        $jsonColumn = $this->jsonColumn();

        return $builder->get($options['select'] ?? ['*'])
            ->transform(
                function ($row) {
                    // ネストされたオブジェクトも含めて全て array に変換
                    return json_decode(json_encode($row), true);
                }
            )
            ->transform(
                // JSON カラムのデータをパース
                function ($row) use ($jsonColumn) {
                    foreach ($jsonColumn as $column) {
                        if (isset($row[$column])) {
                            $row[$column] = json_decode($row[$column], true);
                        }
                    }
                    return $row;
                }
            )
            ->toArray();
    }

    public function read(array $options = []): array
    {
        $list = $this->find($options + ['limit' => 1]);
        if (empty($list)) {
            throw new NotFoundException($this->table(), $options['where'] ?? []);
        }

        return $list[0];
    }

    /**
     * where 作成
     *
     * @param Builder $builder QueryBuilder
     * @param array   $where   取得条件
     *
     * @return Builder
     */
    private function where(Builder $builder, array $where = []): Builder
    {
        foreach ($where as $column => $value) {
            if (! is_string($column)) {
                throw new \InvalidArgumentException(sprintf('where only accepcts string. input was: %s', $column));
            }

            preg_match('/(^.*)_in$/', $column, $matches);
            if (!empty($matches)) {
                return $builder->whereIn($matches[1], $value);
            }

            preg_match('/(^.*)_lt$/', $column, $matches);
            if (!empty($matches)) {
                return $builder->where($matches[1], '<', $value);
            }

            preg_match('/(^.*)_lte$/', $column, $matches);
            if (!empty($matches)) {
                return $builder->where($matches[1], '<=', $value);
            }

            preg_match('/(^.*)_gt$/', $column, $matches);
            if (!empty($matches)) {
                return $builder->where($matches[1], '>', $value);
            }

            preg_match('/(^.*)_gte$/', $column, $matches);
            if (!empty($matches)) {
                return $builder->where($matches[1], '>=', $value);
            }

            preg_match('/(^.*)_ne$/', $column, $matches);
            if (!empty($matches)) {
                return $builder->where($matches[1], '<>', $value);
            }

            $builder->where($column, $value);
        }

        return $builder;
    }

    /**
     * orderBy 作成
     *
     * @param Builder $builder QueryBuider
     * @param array   $sort    ソート条件
     *
     * @return Builder
     */
    private function sort(Builder $builder, array $sort): Builder
    {
        foreach ($sort as $column => $direction) {
            if (! in_array($direction, ['asc', 'desc'])) {
                throw new \InvalidArgumentException(sprintf('orderBy only accepcts asc or desc. input was: %s', $direction));
            }

            $builder->orderBy($column, $direction);
        }

        return $builder;
    }
}
