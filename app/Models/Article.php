<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected function casts(): array
    {
        return [
            'release_at' => 'datetime',
            'mode' => 'integer',
        ];
    }

    protected $fillable = [
        'title', 'brief', 'img', 'img_alt', 'content', 'sort', 'status',
        'seo_title', 'seo_keyword', 'seo_description', 'custom_css',
        'article_cate_id', 'read_num', 'real_read_num', 'release_at',
        'mode', 'html_file'
    ];

    protected static function booted(): void
    {
        // 上传 html_file zip 后自动解压，供前台 iframe 加载
        static::saved(function (Article $article) {
            if ($article->mode != 1 || empty($article->html_file)) {
                return;
            }

            $zipPath = public_path('uploads/' . $article->html_file);
            if (!file_exists($zipPath)) {
                return;
            }

            $key = str_replace('.zip', '', basename($article->html_file));
            $extractDir = public_path('uploads/article_html/' . $key);
            if (!is_dir($extractDir)) {
                mkdir($extractDir, 0755, true);
            }

            // 若已解压过且 index.html 存在，跳过（避免重复追加 document.domain）
            $indexFile = $extractDir . '/index.html';
            if (file_exists($indexFile)) {
                return;
            }

            $zip = new \ZipArchive();
            if ($zip->open($zipPath) === true) {
                $zip->extractTo($extractDir);
                $zip->close();

                // 兼容旧站：iframe 跨域需要 document.domain
                file_put_contents($indexFile, "<script>document.domain='xenicalofficial.com'</script>", FILE_APPEND);
            }
        });
    }

    public function cate()
    {
        return $this->belongsTo(ArticleCate::class,'article_cate_id');
    }

    public function tags()
    {
        return $this->belongsToMany(ArticleTag::class, 'article_tag_relations', 'article_id', 'tag_id')
            ->where('article_tags.status', 1)
            ->orderBy('article_tags.sort', 'asc');
    }

    public function getTagIdsAttribute()
    {
        return $this->tags()->pluck('article_tags.id')->toArray();
    }

    public function scopeWithTagIds($query, $tagIds)
    {
        if ($tagIds && is_array($tagIds) && !empty($tagIds)) {
            return $query->whereHas('tags', function ($q) use ($tagIds) {
                $q->whereIn('article_tag_relations.tag_id', $tagIds);
            });
        }
        return $query;
    }
}
