<?php
/**
* 分类合集页面
*
* @package custom
*/
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('header.php');
?>

<div class="list--collection layoutSingleColumn">
	<?php $this->widget('Widget_Metas_Category_List')->to($categorys);?>
    <?php if ($categorys->have()): ?>
    <?php while($categorys->next()): ?>
    <div class="list list--borderedBottom">
        <a class="listItem u-flex" href="<?php $categorys->permalink();?>">
            <img class="list-avatar u-flex0" src="<?php $this->options->themeUrl('img/category/');?><?php echo $categorys->slug().'.jpg'; ?>" width="40" height="40">
            <div class="list-meta u-flex1"> 
	            <div class="list-title"><?php $categorys->name();?></div>
	            <div class="list-description"><?php echo $categorys->description(); ?></div>
            </div>
        </a>
    </div>
    <?php endwhile; ?>
    <?php endif; ?>
</div>

<?php $this->need('footer.php'); ?>