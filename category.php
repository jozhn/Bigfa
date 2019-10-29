<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php');  $this->widget('Widget_Metas_Category_List')->to($categorys);?>

<header class="collectionHeader">
	<div class="layoutSingleColumn layoutSingleColumn--wide u-flex">
		<div class="collectionHeader-logo u-flex0">
			<img class="collectionHeader-logoImage" src="<?php $this->options->themeUrl('img/category/'); ?><?php echo $this->categories[0]['slug'] . '.jpg'; ?>">
		</div>
		<div class="collectionHeader-nameAndDescription u-flex1">
			<h1 class="collectionHeader-name"><?php $this->category(',',false); ?></h1>
			<div class="collectionHeader-description">
				<p><?php echo $this->getDescription(); ?></p>
			</div>        
		</div>
	</div>
</header>

<ul class="collectionHeader-navList layoutSingleColumn layoutSingleColumn--wide">
  <li class="collectionHeader-navItem">
    <a class="link link--darken u-accentColor--textDarken u-baseColor--link" href=" "> </a>
  </li>
</ul>

<div class="layoutMultiColumn-container">
  <div class="layoutMultiColumn layoutMultiColumn--primary">
      <div class="blockGroup">
          <?php $views=0; while($this->next()):?>
				<article class="block--list" itemscope="itemscope" itemtype="http://schema.org/Article">
					<div class="block-content">
						<h2 class="block-title" itemprop="headline">
							<a href="<?php $this->permalink() ?>"><?php $this->title() ?></a>
						</h2>
                      <div class="block-snippet" itemprop="about">
                        <?php $this->excerpt(80,'...'); ?>
                      </div>
						<div class="block-postMeta">
							<?php echo ViewsCounter_Plugin::getViews(); ?>次浏览<?php $views+=ViewsCounter_Plugin::getViews(); ?>
							<span class="middotDivider"></span>
							<time class="lately-a" datetime="<?php $this->date('Y-m-d H:i:s'); ?>" itemprop="datePublished"><?php $this->date('Y年m月d日');?></time>
						</div>
					</div>
					<?php if(thumb($this->cid,1)!=null): ?>
					<a class="block-image" aria-label="<?php $this->title() ?>" href="<?php $this->permalink() ?>" style="background-image: url(<?php echo thumb($this->cid,1); ?>);"></a>
					<?php endif; ?>
				</article>
          <?php endwhile; ?>
       </div>
  </div>

  <div class="layoutMultiColumn layoutMultiColumn--secondary">
    <div class="js-sidebar u-paddingTop50">
        <div class="widget-card">
            <div class="widget-card-imageWrapper">
                <img class="widget-card-image" width="32" height="32" src="<?php $this->options->themeUrl('img/category/'); ?><?php echo $this->categories[0]['slug'] . '.jpg'; ?>">
            </div>
            <div class="widget-card-content"><?php echo $this->category(',',false); ?></div>
            <div class="widget-card-description">
                <p><?php echo $this->getDescription(); ?></p>
            </div>
            <div class="widget-card-info">
                <p class="widget-card-infoTitle">posts</p><?php if($this->categories[0]['count']==NULL){echo 0;}else{echo $this->categories[0]['count'];} ?>
                <p class="widget-card-infoTitle">views</p><?php echo $views; ?>
            </div>
        </div>
    </div>
  </div>
</div>

<?php $this->need('footer.php'); ?>
