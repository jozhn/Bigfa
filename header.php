<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit;
//当cdn加速开启时候定义cdn的地址
if (!empty($this->options->next_cdn) && $this->options->next_cdn){
    define('__TYPECHO_THEME_URL__', Typecho_Common::url(__TYPECHO_THEME_DIR__ . '/' . basename(dirname(__FILE__)) , $this->options->next_cdn));
}
?>
<?php //如果是ajax方式的请求就直接退出此页面使得该页面为空 ?>
<?php if(isset($_GET['load_type']) and $_GET['load_type'] == 'ajax'):  ?>
    <?php return; //完成ajax方式返回，退出此页面?>
<?php endif ?>

<!DOCTYPE HTML>
<html  lang="zh-CN">
<head>
    <meta http-equiv="Content-Type" charset="<?php $this->options->charset(); ?>">
    <meta name="baidu-site-verification" content="Md1b0xdKNB" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
    <meta name="renderer" content="webkit">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title><?php $this->archiveTitle(array('category' => _t('%s'), 'search' => _t('Search Results for "%s"'), 'tag' => _t('%s'), 'author' => _t('%s的文章')), '', ' - '); ?><?php $this->options->title(); ?></title>
  	<!-- jquery、valine、highlight.css、style.css -->
  	<script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.min.js" data-no-instant></script>
  	<?php if ($this->options->valine=='able') : ?>
  	<script src="//cdn1.lncld.net/static/js/3.0.4/av-min.js"></script>
  	<script src='//unpkg.com/valine/dist/Valine.min.js'></script>
  	<?php endif; ?>
    <!-- require APlayer -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aplayer/dist/APlayer.min.css">
    <script src="https://cdn.jsdelivr.net/npm/aplayer/dist/APlayer.min.js"></script>
    <!-- require MetingJS -->
    <script src="https://cdn.jsdelivr.net/npm/meting@2/dist/Meting.min.js"></script>
    <?php if ($this->options->aplayer == 'able'):?>
    <script>
    if (typeof aplayers !== 'undefined'){
      for (var i = 0; i < aplayers.length; i++) {
        try {aplayers[i].destroy()} catch(e){}
      }
    }
    </script>
    <?php endif; ?>
  	
    <link rel="stylesheet" href="<?php $this->options->themeUrl('static/css/style.css'); ?>">
  	<link rel="stylesheet" type="text/css" href="https://cdn.bootcss.com/highlight.js/9.12.0/styles/github.min.css" />

    <?php if($this->options->Analytics): ?>
    <?php $this->options->Analytics(); ?>
    <?php endif; ?>
    
    <!-- 通过自有函数输出HTML头部信息 -->
    <?php $this->header(); ?>
</head>

<body class="is-enableBrandingButtons is-js">
  <div class="site-main surface-container"> 
    <div class="butterBar"><p class="butterBar-message"></p></div> 
   
   <header class="metabar metabar--bordered metabar--top u-clearfix"> 
    <div class="metabar-block u-floatLeft" itemprop="publisher" itemscope="" itemtype="https://schema.org/Organization"> 
		<h1 class="site-title u-floatLeft" itemprop="logo" itemscope="" itemtype="https://schema.org/ImageObject"> 
			<a href="<?php $this->options->siteUrl(); ?>" class="logo" title="<?php $this->options->title(); ?>"> 
				<img src="<?php echo $this->options->logoUrl; ?>" width="38" />
				<span class="u-textScreenReader"><?php $this->options->title(); ?></span>
			</a>
		</h1> 
		<meta itemprop="name" content="<?php $this->options->title(); ?>" /> 
		<meta itemprop="url" content="<?php $this->options->siteUrl(); ?>" /> 
    </div> 
    <div class="metabar-block metabar-center"> 
		 <nav class="navTabs navTabs--metabar navTabs--narrow" itemtype="http://schema.org/SiteNavigationElement" itemscope=""> 
			 <div class="layoutSingleColumn layoutSingleColumn--wide">
				  <ul class="subnav-ul">
					<?php //如果是首页才显示菜单if ($this->is('index')) : ?>
					<?php $this->widget('Widget_Contents_Page_List')->parse('<li class="subnav-li"><a class="subnav-item" href="{permalink}">{title}</a></li>'); ?>
					<?php //endif; ?>
				  </ul>
			 </div>
		</nav> 
    </div> 
    <div class="metabar-block u-floatRight"> 
     <form id="search" class="metabar-predictiveSearch search-form" action="<?php $this->options->siteUrl(); ?>" role="search" method="GET"> 
        <label title="Search <?php $this->options->title(); ?>"> 
        <svg xmlns="http://www.w3.org/2000/svg" style="display:none;">
          <symbol viewBox="0 0 25 25" id="svg-search">
            <title>svg-search</title>
            <path d="M20.067 18.933l-4.157-4.157c.837-1.032 1.34-2.345 1.34-3.776 0-3.314-2.686-6-6-6s-6 2.686-6 6 2.686 6 6 6c1.43 0 2.744-.503 3.776-1.34l4.157 4.157c.113.113.27.183.442.183.345 0 .625-.28.625-.625 0-.173-.07-.33-.183-.442zM6.5 11c0-2.62 2.13-4.75 4.75-4.75S16 8.38 16 11s-2.13 4.75-4.75 4.75S6.5 13.62 6.5 11z"
            />
          </symbol>
        </svg>
        <svg viewBox="0 0 25 25" width="25" height="25" class="svgIcon">
            <use class="svgIcon-use" xlink:href="#svg-search">
            </use>
        </svg>
         <input id="input" class="textInput textInput--dark textInput--rounded" name="s" type="text" required="true" placeholder="Search <?php $this->options->title(); ?>" /> 
  	   </label>
     </form> 
    </div> 
   </header>

    
    
