<footer role="contentinfo" class="row"> Footer </footer>
</div>

<!-- NAV BUTTON fade in on scroll 
<script type="text/javascript">
$(window).bind("scroll", function() {
    if ($(this).scrollTop() > 450) {
        $("#nav-toggle").fadeIn();
    } else {
        $("#nav-toggle").stop().fadeOut();
    }
});
</script>--> 

<!-- NAV BUTTON make a burger an X --> 
<script>
document.querySelector("#nav-toggle")
  .addEventListener("click", function() {
    this.classList.toggle("active");
  });
 </script> 
<!-- DROP DAT MENU open menu up --> 
<script>
     $(document).ready(function() {
        $('#nav-toggle').click(function() {
                $('.menu').slideToggle("fast");
        });
    });
</script>
<?php wp_footer(); ?>
</body></html>