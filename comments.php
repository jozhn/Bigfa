<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>

<?php
function threadedComments($comments, $options) {
    $commentClass = '';
    if ($comments->authorId) {
        if ($comments->authorId == $comments->ownerId) {
            $commentClass .= ' comment-by-author';
        } else {
            $commentClass .= ' comment-by-user';
        }
    }

    $commentLevelClass = $comments->levels > 0 ? ' comment-child' : ' comment-parent';
    $depth = $comments->levels +1;

    if ($comments->url) {
        $author = '<a href="' . $comments->url . '"target="_blank"' . ' rel="external nofollow">' . $comments->author . '</a>';
    } else {
        $author = $comments->author;
    }
?>

<li id="li-<?php $comments->theId(); ?>" class="comment comment-body<?php
if ($depth > 1 && $depth < 3) {
    echo ' children ';
    $comments->levelsAlt('comment-level-odd', ' comment-level-even');
}
else if( $depth > 2){
    echo ' comment-child2';
    $comments->levelsAlt(' comment-level-odd', ' comment-level-even');
}
else {
    echo ' comment-parent';
}

$comments->alt(' comment-odd', ' comment-even');
?>">
    <div id="<?php $comments->theId(); ?>">
        <?php
            $host = 'https://secure.gravatar.com';
            $url = '/avatar/';
            $size = '80';
            $default = 'mm';
            $rating = Helper::options()->commentsAvatarRating;
            $hash = md5(strtolower($comments->mail));
            $avatar = $host . $url . $hash . '?s=' . $size . '&r=' . $rating . '&d=' . $default;
        ?>
        <div class="comment-block" onclick="">
            <div class="comment-info u-flex">
				<div class="comment-avatar u-flex0">
					<img class="avatar" src="<?php echo $avatar ?>" width="<?php echo $size ?>" height="<?php echo $size ?>" />
               </div>
				<div class="comment-meta u-flex1 u-flexColumn">
					<div class="comment-author" itemprop="author">
						<a href="" rel="external nofollow" class="url"><?php echo $author; ?></a>
						<span class="comment-reply-link u-cursorPointer"><?php $comments->reply('回复'); ?></span>
					</div>
					<div class="comment-time" itemprop="datePublished" datetime="<?php $comments->date(); ?>"><?php $comments->date('M j, Y'); ?></div>
				</div>
            </div>
            <div class="comment-content" itemprop="description">
                <?php echo getCommentAt($comments->coid) ?><?php $comments->content(); ?>
            </div>
        </div>
    </div>
    <?php if ($comments->children) { ?>
        <div class="comment">
            <?php $comments->threadedComments($options); ?>
        </div>
    <?php } ?>
</li>
<?php } ?>

<div id="comments">
    <?php $this->comments()->to($comments); ?>
    <?php if ($comments->have()): ?>
    <h3 class="responses-title"><?php $this->commentsNum(_t('Comments : %d ')); ?></h3>
    
    <?php $comments->listComments(); ?>

	<div class="lists-navigator clearfix">
    <?php $comments->pageNav('←','→','2','...'); ?>
	</div>
    
    <?php endif; ?>

    <?php if($this->allow('comment')): ?>
    <div id="<?php $this->respondId(); ?>" class="respond">
    
        <h3 id="response" class="comments-title"><?php _e('发表留言'); ?></h3>

        <form method="post" action="<?php $this->commentUrl() ?>" id="comment-form" class="responsesForm" role="form">
            <p class="comment-note">人生在世，错别字在所难免，无需纠正。</p>
            <?php if($this->user->hasLogin()): ?>
            <p><?php _e('登录身份: '); ?><a href="<?php $this->options->profileUrl(); ?>"><?php $this->user->screenName(); ?></a>. <a href="<?php $this->options->logoutUrl(); ?>" title="Logout"><?php _e('退出'); ?> &raquo;</a></p>
            <?php else: ?>
            <p  class="comment-form-author comment-form-input">
                <label for="author"><?php _e('称呼'); ?></label>
                <input type="text" name="author" id="author" class="inputGroup" value="<?php $this->remember('author'); ?>" required />
            </p>
            <p  class="comment-form-email comment-form-input">
                <label for="mail"<?php if ($this->options->commentsRequireMail): ?><?php endif; ?>><?php _e('Email'); ?></label>
                <input type="text" name="mail" id="mail" class="inputGroup" value="<?php $this->remember('mail'); ?>"<?php if ($this->options->commentsRequireMail): ?> required<?php endif; ?> />
            </p>
            <p  class="comment-form-url comment-form-input">
                <label for="url"<?php if ($this->options->commentsRequireURL): ?><?php endif; ?>><?php _e('网站'); ?></label>
                <input type="text" name="url" id="url" class="inputGroup" placeholder="<?php _e('http://'); ?>" value="<?php $this->remember('url'); ?>"<?php if ($this->options->commentsRequireURL): ?> required<?php endif; ?> />
            </p>
            <?php endif; ?>
            <p class="comment-form-comment comment-form-input">
                <label for="textarea"><?php _e('内容'); ?></label>
                <textarea rows="8" cols="50" name="text" id="comment" class="inputGroup inputTextarea" required ><?php $this->remember('text'); ?></textarea>
            </p>
            <p class="form-submit">
                <button type="submit" id="submit" class="inputSubmit">Post Comment</button><?php $comments->cancelReply(); ?>
            </p>
			
        </form>
    </div>
    <?php else: ?>
    <h3><?php _e('评论已关闭'); ?></h3>
    <?php endif; ?>
</div>


