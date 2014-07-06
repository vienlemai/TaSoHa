<?php

class BaseModel extends LaravelBook\Ardent\Ardent {
    public $autoPurgeRedundantAttributes = true;

    /**
     * scopeSearchLike
     * create query where like
     * @param QueryBuilder $query
     * @param string $keyword keyword for searching
     * @param string $column the colum of table for searching
     * 
     * @return QueryBuilder
     * 
     * @since XXX
     */
    public function scopeSearchLike($query, $keyword, $column) {
        if (is_array($column)) {
            $query->where(function($query)use($column, $keyword) {
                foreach ($column as $item) {
                    $query->orWhere($item, 'like', '%' . $keyword . '%');
                }
            });
        } else {
            $query->where($column, 'like', '%' . $keyword . '%');
        }
        return $query;
    }

}
