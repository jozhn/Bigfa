<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>

    <div class="layoutMultiColumn layoutMultiColumn--secondary"> 
     <div class="u-paddingTop50"> 
	 
      <div class="widget"> 
       <div class="heading-title">
        关于博主
       </div> 
       <div class="widget-card"> 
        <div class="widget-card-imageWrapper"> 
         <a href=" " data-action="imageZoomIn"><img src="<?php echo $this->options->avatarUrl; ?>" class="avatar" width="32" height="32" /></a> 
        </div> 
        <div class="widget-card-content">
        <?php $this->options->nickname(); ?>
        </div> 
        <div class="widget-card-description"> 
         <p><?php $this->options->descript(); ?></p> 
         <p class="cute"><a href="<?php $this->options->siteUrl('/about'); ?>">了解更多</a></p>
        </div> 
       </div> 
      </div>

      <div class="widget"> 
       <div class="heading-title">
        Posts
       </div> 
       <ul class="list--withIcon list"> 

		<?php foreach (ViewsCounter_Plugin::getMostViewed() as $post): ?>
		<li class="list-item">
			<div class="list-itemImage">
				<img class="image--outlined" src="<?php echo thumb($post['cid'],0);?>"/>
			</div>
			<div class="list-itemInfo">
				<h4 class="list-itemTitle">
					<a href="<?php echo $post['permalink'];?>"><?php echo $post['title'];?></a>
				</h4>
				<p class="list-itemDescription JiEun">
					<?php echo $post['categories'][0]['name'];?>
					<span class="middotDivider"></span>
					<?php echo $post['commentsNum'];?> replies
				</p>
			</div>
		 </li>
		<?php endforeach; ?>

       </ul>
      </div> 
     </div> 
    </div>
