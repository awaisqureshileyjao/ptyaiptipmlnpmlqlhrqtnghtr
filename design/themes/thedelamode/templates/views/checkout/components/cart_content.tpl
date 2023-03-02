{assign var="result_ids" value="cart*,checkout*"}
<div class="span11">
<div id="checkout_form_wrapper">
<form name="checkout_form" class="cm-check-changes cm-ajax cm-ajax-full-render" action="{""|fn_url}" method="post" enctype="multipart/form-data" id="checkout_form">
<input type="hidden" name="redirect_mode" value="cart" />
<input type="hidden" name="result_ids" value="{$result_ids}" />

<h1 class="ty-mainbox-title">{__("cart_contents")}</h1>
{include file="views/checkout/components/cart_items.tpl" disable_ids="button_cart"}
<div class="buttons-container ty-cart-content__top-buttons clearfix">
    <div class="ty-float-left ty-cart-content__left-buttons">
        {hook name="checkout:cart_content_top_left_buttons"}
            {include file="buttons/continue_shopping.tpl" but_href=$continue_url|fn_url }
        {/hook}
    </div>
</div>
</form>
<!--checkout_form_wrapper--></div>
</div>

<div class="span5">
{include file="views/checkout/components/checkout_totals.tpl" location="cart"}

<div class="buttons-container ty-cart-content__bottom-buttons clearfix">
    <div class="ty-float-right ty-cart-content__right-buttons">
        {hook name="checkout:cart_content_bottom_right_buttons"}
            {if $payment_methods}
                {assign var="link_href" value="checkout.checkout"}
                {include file="buttons/proceed_to_checkout.tpl"}
            {/if}
        {/hook}
    </div>
</div>
{if $checkout_add_buttons}
    <div class="ty-cart-content__payment-methods payment-methods" id="payment-methods">
        <span class="ty-cart-content__payment-methods-title payment-metgods-or">{__("or_use")}</span>
        <table class="ty-cart-content__payment-methods-block">
            <tr>
                {foreach from=$checkout_add_buttons item="checkout_add_button"}
                    <td class="ty-cart-content__payment-methods-item">{$checkout_add_button nofilter}</td>
                {/foreach}
            </tr>
    </table>
    <!--payment-methods--></div>
{/if}
</div>
