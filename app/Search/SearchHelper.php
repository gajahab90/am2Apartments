<?php


namespace App\Search;


use Illuminate\Database\Eloquent\Builder;

class SearchHelper {
    public static function searchAndSort(array $data, Builder $queryBuilder, array $parameterMap, $per_page, $baseTable) {
        foreach ($data as $key => $value) {
            if(array_key_exists($key, $parameterMap)) {
                if($parameterMap[$key]['operation'] === 'like') {
                    $queryBuilder->where($parameterMap[$key]['column'], 'like', '%' . $value . '%');
                } else if(is_null($parameterMap[$key]['operation'])) {
                    $queryBuilder->where($parameterMap[$key]['column'], $value);
                } else if(str_contains($parameterMap[$key]['operation'], 'arithmetic') && is_array($value)) {
                    $parsedValue = $parameterMap[$key]['operation'] === 'arithmeticFloat' ?
                        (float) $value['value'] : (int) $value['value'];
                    $queryBuilder->where($parameterMap[$key]['column'], $value['arithmetic'], $parsedValue);
                } else if(str_contains(strtolower($parameterMap[$key]['operation']), 'date') && is_array($value)) {
                    $queryBuilder->whereDate($parameterMap[$key]['column'], $value['arithmetic'], $value['value']);
                }

                if($parameterMap[$key]['column'] == 'category_id') {
                    $queryBuilder
                        ->leftJoin('category_relations', $baseTable . '.category_id' , '=', 'category_relations.child_category_id');
                    $queryBuilder->orWhere('category_relations.parent_category_id', $value);
                }
            }
        }

        if(isset($data['orderBy'])) {
            foreach ($data['orderBy'] as $elementString) {
                $orderBy = explode(':', $elementString);

                if(array_key_exists($orderBy[0], $parameterMap)) {
                    $orderDirection = (isset($orderBy[1]) && strtolower($orderBy[1]) === 'desc') ? 'desc' : 'asc';
                    $queryBuilder->orderBy($orderBy[0], $orderDirection);
                }
            }
        }

        return $queryBuilder->paginate($per_page);
    }
}
