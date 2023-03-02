{if $addons.csc_one_page_checkout.disable=="Y"}
	{if "design/themes/`$runtime.layout.theme_name`/templates/buttons/place_order.tpl"|file_exists}    
    	{include file="design/themes/`$runtime.layout.theme_name`/templates/buttons/place_order.tpl"}
    {else}
    	{include file="design/themes/responsive/templates/buttons/place_order.tpl"}
    {/if}
{else}
	{if $runtime.controller == 'checkout'}
		{if $cart.payment_surcharge && !$take_surcharge_from_vendor}
		 {math equation="x+y" x=$cart.total y=$cart.payment_surcharge assign="_total"}
		{/if}
		<button id="place_order_tab1" class="ty-btn__big ty-btn__primary cm-checkout-place-order ty-btn" type="submit" name="dispatch[checkout.place_order]">{__("submit_my_order")} ({include file="common/price.tpl"  value=$_total|default:$cart.total})
		</button>
	{else}
		{if $order_info.payment_surcharge && !$take_surcharge_from_vendor}
		 {math equation="x+y" x=$order_info.total y=$order_info.payment_surcharge assign="_total"}
		{/if}
		<button id="place_order_tab1" class="ty-btn__big ty-btn__primary cm-checkout-place-order ty-btn" type="submit" name="dispatch[orders.repay]">{__("submit_my_order")} ({include file="common/price.tpl"  value=$_total|default:$order_info.total})
		</button>
	{/if}
{/if}
