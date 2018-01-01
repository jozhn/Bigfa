<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>

<?php if ($this->is('index')) : ?>
   <footer class="layoutSingleColumn layoutSingleColumn--wide footer" role="contentinfo"> 
    <div class="site-info"> 
     <p>blog since 2015.&nbsp;&nbsp;&nbsp;&nbsp; Theme <a href="https://github.com/jozhn/Bigfa" target="_blank">Bigfa</a> 
		by <a href="https://dearjohn.cn" target="_blank"><span class="cute">John</span></a>.&nbsp;&nbsp;&nbsp;&nbsp; 
		CDN by <a href="https://console.upyun.com/register/?invite=rJoBowTv-" target="_blank"><span class="cute">又拍云</span></a>
		&nbsp;&nbsp;&nbsp;&nbsp;苏ICP备17008143号</p>
    </div>
   </footer> 
<?php else: ?>
<footer class="footer--empty"></footer>
<?php endif; ?>


  </div> <!-- 对应site-main surface-container -->
<div class="loadingBar"></div>



<?php $this->footer(); ?>

    <script src="https://cdn.bootcss.com/instantclick/3.0.0/instantclick.min.js" data-no-instant></script>
    <script data-no-instant>
      InstantClick.on('change', function(isInitialLoad) {
        jQuery("time.timeago").timeago();
        if (typeof Prism !== 'undefined'){
          Prism.highlightAll(true,null);
        }
      });
      InstantClick.init('mousedown');
    </script>

</body>
</html>
