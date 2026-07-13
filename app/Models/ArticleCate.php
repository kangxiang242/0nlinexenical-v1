<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;




class ArticleCate extends Model 
{


    protected $sortable = [
        // 设置排序字段名称
        'order_column_name' => 'sort',
        // 是否在创建时自动排序，此参数建议设置为true
        'sort_when_creating' => true,
    ];

    protected $casts = [
        'options'=>'json',
        'options_gb'=>'json'
    ];

    public function faqs()
    {
        return $this->hasMany(Faq::class,'category_id');
    }

    /**
     * 获取博客文章的评论
     */
    public function article()
    {
        return $this->hasMany(Article::class)->where('status',1);
    }

}
