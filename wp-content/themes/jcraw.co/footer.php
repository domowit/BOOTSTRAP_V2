<footer role="contentinfo" class="row"> 
<div class="bottom">craw.co 2015 | all rights reserved</div>
</footer>
</div>


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
                $('.menu').slideToggle("3000");
        });
    });
</script>
<?php wp_footer(); ?>
</body></html>