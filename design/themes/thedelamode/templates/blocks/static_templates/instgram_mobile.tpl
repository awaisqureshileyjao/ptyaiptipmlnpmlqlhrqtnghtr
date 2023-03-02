
        <div class="slide_dsp ">
        {*<div class="owl-theme ty-owl-controls">
        <div class="owl-controls clickable owl-controls-outside" id="owl_outside_nav_{$block.snapping_id}">
            <div class="owl-buttons">
                <div id="owl_prev_{$block.snapping_id}" class="owl-prev"><i class="ty-icon-left-open-thin"></i></div>
                <div id="owl_next_{$block.snapping_id}" class="owl-next"><i class="ty-icon-right-open-thin"></i></div>
          </div>
      </div>
    </div>*}             
    
        <div id="scroll_list_{$block.snapping_id}" class="owl-carousel owl-carousel-instagram car_id_{$block.snapping_id}">
                <div class="owl-item"><a href="#"><img src="/design/themes/thedelamode/media/images/insta-img1.jpg" alt="insta-img1"></a></div>
                <div class="owl-item"><a href="#"><img src="/design/themes/thedelamode/media/images/insta-img2.jpg" alt="insta-img2"></a></div>
                <div class="owl-item"><a href="#"><img src="/design/themes/thedelamode/media/images/insta-img1.jpg" alt="insta-img1"></a></div>
                <div class="owl-item"><a href="#"><img src="/design/themes/thedelamode/media/images/insta-img2.jpg" alt="insta-img2"></a></div>
                <div class="owl-item"><a href="#"><img src="/design/themes/thedelamode/media/images/insta-img1.jpg" alt="insta-img1"></a></div>
                <div class="owl-item"><a href="#"><img src="/design/themes/thedelamode/media/images/insta-img2.jpg" alt="insta-img2"></a></div>
                <div class="owl-item"><a href="#"><img src="/design/themes/thedelamode/media/images/insta-img1.jpg" alt="insta-img1"></a></div>
                <div class="owl-item"><a href="#"><img src="/design/themes/thedelamode/media/images/insta-img2.jpg" alt="insta-img2"></a></div>   
        </div>
    </div>
    
    
    
    {literal}
<script>
var owl_{/literal}{$block.snapping_id}{literal} = $('.owl-carousel-instagram.car_id_{/literal}{$block.snapping_id}{literal}');
if (owl_{/literal}{$block.snapping_id}{literal}.length) {
  owl_{/literal}{$block.snapping_id}{literal}.owlCarousel({
    margin: 10,
    loop: true,
    slideSpeed: 400,
autoPlay: 3000,// false,
//rewindNav: false,
pagination:true,
stopOnHover: true,
    itemsDesktop : false,
    itemsDesktopSmall : false,
    itemsTablet: [768,2],
    itemsTabletSmall: false,
    itemsMobile : [480,1],
 })
}
    
(function(_, $) {
    $.ceEvent('on', 'ce.commoninit', function(context) {
        var elm = context.find('#scroll_list_{/literal}{$block.snapping_id}{literal}');

        $('.ty-float-left:contains(.ty-scroller-list),.ty-float-right:contains(.ty-scroller-list)').css('width', '100%');

           function outsideNav () {
            if(this.options.items >= this.itemsAmount){
                $("#owl_outside_nav_{/literal}{$block.snapping_id}{literal}").hide();
            } else {
                $("#owl_outside_nav_{/literal}{$block.snapping_id}{literal}").show();
            }
        }
        
        if (elm.length) {
               $('#owl_prev_{/literal}{$block.snapping_id}{literal}').click(function(){
                elm.trigger('owl.prev');
              });
              $('#owl_next_{/literal}{$block.snapping_id}{literal}').click(function(){
                elm.trigger('owl.next');
              });            
        }
    });
}(Tygh, Tygh.$));

</script>

{/literal}