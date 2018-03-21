<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>

<div class="layoutSingleColumn">
    <article class="u-paddingTop50" itemscope="itemscope" itemtype="http://schema.org/Article">
	<header class="entry-header">
	<h2 class="entry-title" itemprop="headline"><?php $this->title() ?></h2>
	<div class="entry-meta">
		<a><time class="timeago" datetime="<?php $this->date('Y-m-d H:i:s'); ?>" itemprop="datePublished"><?php $this->date('Y-m-d H:i:s');?></time></a>
		<span class="middotDivider"></span>
		<a rel="category tag">关于</a>
	</div>
	</header>
	<div class="grap" itemprop="articleBody">
		<?php $this->content(); ?>
	</div>
    </article>

    <?php $this->need('comments.php'); ?>

</div><!-- end #main-->

<?php $this->need('footer.php'); ?>