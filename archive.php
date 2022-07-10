<?php
/**
* 归档页面
*
* @package archive
*/
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('header.php');
?>


<div class="layoutSingleColumn">
    <div class="u-paddingTop50">
        <?php
            $stat = Typecho_Widget::widget('Widget_Stat');
            Typecho_Widget::widget('Widget_Contents_Post_Recent', 'pageSize='.$stat->publishedPostsNum)->to($archives);
            $year=0; $mon=0; $i=0; $j=0;
            $output = '';
            while($archives->next()){
                $year_tmp = date('Y',$archives->created);
                $mon_tmp = date('m',$archives->created);
                $y=$year; $m=$mon;
                //每年开始
                if ($year_tmp != $year)
                {
                    $output .= '</div>';
                    $output .= '<div class="list list--archive">';
                    $output .= '<h2 class="archive-year JiEun">'.date('Y',$archives->created).'</h2>';
                }
                //每月开始
                if($mon_tmp != $mon)
                {
                    $output .= '</ul>';
                    $output .= '<h3 class="month-title JiEun">'.date('Y - m',$archives->created).'</h3>';
                    $output .= '<ul class="archive-list">';
                }
                //每篇文章
                $output .= '<li class="archive-item"><a class="archive-item-title" href="'.$archives->permalink .'">'. $archives->title 
                .'</a><div class="archive-item-meta JiEun">'.ViewsCounter_Plugin::getViews().' reads / '.$archives->commentsNum.' responses</div></li>'; 
            }
            $output .= '</ul>';
            echo $output;
        ?>
        </div>
	</div>
</div>

<?php $this->need('footer.php'); ?>