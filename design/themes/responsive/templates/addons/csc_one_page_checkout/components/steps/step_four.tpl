{script src="js/tygh/tabs.js"}
{if $edit}
{if $cart|fn_allow_place_order:$auth}
    {if $cart.payment_id}
        <div class="clearfix">
        	{include file="common/subheader.tpl" title=__("select_payment_method")}
            {include file="addons/csc_one_page_checkout/components/payments/payment_methods.tpl" payment_id=$cart.payment_id}
        </div>
    {else}
        <div class="checkout__block"><h3 class="ty-subheader">{__("text_no_payments_needed")}</h3></div>        
        <form name="paymens_form" action="{""|fn_url}" method="post">
            {include file="addons/csc_one_page_checkout/components/final_section.tpl" is_payment_step=true}
            <div class="ty-checkout-buttons">
                {include file="buttons/place_order.tpl" but_text=__("submit_my_order") but_name="dispatch[checkout.place_order]" but_id="place_order"}
            </div>
        </form>
    {/if}
{else}
    {include file="addons/csc_one_page_checkout/components/final_section.tpl" is_payment_step=true}
{/if}
{/if}


<div id="place_order_data" class="hidden">
</div>