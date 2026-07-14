<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Cate extends Model 
{
    protected $table = 'categories';

    /**
     * 获取上级
     */
    public function parent()
    {
        return $this->hasOne(Cate::class, 'id', 'pid');
    }

    /**
     * 定义你的关联模型.
     *
     * @return BelongsToMany
     */
    public function product(): BelongsToMany
    {
        $pivotTable = 'product_cates'; // 中间表

        $relatedModel = Product::class;

        return $this->belongsToMany($relatedModel, $pivotTable, 'product_id', 'cate_id');
    }


}
