<footer>
				<?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar('footer') ) : else : ?>

				<?php endif; ?>
<div id="copyrightInfo">&copy; 2011 Antonin Januska | <?php wp_nav_menu( array('menu' => 'footer', 'container'       => '',  )); ?></div>

</footer>
<?php wp_footer();?>

</body>
</html>