<?php
/**
 * Bigfa by <a href="https://jozhn.com">Jozhn</a>
 *
 * @package Bigfa
 * @author Jozhn
 * @version 2.0
 * @link https://jozhn.com
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>

<?php if(isset($_GET['load_type']) and $_GET['load_type'] == 'ajax'):  ?>
	<?php while($this->next()): ?>
		<article class="block--list" itemscope="itemscop" itemtype="http://schema.org/BlogPosting">
			<div class="block-content">
				<h2 class="block-title" itemprop="headline">
					<a itemtype="url" href="<?php $this->permalink() ?>">
						<?php $this->title() ?>
					</a>
				</h2>
				<div class="block-snippet" itemprop="about">
				<?php $this->excerpt(80,'...'); ?>
			  </div>
				<div class="block-postMeta">
					<a href="<?php $this->permalink() ?>"  rel="category tag"><?php $this->category(','); ?></a>
					<span class="middotDivider"></span>
					<time itemprop="datePublished" datetime="<?php $this->date('Y-m-d H:i:s'); ?>"><?php $this->date('Y-m-d H:i:s');?></time>
				</div>
			</div>
			<?php if(thumb($this->cid,1)!=null): ?>
			<a class="block-image" aria-label="<?php $this->title() ?>" href="<?php $this->permalink() ?>" style="background-image: url(<?php echo thumb($this->cid,1); ?>);"></a>
			<?php endif; ?>
		</article>
	<?php endwhile; ?>
	<?php return; ?>
<?php endif ?>
		
<?php
$this->need('header.php');
?>
	
 <div class="layoutMultiColumn-container u-paddingTop50">
	<div class="layoutMultiColumn layoutMultiColumn--primary">
		<div class="widget-title u-xs-hide">
		 最新文章
		</div>
	   <div class="blockGroup" id="blockGroup">
          <?php while ($this->next()): ?>
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
						<time itemprop="datePublished" datetime="<?php $this->date('Y-m-d H:i:s'); ?>"><?php $this->date('Y-m-d H:i:s');?></time>
					</div>
				</div>
				<?php if(thumb($this->cid,1)!=null): ?>
				<a class="block-image" aria-label="<?php $this->title() ?>" href="<?php $this->permalink() ?>" style="background-image: url(<?php echo thumb($this->cid,1); ?>);"></a>
				<?php endif; ?>
           </article>
          <?php endwhile; ?>
       </div>

		<div class="block-more">
           <button id="show-more" onclick ="load_more_post()" class="button button--primary button--small">加载更多</button>
		</div>

    </div>

<?php if(!is_mobile()): $this->need('sidebar.php'); endif;?>

</div>

<?php $this->need('footer.php'); ?>
