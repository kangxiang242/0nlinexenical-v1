<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * 将 mode=1 的 html_file 代码包文章转换为富文本模式：
     * - 提取 index.html 的 body 内容到 content
     * - 提取 style.css 到 custom_css
     * - 图片路径转换为 /uploads/article_html/{key}/img/
     * - 清空 html_file，mode 设为 0
     */
    public function up(): void
    {
        $articles = DB::table('articles')->where('mode', 1)->get();

        foreach ($articles as $article) {
            if (empty($article->html_file)) {
                continue;
            }

            $key = str_replace('.zip', '', basename($article->html_file));
            $dir = public_path('uploads/article_html/' . $key);
            $indexFile = $dir . '/index.html';
            $styleFile = $dir . '/style.css';

            if (!file_exists($indexFile)) {
                continue;
            }

            $html = file_get_contents($indexFile);

            // 移除旧站兼容追加的 document.domain 脚本
            $html = preg_replace('/<script>document\.domain=[\'"][^\'"]*[\'"]<\/script>\s*$/is', '', $html);

            // 提取 body 内容
            $body = '';
            if (preg_match('/<body[^>]*>(.*)<\/body>/is', $html, $matches)) {
                $body = $matches[1];
            } else {
                $body = $html;
            }

            // 清理 Preloader、ScrollToTop 等非内容元素
            $body = preg_replace('/<!-- Preloader -->.*?<!-- Preloader END -->/is', '', $body);
            $body = preg_replace('/<!-- ScrollToTop Button -->.*?<!-- ScrollToTop Button END-->/is', '', $body);
            $body = trim($body);

            // 转换图片路径为绝对路径
            $body = preg_replace('/(src=["\'])img\//i', '$1/uploads/article_html/' . $key . '/img/', $body);

            // 读取自定义 CSS
            $css = '';
            if (file_exists($styleFile)) {
                $css = file_get_contents($styleFile);
            }

            DB::table('articles')->where('id', $article->id)->update([
                'content' => $body,
                'custom_css' => $css,
                'mode' => 0,
                'html_file' => null,
            ]);
        }
    }

    public function down(): void
    {
        // 不可逆
    }
};
