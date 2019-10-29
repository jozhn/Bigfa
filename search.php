<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>

</br>
<div class="u-size640 u-centered is-underMetabar">
    <form action="<?php $this->options->siteUrl(); ?>" role="search" method="GET">
        <input class="js-searchInput textInput textInput--jumbo textInput--underlined textInput--marginBottom10" name="s" type="search" value="<?php echo $this->archiveTitle('','',''); ?>" placeholder="Search <?php $this->options->title(); ?>">
    </form>
    <div class="label label--smaller u-clearfix">
            <div class="u-floatLeft"><?php echo $this->archiveTitle('','',''); ?>的搜索结果</div>
    </div>
    <div class="blockGroup">
    <?php while($this->next()):?>
        <article class="block--list" itemscope="itemscope" itemtype="http://schema.org/Article">
				<div class="block-content">
					<h2 class="block-title" itemprop="headline">
						<a href="<?php $this->permalink() ?>"><?php $this->title() ?></a>
					</h2>
					<div class="block-snippet" itemprop="about">
						<?php $this->excerpt(80,'...'); ?>
					</div>
					<div class="block-postMeta">
						<a href="<?php $this->permalink() ?>"  rel="category tag"><?php $this->category(','); ?></a>
						<span class="middotDivider"></span>
						<time itemprop="datePublished" datetime="<?php $this->date('Y-m-d H:i:s'); ?>"><?php $this->date('Y年m月d日');?></time>
					</div>
				</div>
				<?php if(thumb($this->cid,1)!=null): ?>
				<a class="block-image" aria-label="<?php $this->title() ?>" href="<?php $this->permalink() ?>" style="background-image: url(<?php echo thumb($this->cid,1); ?>);"></a>
				<?php endif; ?>
           </article>
    <?php endwhile; ?>
  </div>

  <div class="lists-navigator clearfix">
      <?php $this->pageNav('←','→','2','...'); ?>
  </div>
</div>

<footer class="footer--empty"></footer>

<div class="loadingBar"></div>

    <script src="https://cdn.bootcss.com/instantclick/3.0.0/instantclick.min.js" data-no-instant></script>
    <script data-no-instant>
	InstantClick.on('change', function(isInitialLoad) {
        $.lately({
            'target' : '.lately-a,.lately-b,.lately-c'
        });
      });
    InstantClick.init('mousedown');
    </script>
</body>
</html>