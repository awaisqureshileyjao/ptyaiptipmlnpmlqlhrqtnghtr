{hook name="checkout:payment_method_check"}
    {if $order_id}
        {$url = "orders.details?order_id=`$order_id`"}
        {$result_ids = "elm_payments_list"}
    {else}
        {$url = "checkout.checkout"}
        {$result_ids = "checkout*,step_four"}
    {/if}
{/hook}

<div class="cm-tabs-content cm-j-content-disable-convertation tabs-content clearfix copc_payments_view_{$addons.csc_one_page_checkout.payment_methods_view}">
   <div id="content_payments_1">
    {foreach from=$payment_methods key="tab_id" item="payments"}
        {include file="addons/csc_one_page_checkout/components/payments/payments_list.tpl"}			
         <div class="processor-buttons hidden"></div>
    {/foreach}
     <!--content_payments_1--></div>
    {include file="addons/csc_one_page_checkout/components/final_section.tpl" is_payment_step=true suffix=$tab_id}
     <div class="ty-checkout-buttons ty-checkout-buttons__submit-order">
          {if !$show_checkout_button}
              {include file="buttons/place_order.tpl" but_text=__("submit_my_order") but_name="dispatch[checkout.place_order]" but_role="big" but_id="place_order_`$tab_id`"}
          {else}
              {$checkout_buttons[$payment_id] nofilter}
          {/if}
      </div>
</div>
