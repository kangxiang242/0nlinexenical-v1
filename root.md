# 0nlinexenical v1 — 项目根文档

> 賽尼可 Xenical 台灣線上訂購網站。v1 新版（Laravel 12 + Filament 3）。

---

## 快速导航

| 入口 | 地址 |
|------|------|
| 🌐 前台（本地） | http://localhost:8204 |
| 🔐 后台（本地） | http://localhost:8204/admin |
| 👤 后台账号 | `web0wer16888` |
| 🔑 后台密码 | `888d00rkeeper888` |

---

## 技术栈

| 组件 | 版本 |
|:-----|:-----|
| 框架 | Laravel 12.x |
| PHP | ^8.2 |
| 後台 | Filament 3.x |
| 数据库 | MySQL（`0nlinexenical_v1`, root/root2312） |
| 前端构建 | Vite |
| 编辑器 | wangEditor5 |

---

## 项目目录

| 路径 | 说明 |
|------|------|
| `/Users/a123/workspace/wwwroot/新站点/0nlinexenical-v1` | 项目根目录 |
| `storage/app/public/` | 上传文件（从旧站 rsync） |

---

## 源服务器信息（旧版 0nlinexenical.com）

| 项目 | 内容 |
|------|------|
| 域名 | www.0nlinexenical.com |
| IP 地址 | 45.14.226.187（hollow-hall） |
| SSH 端口 | 22 |
| Root 密码 | uIzCpKIewD6ZQ85R7WK7 |
| 操作系统 | CentOS Linux 7 |
| 环境 | Laravel 7/8 + PHP 7.4 + MySQL 5.7 + Nginx |
| 数据库名 | `0nlinexenical` |
| 数据库账号 | root / itqs9mw5 |
| 站点目录 | `/data/wwwroot/0nlinexenical.com` |
| 服务商 | phanes.cloud |
| Git 旧仓库 | `kangxiang242/0nlinexenical` |
| 备注 | 旧版为 Laravel 7 架构，v1 迁移时需注意兼容性 |

---

## 本地启动

```bash
cd /Users/a123/workspace/wwwroot/新站点/0nlinexenical-v1
php artisan serve --port=8204
```

---

## 数据来源

| 数据 | 来源 | 日期 |
|------|------|------|
| 数据库 | 从 45.14.226.187 导出 `0nlinexenical` → 导入 `0nlinexenical_v1` | 2026-07-13 |
| 上传文件 | rsync 从 45.14.226.187 `storage/app/public/` | 2026-07-13 |
| 模板 | 基于 cialis-store.com-v1 模板构建 | 2026-07-13 |

---

## 已修复问题

| 日期 | 问题 | 修复 |
|:-----|:-----|:-----|
| 2026-07-13 | 控制台 `/uploads` 404 | `promote_image` 模板加空值判断 |
| 2026-07-13 | 首页 500 错误 `format() on string` | Article 模型 `$dates` → `$casts` |
| 2026-07-13 | 首页图片 src 为空 | 导入旧站数据库 + rsync 图片文件 |
