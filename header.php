<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; 
//当cdn加速开启时候定义cdn的地址
if (!empty($this->options->next_cdn) && $this->options->next_cdn){
    define('__TYPECHO_THEME_URL__', Typecho_Common::url(__TYPECHO_THEME_DIR__ . '/' . basename(dirname(__FILE__)) , $this->options->next_cdn));
}
?>
<!DOCTYPE HTML>
<html  lang="zh-CN">
<head>
    <meta http-equiv="Content-Type" charset="<?php $this->options->charset(); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
    <meta name="renderer" content="webkit">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title><?php $this->archiveTitle(array('category' => _t('%s'), 'search' => _t('Search Results for "%s"'), 'tag' => _t('%s'), 'author' => _t('%s的文章')), '', ' - '); ?><?php $this->options->title(); ?></title>

    <!-- 使用url函数转换相关路径 -->
    <link rel="stylesheet" href="<?php $this->options->themeUrl('static/css/style.css'); ?>">
    <link rel="stylesheet" href="<?php $this->options->themeUrl('static/css/prism.css'); ?>">
    <script src="<?php $this->options->themeUrl('static/js/jquery.min.js'); ?>" data-no-instant></script>
    <script src="<?php $this->options->themeUrl('static/js/timeago.js'); ?>" data-no-instant></script>
    <script src="<?php $this->options->themeUrl('static/js/timeago.zh-CN.js'); ?>" data-no-instant></script>
    <script src="<?php $this->options->themeUrl('static/js/prism.js'); ?>" data-no-instant></script>

    <!-- 通过自有函数输出HTML头部信息 -->
    <?php $this->header(); ?>
	
</head>

<body class="is-js">
  <div class="site-main surface-container"> 
    <div class="butterBar"><p class="butterBar-message"></p></div> 
   
   <header class="metabar metabar--bordered metabar--top u-clearfix"> 
    <div class="metabar-block u-floatLeft" itemprop="publisher" itemscope="" itemtype="https://schema.org/Organization"> 
     <h1 class="site-title u-floatLeft" itemprop="logo" itemscope="" itemtype="https://schema.org/ImageObject"> <a href="<?php $this->options->siteUrl(); ?>" class="logo" title="<?php $this->options->title(); ?>"> <img src="<?php $this->options->themeUrl('img/logo.png'); ?>" width="38" /></a></h1> 
     <meta itemprop="name" content="Dearjohn" /> 
     <meta itemprop="url" content="https://dearjohn.cn" /> 
    </div> 
    <div class="metabar-block metabar-center"> 
     <nav class="navTabs navTabs--metabar navTabs--narrow" itemtype="http://schema.org/SiteNavigationElement" itemscope=""> 
      <ul class="subnav-ul layoutSingleColumn layoutSingleColumn--wide">
        <?php if ($this->is('index')) : ?>
        <?php $this->widget('Widget_Contents_Page_List')->parse('<li  class="subnav-li"><a class="subnav-item" href="{permalink}">{title}</a></li>'); ?>
        <?php endif; ?>
      </ul>
     </nav> 
    </div> 
    <div class="metabar-block u-floatRight"> 
     <form id="search" class="metabar-predictiveSearch search-form" action="<?php $this->options->siteUrl(); ?>" role="search" method="GET"> 
        <label title="Search <?php $this->options->title(); ?>"> 
        <svg viewBox="0 0 25 25" width="25" height="25" class="svgIcon"><use class="svgIcon-use" xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="https://dearjohn.cn/usr/themes/Bigfa/img/icons.svg#svg-search-25px-p0"></use></svg>
         <input id="input" class="textInput textInput--dark textInput--rounded" name="s" type="text" required="true" placeholder="Search <?php $this->options->title(); ?>" /> 
  	   </label>
     </form> 
    </div> 
   </header>


    
    
