<?php
/**
Template Name: Edge Animate
 */

?>
<!--Adobe Edge Runtime-->
<script>
	var custHtmlRoot="../../../edgeanimate_assets/Site_BG_Site/Assets/"; 
	var script = document.createElement('script'); 
	script.type= "text/javascript";
script.src = "http://animate.adobe.com/runtime/6.0.0/edge.6.0.0.min.js";
	var head = document.getElementsByTagName('head')[0], done=false;
	script.onload = script.onreadystatechange = function(){
		if (!done && (!this.readyState || this.readyState == 'loaded' || this.readyState == 'complete')) {
			done=true;
			var opts ={
    scaleToFit: "width",
    centerStage: "none",
    minW: "0px",
    maxW: "undefined",
    width: "1600px",
    height: "1800px"
};
			opts.htmlRoot =custHtmlRoot;
			AdobeEdge.loadComposition('Site_BG_Site', 'EDGE-95192478', opts,
			{"style":{"${symbolSelector}":{"isStage":"true","rect":["undefined","undefined","1600px","1600px"]}},"dom":{}}, {"dom":{}});		
			script.onload = script.onreadystatechange = null;
			head.removeChild(script);
		}
	};
	head.appendChild(script);
	</script>
<style>
        .edgeLoad-EDGE-95192478 { visibility:hidden; }
    </style>
<!--Adobe Edge Runtime End-->

<div id="Stage" class="EDGE-95192478"></div>
<div id="f" style="z-index:3000">
		
		<h1>craw.co<br>
	is a multidisciplinary<br>
	design studio</h1>
</div>


<div class="clearDiv"></div>