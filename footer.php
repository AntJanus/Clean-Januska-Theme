<div id="footerBgr">
</div>
<footer>
<div id="innerFooter">
<div class="one_third">
	<?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar('footerLeft') ) : else : ?>

			<?php endif; ?>
</div>
<div class="one_third">

     		<?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar('footerMid') ) : else : ?>

			<?php endif; ?>
</div>
<div class="one_third last">

				<?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar('footerRight') ) : else : ?>



				<?php endif; ?>
</div>
<div class="clearboth"></div>

</div>
</footer>
<?php wp_footer();?>

</body>
</html>