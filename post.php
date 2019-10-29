<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>

<?php
	$host = 'https://secure.gravatar.com';
	$url = '/avatar/';
	$size = '80';
	$default = 'mm';
	$rating = Helper::options()->commentsAvatarRating;
	$mail = $this->author->mail;
	$hash = md5(strtolower($mail));
	$avatar = $host . $url . $hash . '?s=' . $size . '&r=' . $rating . '&d=' . $default;
?>
		
<div class="layoutSingleColumn">
    <article class="u-paddingTop50" itemscope="itemscope" itemtype="http://schema.org/Article">
		<header class="entry-header">
		<h2 class="entry-title" itemprop="headline"><?php $this->title() ?></h2>
		<div class="entry-meta">
			<time class="lately-a" datetime="<?php $this->date('Y-m-d H:i:s'); ?>" itemprop="datePublished"><?php $this->date('Y年m月d日');?></time>
			<span class="middotDivider"></span>
			<a href="<?php $this->permalink(); ?>"><?php $this->category(','); ?></a>
		</div>
		</header>

		<meta itemscope itemprop="mainEntityOfPage"  itemType="https://schema.org/WebPage" itemid="<?php $this->permalink(); ?>"/>

		<div class="grap" itemprop="articleBody">
			<?php parseContent($this); ?>
		</div>
        
		<div class="u-flexTop u-xs-flexColumn u-xs-textAlignCenter elevateAuthorCard u-marginBottom30">
			<img src="<?php echo $avatar ?>" class="avatar avatar-128 photo" height="128" width="128">
			<div class="u-marginLeft25 u-xs-marginAuto JiEun">
				<h3><?php $this->author() ?></h3>
				<p><?php $this->options->descript(); ?></p>                
			</div>
		</div>
    </article>

    <?php $this->need('comments.php'); ?>

</div><!-- end #main-->

<?php $this->need('footer.php'); ?>
