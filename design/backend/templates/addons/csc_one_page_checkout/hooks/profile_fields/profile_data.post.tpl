<div class="control-group">
  <label class="control-label" for="cs_for_delivery">{__("csc.field_size")}:</label>
  <div class="controls">
  <select name="field_data[cs_field_size]">
  <option value="xxl" {if $field.cs_field_size == 'xxl'} selected="selected"{/if}>XXL</option>
  	<option value="xl" {if $field.cs_field_size == 'xl'} selected="selected"{/if}>XL</option>
    <option value="l" {if $field.cs_field_size == 'l'} selected="selected"{/if}>L</option>
    <option value="m" {if $field.cs_field_size == 'm'} selected="selected"{/if}>M</option>
    <option value="s" {if $field.cs_field_size == 's'} selected="selected"{/if}>S</option>
  
  </select>
   
  </div>
</div>


<div class="control-group">
    <label class="control-label">{__("opc.hide_for")}{include file="common/tooltip.tpl" tooltip=__("opc.hide_for_tooltip")}:</label>
    <div class="controls">
        <input type="hidden" name="field_data[shipping_ids]" value="" />
        {foreach from=$shippings item="shipping"}
            <label class="checkbox inline" for="elm_shippinges_{$shipping.shipping_id}">
                <input type="checkbox" name="field_data[shipping_ids][{$shipping.shipping_id}]" id="elm_shippinges_{$shipping.shipping_id}" {if $shipping.shipping_id|in_array:$field.shipping_ids}checked="checked"{/if} value="{$shipping.shipping_id}" />{$shipping.shipping}</label>
        {foreachelse}&ndash;
        {/foreach}
    </div>
</div>
