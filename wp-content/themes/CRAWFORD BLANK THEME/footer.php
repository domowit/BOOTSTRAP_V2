<footer role="contentinfo" class="row">
	
		Footer
	
	</footer>

</div>


<!-- HEADHESIVE.JS http://markgoodyear.com/2014/04/create-an-on-demand-sticky-header-with-headhesive-js/-->
<script src="<?php bloginfo('stylesheet_directory') ?>/js/js_headesive/headhesive.js"></script>

<script>

        // Set options
        var options = {
            offset: '#startHeadhesive',
            classes: {
                clone:   'banner--clone',
                stick:   'banner--stick',
                unstick: 'banner--unstick'
            }
        };

        // Initialise with options
        var banner = new Headhesive('.banner', options);

        // Headhesive destroy
        // banner.destroy();
    </script>
<!--END JS-->


<?php wp_footer(); ?>

</body>
</html>