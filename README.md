# Bigfa
A theme for Typecho

DEMO：https://jozhn.com

![image](https://raw.githubusercontent.com/jozhn/Bigfa/master/screenshot.jpg)

## 环境要求
- PHP >= 5.6.0

## 下载启用
- Star本项目，下载本项目，解压并重命名为`Bigfa`
- 上传至theme文件夹下，后台启用并填好主题设置
- 关闭Typecho垃圾评论过滤(否则可能会导致无法评论)

## 必需插件
[Viewscounter](https://github.com/mierhuo/Typecho-ViewsCounter)(统计文章浏览数)

## 已知Bug
若某分类下无文章的话，其分类页面的分类名称与slug均无输出，这是Typecho一直没有解决的问题，暂时无解。

## 主题设置
- 侧边栏的缩略图来自文章里的附件中第一张图片,请先在后台设置默认缩略图
- 关于页面和分类页面需要手动选择模板新建页面
- 分类的缩略图请自己上传到`Bigfa/img/category/`目录下，并命名为目录的slug+`.jpg`
- 头像和logo在后台设置

## 主题特点
- `Highlight.js` 代码高亮
- `MathJax` 数学公式
- `lately.js` [文章时间](https://github.com/Tokinx/lately)
- 静态资源CDN设置
- 分类页面(新建页面选择模板即可)

## 更新记录

> 2019.1.26

v1.4

- 无文章缩略图的最后一个版本
- 浏览次数插件更新为viewscounter，不会报错
- 增加MathJax

> 2018.9.1

v1.3

- 完善各种功能的后台开关
- 解决instantclick和APlayer冲突
- 还没写完，待发布

> 2018.5.29

v1.2

- 整理优化CSS
- 完善按钮样式
- 修复图片不显示的bug
- 完善后台设置


> 2018.5.11

v1.1 

- 完善Markdown样式
- 代码高亮改为Highlight.js
- 修复safari无法显示blockquote

> 2018.4.19 

v1.0

- 基础版
