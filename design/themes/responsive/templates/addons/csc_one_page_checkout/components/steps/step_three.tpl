{if $edit}
        <div class="clearfix">
            <div class="checkout__block"> 
            	{include file="common/subheader.tpl" title=__("copc.select_shipping_method")}
                       
                {if !$cart.shipping_failed}
                    {include file="addons/csc_one_page_checkout/components/shipping_rates.tpl"  show_header=true}
                {elseif $cart.user_data|fn_check_location_fields_is_filled}
                    <p class="ty-error-text">{__("text_no_shipping_methods")}</p>
                 {else}
                 	<p class="ty-error-text">{__("copc.select_location")}</p>
                {/if}           
           

            {if $edit}
                 <div class="ty-checkout__shipping-tips">
                     {__("shipping_tips")}
                 </div>
            {/if}
            </div>
        </div>
{/if}

