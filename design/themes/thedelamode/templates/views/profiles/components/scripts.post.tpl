{literal}
<script type="text/javascript">
		$('.thedelamode_vcomm').parent().addClass('thedelamode_hidden');		
		$('.product_delamode').parent().addClass('thedelamode_products_full');	

		var DateHelper = {
		    addDays : function(aDate, numberOfDays) {
		        aDate.setDate(aDate.getDate() + numberOfDays); // Add numberOfDays
		        return aDate;                                  // Return the date
		    },
		    format : function format(date) {
		        return [
		           ("0" + date.getDate()).slice(-2),           // Get day and pad it with zeroes
		           ("0" + (date.getMonth()+1)).slice(-2),      // Get month and pad it with zeroes
		           date.getFullYear()                          // Get full year
		        ].join('/');                                   // Glue the pieces together
		    }
		}

		var stn_del_date  = DateHelper.format(DateHelper.addDays(new Date(), 7));
		var exp_del_date = DateHelper.format(DateHelper.addDays(new Date(), 5));

	$(document).ready(function(){
				$('.stn_del_tim').html("<b>" + stn_del_date + "</b>");
				$('.exp_del_tim').html("<b>" + exp_del_date + "</b>");		
				
				$('.prod_fet_tit').click(function(){
					$('.product_size_fit .details a').trigger('click');
				});
		$('.subscribe_terms').click(function(){
			$(this).removeClass("cm-hint").addClass("cm-hint-focused");
		});		 
	
		if($(window).width() < 980 ) {
			
			$('.menu-opener').click(function(){
					//$(this).parent().next().toggleClass('search-overlap');			
					//$(this).parent().toggleClass('open-search');
					$('body').toggleClass('delamode');						
				});	
			
			
			$('.search-button.basel-search-full-screen .fa-search').click(function(){
					$(this).parent().next().toggleClass('search-overlap');			
					$(this).parent().toggleClass('open-search');
					$('body').toggleClass('thedelamode');						
				});	
			
			$(".basel-close-search").click(function(){
				if($('.basel-search-wrapper').hasClass('search-overlap')){				
					$('.search-button.basel-search-full-screen .fa-search').trigger('click');
				}
			});  
			$(".open-search").click(function(){
				if($('.basel-search-wrapper').hasClass('search-overlap')){				
					$('.search-button.basel-search-full-screen .fa-search').trigger('click');		
				}
			});
			}
		if($(window).width() < 768 ) {
      $('.filter_display_btn .filter_btn').click(function(){
         //setTimeout(function(){ 
          $('.side-grid.category_filters').toggleClass('show');
          $('body').toggleClass('cat_show');
        //}, 300);
      });

       $('.overlap_cat').click(function(e){   
          $('.filter_display_btn .filter_btn').trigger('click');
       });

       $('.filter_display_btn .filter_btn_blg').click(function(){
       	  $('.blog-side-bar').toggleClass('show');
          $('body').toggleClass('blg_show');        
      });

        $('.overlap_blg').click(function(e){   
          $('.filter_display_btn .filter_btn_blg').trigger('click');
       });

        
        $('.container-fluid.mydesh_b .main-content-grid').parent().addClass('mobile');

        //product_details 
        $('.ty-product-details-image-thumbnail').click(function(){
            var thumb_id = $(this).attr('image_thumb_key');
            $(this).parent().children().removeClass('hidden');
            $(this).addClass('hidden');            
            $(this).parent().prev().children().addClass('hidden').removeClass('active');
            $('.ty-product-details-image.main_' + thumb_id).addClass('active').removeClass('hidden');
        });  

		}
	//	$('.header_menu_section .ty-menu__item .ty-menu__item-link').removeAttr('href');
		
		$('.header_menu_section .ty-menu__item').hover(function() {
		 $(this).parent().children().removeClass('ty-menu__item-active');
		 $(this).addClass('ty-menu__item-active'); // add class when mouseover happen

		 $(this).parent().children().find('.ty-menu__submenu-item-header').removeClass('active');
		 $(this).children().find(`[name='Sale']`).parent().addClass('active');

		});


		/*$('.header_menu_section .ty-menu__item-active .ty-top-mine__submenu-col').hover(function() {
			var abc = $(this).parent().children().find('.ty-menu__submenu-item-header.active').attr('data-id');
			alert(abc);
		});*/

		
		$(".header_menu_section ul.ty-menu__items li:nth-child(2)").addClass('ty-menu__item-active');
		$(".header_menu_section .slide_dsp.category_Womens").removeClass('hidden');

	
		$('.header_menu_section .ty-menu__item-link').click(function(){
		var ID = $(this).attr('data-id');
		$('.header_menu_section .slide_dsp').addClass('hidden');
		$('.cateogry_'+ID).removeClass('hidden'); 

		});

		$('.thedelamode_login_btn.close').click(function(){
			$(this).parents().find('.ui-dialog-titlebar').toggleClass('close');
			$(this).parents().find('.ui-dialog-titlebar').children().find('.ui-icon-closethick').trigger('click');
		});


		$('.thedelamode-cat .breadcrumbs-grid').prepend($('.thedelamode-cat .ty-mainbox-title').html());
		$('.thedelamode-cat h1.ty-mainbox-title').hide();
		$('.contact-us-map').parents().find('.content-grid').addClass('contact-us-page');

		$('.contact-us-page #elm_1').parent().addClass('contact-half-width');
		$('.contact-us-page #elm_10').parent().addClass('contact-half-width phone');

		$('.ty-blog-grid').parents().find('.container-fluid').addClass('blog-thedelamode');		
	
    	$(document).on('click','.thedelamode_register .ty-gdpr-agreement label', function(){
			$('.ty-account .ty-gdpr-agreement input').trigger('click');
		});

		$(document).on('click','.thedelamode_register .ty-login-popup .ty-gdpr-agreement label', function(){			
			$('.ty-account .ty-gdpr-agreement input').trigger('click');
		});




		$('.content-grid.contact-us-page #elm_1').attr("placeholder", "Full name*");
		$('.content-grid.contact-us-page #elm_10').attr("placeholder", "Phone no*");
		$('.content-grid.contact-us-page #elm_2').attr("placeholder", "Email*");
		$('.content-grid.contact-us-page #elm_11').attr("placeholder", "Address");
		$('.content-grid.contact-us-page #elm_7').attr("placeholder", "Subject*");
		$('.content-grid.contact-us-page #elm_3').attr("placeholder", "Type your messages*");

		$('.ty-control-group.ty-product-opt .size_variant').click(function(){
			$(this).parent().children().removeClass('active');
			$(this).addClass('active');

			_id = $(this).attr('data-target');
			$("#"+_id).val($(this).data('val')).trigger('change');
		});


	/*	//$('.ty-top-mine__submenu-col').hover(function(e){
			//e.prevntDefault();
			//$(this).parent().removeClass('open');
			//$(this).addClass('open');
			//$(this).find('.ty-menu__submenu.submenu2.hidden').removeClass('hidden');
		});
*/

	$('.display_more_brand').click(function(){
		$(this).parent().children().removeClass('hidden');
		$(this).addClass('hidden');
	});


  $(document).on('click', '.span4.side-grid.category_filters .ty-product-filters__block .ty-text-links__a1', function(){
   	var cat_id = $(this).parent().attr('id');
   	$('#' + cat_id + ' > a').trigger('click');
  });




	});
</script>
{/literal}

{if $smarty.request.dispatch == 'index.index'}
{literal}
<script type="text/javascript">
	 $(document).ready(function(){ 
		if($(window).width() < 481 ) {
		 	$('.homepage-product .grid-list .ty-column4').slice(2).addClass('hidden');
	 		$('<div class="load_more">Load more</div>').insertAfter('.homepage-product .grid-list');
	 	

		$('.load_more').click(function(){ 	 		
			$('.homepage-product .grid-list .ty-column4').removeClass('hidden');
			//$('<div class="hide_more">Hide more</div>').insertAfter('.homepage-product .grid-list');
			$(this).remove('div');
		});
		}
		$('.home-category-block .ty-subcategories-block__a img').removeAttr('srcset');
	});




</script>
{/literal}
{/if}

//inner pages js start

{literal}
<script>
$(document).ready(function(){
if($(window).width() > 767 ) {
$('.delivery_tabs_contact .nav-tabs .tab').click(function(){
$(this).parent().children().removeClass('active');
$(this).addClass('active');
var t_id = $('.delivery_tabs_contact .nav-tabs .tab.active a').attr('target_id');
$('.delivery_tabs_contact .tabs_panels').addClass('hidden');
$('.delivery_tabs_contact #' + t_id).removeClass('hidden'); 
});
}

if($(window).width() < 768 ) {
$('.delivery_tabs_contact .tabs_panels').addClass('mobile');
$('.delivery_tabs_contact .tabs_panels').click(function(){
//$(this).parent().find('.tabs_panels').addClass('open');
//	$(this).removeClass('hidden');
	$(this).parent().find('.tabs_body').addClass('hidden');
	$(this).find('.tabs_body').removeClass('hidden');
	$(this).parent().find('.tab.heading').removeClass('active');
	$(this).find('.tab.heading').addClass('active');
});
}
});


</script>
{/literal}

{literal}
<script>
$(document).ready(function(){
$(function() {
	var Accordion = function(el, multiple) {
			this.el = el || {};
			this.multiple = multiple || false;
			var links = this.el.find('.article-title');
			links.on('click', {
					el: this.el,
					multiple: this.multiple
			}, this.dropdown)
	}
	Accordion.prototype.dropdown = function(e) {
			var $el = e.data.el;
			$this = $(this),
					$next = $this.next();
			$next.slideToggle();
			$this.parent().toggleClass('open');
			if (!e.data.multiple) {
					$el.find('.accordion-content').not($next).slideUp().parent().removeClass('open');
			};
	}
	var accordion = new Accordion($('.accordion-container'), false);
});
$(document).on('click', function (event) {
if (!$(event.target).closest('#accordion').length) {
$this.parent().toggleClass('open');
}
});
});




$(document).ready(function(){
	 if (window.location.href.indexOf("product_features.view_all") > -1) {       
  var link = window.location.href;
  var data = link.split("#");
  var letter = data[1];  

 /* $(".search_result_"+letter)
  var matchText = function() {
  	 return $(this).text() === letter;
  }*/

  $('html, body').animate({
        scrollTop: $(".search_result_"+letter).offset() ? 
         $(".search_result_"+letter).offset().top : null
   }, 2000);
  $(".search_result_"+letter).css({'color':'red', 'border': '1px solid green','width': '25px','padding': '7px  10px' });
 }
});

</script>
{/literal}

