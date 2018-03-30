<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

function themeConfig($form) {
    $siteUrl = Helper::options()->siteUrl;
    $nickname = new Typecho_Widget_Helper_Form_Element_Text('nickname', NULL, '', _t('侧边栏显示的昵称'), _t('显示在头像右侧'));
    $form->addInput($nickname);

    $descript = new Typecho_Widget_Helper_Form_Element_Text('descript', NULL, 'computer loser', _t(' 个人描述'), _t('将显示在侧边栏的昵称下方'));
    $form->addInput($descript);

    //设置图片CDN替换规则     
    $to_replace = new Typecho_Widget_Helper_Form_Element_Text('to_replace', NULL, '', _t('图片CDN替换前地址'), _t('如http://xxx.com'));
    $form->addInput($to_replace);
    $replace_to = new Typecho_Widget_Helper_Form_Element_Text('replace_to', NULL, '', _t('图片替换后地址'),_t('如https://cdn.xxx.com或//cdn.xxx.com'));
    $form->addInput($replace_to);

    //静态资源CDN设置
    $next_cdn = new Typecho_Widget_Helper_Form_Element_Text('next_cdn', NULL, $siteUrl, _t('CDN 镜像地址'), _t('静态文件 CDN 镜像加速地址，加速js和css<br>格式参考：'.$siteUrl.'<br>不用请留空或者保持默认'));
    $form->addInput($next_cdn);
}

function themeInit($archive) {
    if ($archive->is('index')) {
        $archive->parameter->pageSize = 8; // 自定义条数
    }
    if ($archive->is('categoty')) {
        $archive->parameter->pageSize = 1000; // 自定义条数
    }
    if ($archive->is('single')) {
        $archive->text = cdnReplace($archive);
    }
}

//自定义评论
function threadedComments($comments, $singleCommentOptions) {
    $commentClass = '';
    $commentLevelClass = $comments->_levels > 0 ? ' comment-child' : ' comment-parent';
    ?>
    <li class="comment">
			<div id="<?php $comments->theId() ?>" class="comment-block">
					<div class="comment-info u-clearfix">
						<div class="comment-avatar">
                            <?php
                            //头像CDN
                            $host = 'https://cdn.v2ex.com'; //自定义头像CDN服务器
                            $url = '/gravatar/'; //自定义头像目录,一般保持默认即可
                            $size = '32'; //自定义头像大小
                            $rating = Helper::options()->commentsAvatarRating;
                            $hash = md5(strtolower($comments->mail));
                            $avatar = $host . $url . $hash . '?s=' . $size . '&r=' . $rating . '&d=';
                            ?>
                            <img class="avatar" src="<?php echo $avatar ?>" alt="<?php echo $comments->author; ?>" width="<?php echo $size ?>" height="<?php echo $size ?>" />
							
						</div>
						<div class="comment-meta">
							<div class="comment-author"><?php $singleCommentOptions->beforeAuthor();$comments->author();$singleCommentOptions->afterAuthor();?>
									<span class="comment-reply-link u-cursorPointer" ><?php $comments->reply($singleCommentOptions->replyWord);?></span>
							</div>
							<div class="comment-time" itemprop="datePublished">
                                <time class="timeago" datetime="<?php $comments->date('Y-m-d H:i:s');?>" itemprop="datePublished"><?php $comments->date('Y-m-d H:i:s');?></time>
							</div>
						</div>
					</div>
					<div class="comment-content">
						<?php $comments->content();?>
					</div>
			</div>
            <?php if ($comments->children) { ?>
                <ol class="children">
                    <?php $comments->threadedComments($singleCommentOptions);?>
                </ol>
            <?php } ?>
    </li>
    <?php
}

//获取文章首图或首个文件图
function showfimg($cid)
{
		$position = 0;
		$allowimg = 'jpg,bmp,png';//允许的图片格式
		$imgurl = 'http://dearjohn.cn/usr/themes/Bigfa/img/default.jpg';//默认图片地址
        $db = Typecho_Db::get();
        $rs = $db->fetchRow($db->select('table.contents.text')
        ->from('table.contents')
        ->where('table.contents.type = ?', 'attachment')
        ->where('table.contents.parent= ?', $cid)
        ->order('table.contents.cid', Typecho_Db::SORT_ASC)
        ->limit(1)->offset(max(0,intval($position)-1)));
		if(isset($rs['text'])){
			$fimg = unserialize($rs['text']);		
			$imgtype = explode(",",$allowimg );
			if(!in_array ($fimg['type'], $imgtype)) {
				$fimg['path'] = $imgurl;
			}
			return $fimg['path'];
		}else{
			return $imgurl;
		}
}

function getPostCount()
{
    $archives = Typecho_Widget::widget('Widget_Archive');
    // 获取文章数目
    $count = 0;
    while ($archives->next()):
        $count++;
    endwhile;
    return $count;
}

function cdnReplace(Widget_Archive $archive)
{
    $options = Typecho_Widget::widget('Widget_Options');
    $to_replace = $options->to_replace;
    $replace_to = $options->replace_to;
    if(!empty($to_replace)&&!empty($replace_to)){
        foreach($archive->stack as $index=>$con){
            if(array_key_exists('text', $con)){
                $archive->stack[$index]['text'] = str_replace($to_replace, $replace_to, $con['text']);
            }
        }
        reset($archive->stack);
        return str_replace($to_replace, $replace_to, $archive->text);
    }else{
        return $archive->text;
    }
}
