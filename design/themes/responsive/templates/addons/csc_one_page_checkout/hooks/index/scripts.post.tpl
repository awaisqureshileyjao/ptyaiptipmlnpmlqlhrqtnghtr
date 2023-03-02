{if $runtime.controller=="checkout" && $runtime.mode=="checkout"}
	<script>
		var opc_langvar_find_my_address = '{__("opc.find_my_address")}';
		var opc_langvar_apply_location = '{__("opc.apply_location")}';
		var opc_map_title = '{__("opc.map_title")}';
		
	</script>
    {script src="js/addons/csc_one_page_checkout/jquery.tbwfields.min.js"}
    {script src="js/addons/csc_one_page_checkout/jquery.maskedinput.min.js"}
    {script src="js/addons/csc_one_page_checkout/func.js"}
    {script src="js/addons/csc_one_page_checkout/geolocation.js"}
    
    {if $addons.csc_one_page_checkout.provider!="none" && $addons.csc_one_page_checkout.api_key}
        <script>
            var opc_api_key = '{$addons.csc_one_page_checkout.api_key}';
            var location_fields = '{$location_fields|json_encode nofilter}';
			console.log('{$addons.csc_one_page_checkout.provider}');        
        </script>
        {assign var=provider value = $addons.csc_one_page_checkout.provider}                  
        {script src="js/addons/csc_one_page_checkout/providers/`$provider`.js"}        
    {elseif $addons.rus_cities.status=="A"}
        {script src="js/addons/csc_one_page_checkout/rus_cities_func.js"}
    {/if}
    
    {if !$provider || !$addons.csc_one_page_checkout.api_key} 
         <script> 
        	var cscAutocompleteFunction='fn_csc_copc_return';			
			function fn_csc_copc_return(){
				return true;
			}
		</script>
     {/if}     
    
    {if !$provider || $provider!='google' && $addons.csc_one_page_checkout.google_geolocation_api_key && ($addons.csc_one_page_checkout.show_geoautofill=="Y" || $addons.csc_one_page_checkout.show_openmap=="Y")}
    	<script src="https://maps.googleapis.com/maps/api/js?key={$addons.csc_one_page_checkout.google_geolocation_api_key}&libraries=places&language={$smarty.const.CART_LANGUAGE}"	async defer></script>
    {/if}
    
    <script type="text/javascript">
    (function(_, $){
        $.ceEvent('on', 'ce.commoninit', function(context) {
            $('#copc_one_page_checkout .ty-control-group input.ty-input-text:visible').tbwField();
            {if $addons.csc_one_page_checkout.phone_mask_template}
                setTimeout(function(){
                    $(".copc-cm-phone input").attr("type", "tel");
                    $(".copc-cm-phone .tbwfields-input input").mask("{$addons.csc_one_page_checkout.phone_mask_template}");		
                }, 20);
            {/if}
        });
    })(Tygh, Tygh.$);
    $(document).on('click', 'input[name="ship_to_another"]', function(){
        setTimeout(function(){
          $('#copc_one_page_checkout .ty-control-group input.ty-input-text:visible').tbwField();          
          {if $addons.csc_one_page_checkout.phone_mask_template}
            setTimeout(function(){
                $(".copc-cm-phone .tbwfields-input input").mask("{$addons.csc_one_page_checkout.phone_mask_template}");
            }, 20);
          {/if}
        }, 20);
    });
    
    </script>    
{/if}
    
