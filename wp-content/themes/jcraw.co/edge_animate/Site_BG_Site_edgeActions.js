/***********************
* Adobe Edge Animate Composition Actions
*
* Edit this file with caution, being careful to preserve 
* function signatures and comments starting with 'Edge' to maintain the 
* ability to interact with these actions from within Adobe Edge Animate
*
***********************/
(function($, Edge, compId){
var Composition = Edge.Composition, Symbol = Edge.Symbol; // aliases for commonly used Edge classes

   //Edge symbol: 'stage'
   (function(symbolName) {
      
      
      Symbol.bindSymbolAction(compId, symbolName, "creationComplete", function(sym, e) {
         sym.$("body").append(sym.$("text2").css({"position":"fixed","width" : "20%"}));// insert code to be run when the symbol is created here
         // Load Edge Commons
         
         
         
         sym.stop();
         
         
         
         yepnope({
         	load: "http://cdn.edgecommons.org/an/1.4.0/js/min/EdgeCommons.js",
         	// Enable Parallax when completely loaded
         	callback: function() {
         		EC.Parallax.setup(sym);
         	}
         });
         
         

      });
      //Edge binding end

      

   })("stage");
   //Edge symbol end:'stage'

   //=========================================================
   
   //Edge symbol: 'Preloader'
   (function(symbolName) {   
   
   })("Preloader");
   //Edge symbol end:'Preloader'

   //=========================================================
   
   //Edge symbol: 'text'
   (function(symbolName) {   
   
   })("text");
   //Edge symbol end:'text'

})(window.jQuery || AdobeEdge.$, AdobeEdge, "EDGE-95192478");