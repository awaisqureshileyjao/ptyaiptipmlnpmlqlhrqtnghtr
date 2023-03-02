<div class="control-group">
    <label class="control-label" for="elm_min_max_subtotal">{__("order_subtotal_limit")}&nbsp;({$currencies.$primary_currency.symbol nofilter}):</label>
    <div class="controls">
        <input type="text" name="shipping_data[min_subtotal]" id="elm_min_max_subtotal" size="4" value="{$shipping.min_subtotal}" class="input-mini" />&nbsp;-&nbsp;<input type="text" name="shipping_data[max_subtotal]" size="4" value="{if $shipping.max_subtotalmax_subtotal != "0.00"}{$shipping.max_subtotal}{/if}" class="input-mini right" />
    </div>
</div>
