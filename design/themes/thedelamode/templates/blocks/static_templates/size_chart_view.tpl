{if $category_id}
	{if $category_id == 409}
		{__("size_for_men")}
		<div class="container">
			<div class="tabs">	
				<div class="one default">CLOTHING</div>
				<div class="one">SHIRTS</div>
				<div class="one">JEANS</div>
				<div class="one">SHOES</div>
				<div class="one">HATS</div>
				<div class="one">GLOVES</div>
				<div class="one">BELTS</div>
				<div class="one">RINGS</div>				
			</div>
			<div class="clear"></div>
			<div class="tab CLOTHING"><img src="images/size_chart/mens_clothing.png"></div>
			<div class="tab SHIRTS"><img src="images/size_chart/mens_shirts.png"></div>
			<div class="tab JEANS"><img src="images/size_chart/mens_jeans.png"></div>
			<div class="tab SHOES"><img src="images/size_chart/mens_shoes.png"></div>
			<div class="tab HATS"><img src="images/size_chart/mens_hats.png"></div>
			<div class="tab GLOVES"><img src="images/size_chart/mens_gloves.png"></div>
			<div class="tab BELTS"><img src="images/size_chart/mens_belts.png"></div>
			<div class="tab RINGS"><img src="images/size_chart/mens_rings.png"></div>
		</div>		
	{elseif $category_id == 611}
		{__("size_for_women")}
		<div class="container">
			<div class="tabs">	
				<div class="one default">CLOTHING</div>				
				<div class="one">JEANS</div>
				<div class="one">SHOES</div>
				<div class="one">HATS</div>
				<div class="one">GLOVES</div>
				<div class="one">BELTS</div>
				<div class="one">RINGS</div>				
			</div>
			<div class="clear"></div>
			<div class="tab CLOTHING"><img src="images/size_chart/womens_clothing.png"></div>			
			<div class="tab JEANS"><img src="images/size_chart/womens_jeans.png"></div>
			<div class="tab SHOES"><img src="images/size_chart/womens_shoes.png"></div>
			<div class="tab HATS"><img src="images/size_chart/womens_hats.png"></div>
			<div class="tab GLOVES"><img src="images/size_chart/womens_gloves.png"></div>
			<div class="tab BELTS"><img src="images/size_chart/womens_belts.png"></div>
			<div class="tab RINGS"><img src="images/size_chart/womens_rings.png"></div>
		</div>		
	{elseif $category_id == 612}

		{__("size_for_kids")}
		<div class="container hidden-phone hidden-tablet">
			<div class="tabs">	
				<div class="one default">CLOTHING</div>
				<div class="one">SHOES</div>			
				<div class="one">BELTS</div>
				<div class="one">HATS</div>		
				<div class="one">7878787</div>			
			</div>
			<div class="clear"></div>
			<div class="tab CLOTHING"><img src="images/size_chart/kids_clothing21.png"></div>
			<div class="tab SHOES"><img src="images/size_chart/kids_shoes21.png"></div>
			<div class="tab BELTS"><img src="images/size_chart/kids_belt21.png"></div>
			<div class="tab HATS"><img src="images/size_chart/kids_hats21.png"></div>
		</div>{*
		<div class="container hidden-desktop">
			<div class="title">CLOTHING</div>
			<div class="CLOTHING"><img src="images/size_chart/kids_clothing1.png"></div>
			<div class="title">SHOES</div>
			<div class="SHOES"><img src="images/size_chart/kids_shoes1.png"></div>
			<div class="title">BELTS</div>
			<div class="BELTS"><img src="images/size_chart/kids_belt1.png"></div>
			<div class="title">HATS</div>
			<div class="HATS"><img src="images/size_chart/kids_hats1.png"></div>
		</div>	*}		
	{/if}		
{/if}		

{literal}
<script type="text/javascript">
	$(document).ready(function(){
	$(".tab").hide();
	$(".tab").eq(0).show();
	$(".one").eq(0).addClass("active");
	$(".one").click(function(){
		$(".one").removeClass("active");
		$(".tab").hide();		
		var aval=	$(this)[0].innerText;	
		$("."+aval).show();
		$(this).addClass("active");	
	});
});
</script>
<style type="text/css">
.one, .two, .three{float:left; padding:10px 15px; background:#CCC; margin:0px 2px 0 0; cursor:pointer;}
 .two_cont, .three_cont{display:none;}
.clear{clear:both;}
.active{background:#3e3e3e;color: #fff;}	
</style>
{/literal}