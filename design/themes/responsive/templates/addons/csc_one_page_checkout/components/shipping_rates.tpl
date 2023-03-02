{hook name="checkout:shipping_rates"}
    <div id="shipping_rates_list">
    <div class="shipping_rates_list copc_shippings_view_{$addons.csc_one_page_checkout.shipping_methods_view} litecheckout">

        {foreach from=$product_groups key="group_key" item=group name="spg"}
            {* Group name *}
            {if !"ULTIMATE"|fn_allowed_for || $product_groups|count > 1}
                {*<span class="ty-shipping-options__vendor-name">{$group.name}</span>*}
            {/if}

            {* Products list *}
            {if !"ULTIMATE"|fn_allowed_for || $product_groups|count > 1}
                <ul class="ty-shipping-options__products">
                    {foreach from=$group.products item="product"}
                        {if !(($product.is_edp == 'Y' && $product.edp_shipping != 'Y') || $product.free_shipping == 'Y')}
                            <li class="ty-shipping-options__products-item">
                                {if $product.product}
                                    {$product.product nofilter}
                                {else}
                                    {$product.product_id|fn_get_product_name}
                                {/if}
                            </li>
                        {/if}
                    {/foreach}
                </ul>
            {/if}

            {* Shippings list *}
            {if $group.shippings && !$group.all_edp_free_shipping && !$group.shipping_no_required}

                {foreach from=$group.shippings item="shipping"}

                    {if $cart.chosen_shipping.$group_key == $shipping.shipping_id}
                        {assign var="checked" value="checked=\"checked\""}
                        {assign var="strong_begin" value="<strong>"}
                        {assign var="strong_end" value="</strong>"}
                    {else}
                        {assign var="checked" value=""}
                        {assign var="strong_begin" value=""}
                        {assign var="strong_end" value=""}
                    {/if}

                    {if $shipping.delivery_time || $shipping.service_delivery_time}
                        {assign var="delivery_time" value="(`$shipping.service_delivery_time|default:$shipping.delivery_time`)"}
                    {else}
                        {assign var="delivery_time" value=""}
                    {/if}

                    {if $shipping.rate}
                        {capture assign="rate"}{include file="common/price.tpl" value=$shipping.rate}{/capture}
                        {if $shipping.inc_tax}
                            {assign var="rate" value="`$rate` ("}
                            {if $shipping.taxed_price && $shipping.taxed_price != $shipping.rate}
                                {capture assign="tax"}{include file="common/price.tpl" value=$shipping.taxed_price class="ty-nowrap"}{/capture}
                                {assign var="rate" value="`$rate``$tax` "}
                            {/if}
                            {assign var="inc_tax_lang" value=__('inc_tax')}
                            {assign var="rate" value="`$rate``$inc_tax_lang`)"}
                        {/if}                    
                    {else}
                        {assign var="rate" value="" }
                    {/if}

                    {hook name="checkout:shipping_method"}
                        <div class="ty-shipping-options__method">
                            <input type="radio" class="ty-valign ty-shipping-options__checkbox" id="sh_{$group_key}_{$shipping.shipping_id}" name="shipping_ids[{$group_key}]" value="{$shipping.shipping_id}" onclick="fn_csc_calculate_total_shipping_cost();" {$checked} />
                            <div class="ty-shipping-options__group">
                                <label for="sh_{$group_key}_{$shipping.shipping_id}" class="ty-valign ty-shipping-options__title ">
                                
                                    <bdi>                                       
										<div class="copc_shipping_info">
                                            {$shipping.shipping} {$delivery_time}
                                            {if $rate} &ndash; <div class="copc_rate"> {$rate nofilter}</div>{/if}
                                            {if $shipping.description}{$shipping.description nofilter}{/if}
                                        </div>
                                         
                                         {if $shipping.image}
                                            <div class="ty-shipping-options__image">
                                                {include file="common/image.tpl" obj_id=$shipping_id images=$shipping.image class="ty-shipping-options__image"}
                                            </div>
                                        {/if}
                                        
                                   </bdi>
                                </label>
                            </div>
                        </div>
                        {*{if $shipping.description}
                            <div class="ty-checkout__shipping-tips">
                                <p>{$shipping.description nofilter}</p>
                            </div>
                        {/if}*}
                    {/hook}
                {/foreach}

            {else}
                {if $group.all_free_shipping}
                     <p>{__("free_shipping")}</p>
                {elseif $group.all_edp_free_shipping || $group.shipping_no_required }
                    <p>{__("no_shipping_required")}</p>
                {else}
                    <p class="ty-error-text">
                        {__("text_no_shipping_methods")}
                    </p>
                {/if}
            {/if}

        {foreachelse}
            <p>
                {if !$cart.shipping_required}
                    {__("no_shipping_required")}
                {elseif $cart.free_shipping}
                    {__("free_shipping")}
                {/if}
            </p>
        {/foreach}
	</div>
    <!--shipping_rates_list--></div>
{/hook}
