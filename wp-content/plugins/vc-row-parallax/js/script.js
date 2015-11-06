/*
 * Modernizr touch detection only
 */
if ( typeof( Modernizr ) === 'undefined' ) {
	;window.Modernizr=function(a,b,c){function v(a){i.cssText=a}function w(a,b){return v(l.join(a+";")+(b||""))}function x(a,b){return typeof a===b}function y(a,b){return!!~(""+a).indexOf(b)}function z(a,b,d){for(var e in a){var f=b[a[e]];if(f!==c)return d===!1?a[e]:x(f,"function")?f.bind(d||b):f}return!1}var d="2.8.3",e={},f=b.documentElement,g="modernizr",h=b.createElement(g),i=h.style,j,k={}.toString,l=" -webkit- -moz- -o- -ms- ".split(" "),m={},n={},o={},p=[],q=p.slice,r,s=function(a,c,d,e){var h,i,j,k,l=b.createElement("div"),m=b.body,n=m||b.createElement("body");if(parseInt(d,10))while(d--)j=b.createElement("div"),j.id=e?e[d]:g+(d+1),l.appendChild(j);return h=["&#173;",'<style id="s',g,'">',a,"</style>"].join(""),l.id=g,(m?l:n).innerHTML+=h,n.appendChild(l),m||(n.style.background="",n.style.overflow="hidden",k=f.style.overflow,f.style.overflow="hidden",f.appendChild(n)),i=c(l,a),m?l.parentNode.removeChild(l):(n.parentNode.removeChild(n),f.style.overflow=k),!!i},t={}.hasOwnProperty,u;!x(t,"undefined")&&!x(t.call,"undefined")?u=function(a,b){return t.call(a,b)}:u=function(a,b){return b in a&&x(a.constructor.prototype[b],"undefined")},Function.prototype.bind||(Function.prototype.bind=function(b){var c=this;if(typeof c!="function")throw new TypeError;var d=q.call(arguments,1),e=function(){if(this instanceof e){var a=function(){};a.prototype=c.prototype;var f=new a,g=c.apply(f,d.concat(q.call(arguments)));return Object(g)===g?g:f}return c.apply(b,d.concat(q.call(arguments)))};return e}),m.touch=function(){var c;return"ontouchstart"in a||a.DocumentTouch&&b instanceof DocumentTouch?c=!0:s(["@media (",l.join("touch-enabled),("),g,")","{#modernizr{top:9px;position:absolute}}"].join(""),function(a){c=a.offsetTop===9}),c};for(var A in m)u(m,A)&&(r=A.toLowerCase(),e[r]=m[A](),p.push((e[r]?"":"no-")+r));return e.addTest=function(a,b){if(typeof a=="object")for(var d in a)u(a,d)&&e.addTest(d,a[d]);else{a=a.toLowerCase();if(e[a]!==c)return e;b=typeof b=="function"?b():b,typeof enableClasses!="undefined"&&enableClasses&&(f.className+=" "+(b?"":"no-")+a),e[a]=b}return e},v(""),h=j=null,e._version=d,e._prefixes=l,e.testStyles=s,e}(this,this.document);
}


jQuery(document).ready(function($) {
	"use strict";


	/*
	 * Remove video background in mobile devices.
	 */

	// Remove completely for mobile
	function _isMobile() {
		return ( Modernizr.touch && jQuery(window).width() <= 1000 ) || // touch device estimate
	 	 	   ( window.screen.width <= 1281 && window.devicePixelRatio > 1 ); // device size estimate
	}
	if ( _isMobile() ) {
		$('.bg-parallax [id^=video-]').remove();
	}


	/*
	 * SMOOTH SCROLL
	 */


    if ( $('.gambit_parallax_enable_smooth_scroll').length > 0 ) {
        if ( typeof $.easing.easeOutQuint === 'undefined' ) {
            $.extend(jQuery.easing, {
                easeOutQuint: function(x, t, b, c, d) {
                    return c * ((t = t / d - 1) * t * t * t * t + 1) + b;
                }
            });
        }

        var wheel = false,
            $docH = $(document).height() - $(window).height(),
            $scrollTop = $(window).scrollTop();

        $(window).bind('scroll', function() {
            if (wheel === false) {
                $scrollTop = $(this).scrollTop();
            }
        });
        $(document).bind('DOMMouseScroll mousewheel', function(e, delta) {
            delta = delta || -e.originalEvent.detail / 3 || e.originalEvent.wheelDelta / 120;
            wheel = true;

            $scrollTop = Math.min($docH, Math.max(0, parseInt($scrollTop - delta * 120)));
            $(navigator.userAgent.indexOf('AppleWebKit') !== -1 ? 'body' : 'html').stop().animate({
                scrollTop: $scrollTop + 'px'
            }, 1600, 'easeOutQuint', function() {
                wheel = false;
            });
            return false;
        });
    }


	/*
	 * Initialize Rowspans
	 */


	$('div.bg-parallax').each(function() {
		if ( typeof $(this).attr('data-row-span') === 'undefined' ) {
			return;
		}
		var rowSpan = parseInt( $(this).attr('data-row-span') );
		if ( isNaN( rowSpan ) ) {
			return;
		}
		if ( rowSpan === 0 ) {
			return;
		}

		var $nextRows = $(this).nextAll('.wpb_row');
		$nextRows.splice(0,1);
		$nextRows.splice(rowSpan);

		// Clear stylings for the next rows that our parallax will occupy
		$nextRows.each(function() {
			if ( $(this).prev().is('.bg-parallax') ) {
				$(this).prev().remove();
			}
			// we need to apply this class to make the row children visible
			$(this).addClass('bg-parallax-parent')
			// we need to clear the row background to make the parallax visible
			.css( {
				'backgroundImage': '',
				'backgroundColor': 'transparent'
			} );

            var otherStyles = '';
            if ( typeof $(this).attr('style') !== 'undefined' ) {
                otherStyles = $(this).attr('style') + ';';
            }

            // Fix for VC adding !important styles that we can't override
            $(this).attr('style', otherStyles + 'background-image: none !important; background-color: transparent !important;');
		});
	});


	/*
	 * Initialize parallax
	 */


	$('div.bg-parallax').each(function() {
		var $row = $(this).next();
		if ( $row.css( 'backgroundSize' ) === 'contain' ) {
			$row.css( 'backgroundSize', 'cover' );
		}
		$(this).css( {
			'backgroundImage': $row.css( 'backgroundImage' ),
			'backgroundRepeat': $row.css( 'backgroundRepeat' ),
			'backgroundSize': $row.css( 'backgroundSize' ),
            'backgroundColor': $row.css( 'backgroundColor' )
		} )
		.prependTo( $row.addClass('bg-parallax-parent') )
		.scrolly2();//.trigger('scroll');
		$row.css( {
			'backgroundImage': '',
			'backgroundRepeat': '',
			'backgroundSize': '',
			'backgroundColor': ''
		});

        var otherRowStyles = '';
        if ( typeof $row.attr('style') !== 'undefined' ) {
            otherRowStyles = $row.attr('style') + ';';
        }

        // Fix for VC adding !important styles that we can't override
        $row.attr('style', otherRowStyles + 'background-image: none !important; background-color: transparent !important;');

		if ( $(this).attr('data-direction') === 'up' || $(this).attr('data-direction') === 'down' ) {
			$(this).css( 'backgroundAttachment', 'fixed' );
		}
	});


	$(window).resize( function() {
		setTimeout( function() {
			var $ = jQuery;
		// Break container
		$('div.bg-parallax').each(function() {
			if ( typeof $(this).attr('data-break-parents') === 'undefined' ) {
				return;
			}
			var breakNum = parseInt( $(this).attr('data-break-parents') );
			if ( isNaN( breakNum ) ) {
				return;
			}

			var $immediateParent = $(this).parent();

			// Find the parent we're breaking away to
			var $parent = $immediateParent;
			for ( var i = 0; i < breakNum; i++ ) {
				if ( $parent.is('html') ) {
					break;
				}
				$parent = $parent.parent();
			}

			// Compute dimensions & location
			var parentWidth = $parent.width() +
				              parseInt( $parent.css('paddingLeft') ) +
				              parseInt( $parent.css('paddingRight') );
			var left = - ( $immediateParent.offset().left - $parent.offset().left );
			if ( left > 0 ) {
				left = 0;
			}

			$(this).addClass('broke-out')
			.css({
				'width': parentWidth,
				'left': left
			})
			.parent().addClass('broke-out');

			$(document).trigger('scroll');
		});


		/*
		 * multiple rows
		 */


		$('div.bg-parallax').each(function() {
			if ( typeof $(this).attr('data-row-span') === 'undefined' ) {
				return;
			}
			var rowSpan = parseInt( $(this).attr('data-row-span') );
			if ( isNaN( rowSpan ) ) {
				return;
			}
			if ( rowSpan === 0 ) {
				return;
			}

            var $current = $(this).parent('.wpb_row');

			var $nextRows = $(this).parent('.wpb_row').nextAll('.wpb_row');
			$nextRows.splice(rowSpan);

			// Clear stylings for the next rows that our parallax will occupy
			var heightToAdd = 0;
            heightToAdd += parseInt($current.css('marginBottom'));
			$nextRows.each(function() {
				heightToAdd += $(this).height() +
					           parseInt($(this).css('paddingTop')) +
					           parseInt($(this).css('paddingBottom')) +
					           parseInt($(this).css('marginTop'));
			});
			$(this).css( 'height', 'calc(100% + ' + heightToAdd + 'px)' );
		});

		$(document).trigger('scroll');
		}, 1 );
	});

	jQuery(window).trigger('resize');
});