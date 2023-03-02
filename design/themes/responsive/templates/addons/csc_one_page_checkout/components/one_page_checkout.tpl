{include file="views/profiles/components/profiles_scripts.tpl"}
{include file="addons/csc_one_page_checkout/components/gmap_location.tpl"}

<div class="checkout-steps cm-save-fields clearfix cs-one-page-checkout {if $addons.csc_one_page_checkout.shipping_and_address_in_one_row=="Y"}copc_shipping_and_address_in_one_row{/if}" id="checkout_steps">
{if $addons.csc_one_page_checkout.hide_auth=="N"}
	{if version_compare($smarty.const.PRODUCT_VERSION, '4.10.1', '<')}
		{if $cart.edit_step == "step_one"}
			{$display_steps.step_one="Y"}
			{$edit = $cart.edit_step == "step_one"}
			{$number_of_step = $number_of_step + 1}			
		{/if}
		{if $edit}
			{$contact_info_population=false}    	
		{else}
			{$contact_info_population=true}
		{/if}
        {include file="views/checkout/components/steps/step_one.tpl" step="one" complete=$completed_steps.step_one edit=$edit but_text=__("continue") contact_info_population=$contact_info_population contact_fields_filled=true}
	{else}
		{assign var="return_current_url" value=$config.current_url|escape:url}
		<div class="opc_logins_block">
		{if !$auth.user_id}		
			{__('opc.you_not_logged')}
				<a href="{"auth.login_form?return_url=`$return_current_url`"|fn_url}" data-ca-target-id="opc_checkout_login_block{$block.snapping_id}" class="cm-dialog-opener cm-dialog-auto-size " rel="nofollow">{__("sign_in")}</a>{__('opc.to_continue_as_logged')}
				

			<div  id="opc_checkout_login_block{$block.snapping_id}" class="hidden" title="{__("sign_in")}">
				<div class="ty-login-popup">
					{include file="views/auth/login_form.tpl" style="popup" id="popup`$block.snapping_id`"}
				</div>
			</div>	
		{else}
			{__('opc.you_allready_logged_as')} {if $user_info.firstname || $user_info.lastname}{$user_info.firstname} {$user_info.lastname}{else}{$user_info.email}{/if}. <a href="{"auth.change_login"|fn_url}">{__('opc.click_this_link_to_relogin')}</a>

		{/if}
		</div>	

	{/if}
{/if}

{if $cart.edit_step != "step_one"}
    {capture name="one_step_block"}
        <div id="copc_one_page_checkout">
            <form action="{""|fn_url}" method="post" class=" cm-checkout-recalculate-form csc_main_form">
            <input type="hidden" name="result_ids" value="checkout*,account*" />
            <input type="hidden" name="dispatch" value="checkout.checkout" />
            
            {if $addons.csc_one_page_checkout.divide_location_fields=="Y" && $profile_fields.L}           
				<div class="csc_location_block">    
				{include file="addons/csc_one_page_checkout/components/steps/step_location.tpl" step="two" complete=false edit=true but_text=__("continue") title=__('copc.select_location')}
				</div>            
            {/if}
            
            {if $addons.csc_one_page_checkout.shipping_and_address_in_one_row=="Y"}
            <div class="shipping_and_address_in_one_row_content">
            {/if}
            
            
            {if $addons.csc_one_page_checkout.hide_shippings!="Y"}
                 <div class="csc_shippings_block">
                {include file="addons/csc_one_page_checkout/components/steps/step_three.tpl" step="three" complete=false edit=true but_text=__("continue")} 
                </div>
            {/if}
               
           
            <div class="csc_delivery_block">
            	 {if !$cart.shipping_failed || $addons.csc_one_page_checkout.divide_location_fields=="N" || ($addons.csc_one_page_checkout.provider!="none" && $addons.csc_one_page_checkout.api_key)}
                    {include file="addons/csc_one_page_checkout/components/steps/step_two.tpl" step="two" complete=false edit=true but_text=__("continue")  title=__('csc.shipping_info')}
                    {include file="views/checkout/components/customer_notes.tpl"}
                {else}
                	{include file="common/subheader.tpl" title=__("csc.shipping_info")}
                    <div class="checkout__block"> 
                    <p class="ty-error-text">{__("copc.select_location")}</p>
                    </div>
                
                {/if}
            </div>
             
             
             {if $addons.csc_one_page_checkout.shipping_and_address_in_one_row=="Y" && $addons.csc_one_page_checkout.hide_shippings!="Y"}
             </div>
             {/if}
                
            {if !$cart.shipping_failed}   
                {if $addons.csc_one_page_checkout.hide_payments!="Y"}
                     <div class="csc_payments_block">
                    {include file="addons/csc_one_page_checkout/components/steps/step_four.tpl" step="four" complete=false edit=true but_text=__("continue")}
                    </div>
                {else}
                     {include file="addons/csc_one_page_checkout/components/final_section.tpl" is_payment_step=true}
                     <div class="ty-checkout-buttons">
                        {include file="buttons/place_order.tpl" but_text=__("submit_my_order") but_name="dispatch[checkout.place_order]" but_id="place_order"}
                    </div>
                
                {/if}
            {/if}
				
			{if $addons.csc_one_page_checkout.shipping_and_address_in_one_row=="Y" && $addons.csc_one_page_checkout.hide_shippings=="Y"}
             </div>
            {/if}
				
            </form>
        <!--copc_one_page_checkout--></div>
    {/capture}
    {'cm-focus'|str_replace:'':$smarty.capture.one_step_block nofilter}
    
{/if}
<!--checkout_steps--></div>