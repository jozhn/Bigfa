<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

function themeConfig($form) {
    $siteUrl = Helper::options()->siteUrl;
	
	//昵称
    $nickname = new Typecho_Widget_Helper_Form_Element_Text('nickname', NULL, '', _t('侧边栏显示的昵称'), _t('显示在头像右侧'));
    $form->addInput($nickname);
	
	//头像
    $avatarUrl = new Typecho_Widget_Helper_Form_Element_Text('avatarUrl', NULL, '', _t('首页头像地址'), _t('将显示在首页侧边栏,如/usr/themes/Bigfa/img/head.jpg 或 https://xxx.com/xxx.jpg'));
    $form->addInput($avatarUrl);
	
	//个人描述
    $descript = new Typecho_Widget_Helper_Form_Element_Text('descript', NULL, 'computer loser', _t(' 个人描述'), _t('将显示在侧边栏的昵称下方'));
    $form->addInput($descript);
	
	//网站logo
    $logoUrl = new Typecho_Widget_Helper_Form_Element_Text('logoUrl', NULL, '', _t('网站Logo地址'), _t('将显示在网站左上角'));
    $form->addInput($logoUrl);
	
	//文章默认缩略图
	$thumUrl = new Typecho_Widget_Helper_Form_Element_Text('thumUrl', NULL, '', _t('文章默认缩略图地址'), _t('侧边栏文章默认缩略图地址'));
    $form->addInput($thumUrl);
	
    //设置图片CDN替换规则
    $to_replace = new Typecho_Widget_Helper_Form_Element_Text('to_replace', NULL, '', _t('图片CDN替换前地址'), _t('如http://xxx.com'));
    $form->addInput($to_replace);
    $replace_to = new Typecho_Widget_Helper_Form_Element_Text('replace_to', NULL, '', _t('图片替换后地址'),_t('如https://cdn.xxx.com或//cdn.xxx.com'));
    $form->addInput($replace_to);
	
    //静态资源CDN设置
    $next_cdn = new Typecho_Widget_Helper_Form_Element_Text('next_cdn', NULL, $siteUrl, _t('CDN 镜像地址'), _t('静态文件 CDN 镜像加速地址，加速js和css<br>格式参考：'.$siteUrl.'<br>不用请留空或者保持默认'));
    $form->addInput($next_cdn);
	
	//Highlightjs
    $highlightjs = new Typecho_Widget_Helper_Form_Element_Radio('highlightjs',
        array('able' => _t('启用'),
            'disable' => _t('禁止'),
        ),
        'able', _t('Highlightjs代码高亮设置'), _t('默认启用'));
    $form->addInput($highlightjs);
	
	//开启APlayer
    $aplayer = new Typecho_Widget_Helper_Form_Element_Radio('aplayer',
        array('able' => _t('启用'),
            'disable' => _t('禁止'),
        ),
        'disable', _t('APlayer设置'), _t('默认禁止，若启用请先安装APlayer插件Meting版'));
    $form->addInput($aplayer);
	
	//开启Valine
    $valine = new Typecho_Widget_Helper_Form_Element_Radio('valine',
        array('able' => _t('启用'),
            'disable' => _t('禁止'),
        ),
        'disable', _t('Valine设置'), _t('默认禁止，若启用请先安装Valine.js'));
    $form->addInput($valine);
	
	//备案号
	$beian = new Typecho_Widget_Helper_Form_Element_Text('beian', NULL, $siteUrl, _t('备案号'), _t('填写备案号'));
    $form->addInput($beian);
	
	//统计代码
	$Analytics = new Typecho_Widget_Helper_Form_Element_Textarea('Analytics', NULL, NULL, _t('统计代码'), _t('填写你从谷歌Analytics或百度统计获取到的代码，需要script标签'));
    $form->addInput($Analytics);
}

function themeInit($archive) {
    if ($archive->is('index')) {
        $archive->parameter->pageSize = 8; // 自定义条数
    }
    if ($archive->is('categoty')) {
        $archive->parameter->pageSize = 1000; // 自定义条数
    }
}

function parseContent($obj){
    $options = Typecho_Widget::widget('Widget_Options');
    $obj->content = preg_replace("/<a href=\"([^\"]*)\">/i", "<a href=\"\\1\" target=\"_blank\">", $obj->content);
    echo trim($obj->content);
}

function thumb($cid,$isIndex) {
	$options = Typecho_Widget::widget('Widget_Options');
	if (empty($imgurl)) {
		if(!empty($options->thumUrl) && $options->thumUrl)
			$imgurl = $options->thumUrl;
		else
			$imgurl = 'https://img.dearjohn.cn/usr/themes/Bigfa/img/default.jpg';
	}
	 $db = Typecho_Db::get();
	 $rs = $db->fetchRow($db->select('table.contents.text')
		->from('table.contents')
		->where('table.contents.type = ?', 'attachment')
		->where('table.contents.parent= ?', $cid)
		->order('table.contents.cid', Typecho_Db::SORT_ASC)
		->limit(1));
	if(isset($rs['text'])){
		$img = unserialize($rs['text']);
		return $options->next_cdn . $img['path'];
	}else{
		if(!$isIndex)
			return $imgurl;
		else
			return null;
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

function is_mobile()
{
    $user_agent     = $_SERVER['HTTP_USER_AGENT'];
    $mobile_browser = array(
        "mqqbrowser", //手机QQ浏览器
        "opera mobi", //手机opera
        "juc", "iuc", //uc浏览器
        "fennec", "ios", "applewebKit/420", "applewebkit/525", "applewebkit/532", "ipad", "iphone", "ipaq", "ipod",
        "iemobile", "windows ce", //windows phone
        "240x320", "480x640", "acer", "android", "anywhereyougo.com", "asus", "audio", "blackberry",
        "blazer", "coolpad", "dopod", "etouch", "hitachi", "htc", "huawei", "jbrowser", "lenovo",
        "lg", "lg-", "lge-", "lge", "mobi", "moto", "nokia", "phone", "samsung", "sony",
        "symbian", "tablet", "tianyu", "wap", "xda", "xde", "zte",
    );
    $is_mobile = false;
    foreach ($mobile_browser as $device) {
        if (stristr($user_agent, $device)) {
            $is_mobile = true;
            break;
        }
    }
    return $is_mobile;
}


function getCommentAt($coid){
    $db   = Typecho_Db::get();
    $prow = $db->fetchRow($db->select('parent')
        ->from('table.comments')
        ->where('coid = ? AND status = ?', $coid, 'approved'));
    $parent = $prow['parent'];
    if ($parent != "0") {
        $arow = $db->fetchRow($db->select('author')
            ->from('table.comments')
            ->where('coid = ? AND status = ?', $parent, 'approved'));
        $author = $arow['author'];
        $href   = '<a href="#comment-'.$parent.'" class="cute atreply">@'.$author.'</a>';
        //$href = '@'.$author;
        return $href;
    } else {
        return '';
    }
}

function getAvatar($size){
	$host = 'https://secure.gravatar.com';
	$url = '/avatar/';
	$default = 'mm';
	$rating = Helper::options()->commentsAvatarRating;
	$hash = md5(strtolower($comments->mail));
	$avatar = $host . $url . $hash . '?s=' . $size . '&r=' . $rating . '&d=' . $default;
}