<?php

namespace App\UseCases\Interactors;

/**
 * create gateway parameter from GET method API query string
 */
trait ParamQueryMapper
{
    public function param2Query(array $params): array
    {
        $options = [];
        $order   = explode(',', $params['_order'] ?? '');

        // create sort option from _sort and _order
        if (isset($params['_sort'])) {
            foreach (explode(',', $params['_sort']) as $i => $column) {
                $options['sort'][$column] = $order[$i] ?? 'asc';
            }
        }

        if (isset($params['_select'])) {
            $options['select'] = explode(',', $params['_select']);
        }

        unset($params['_sort']);
        unset($params['_order']);
        unset($params['_select']);
        if (! empty($params)) {
            $options['where'] = $params;
        }

        return $options;
    }
}
