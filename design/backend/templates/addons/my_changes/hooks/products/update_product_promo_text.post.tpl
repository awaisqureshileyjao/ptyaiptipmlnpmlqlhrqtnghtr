    <div class="control-group {$no_hide_input_if_shared_product}">
        <label class="control-label" for="elm_product_details">{__("details")}:</label>
        <div class="controls">
            <textarea id="elm_product_details" name="product_data[details]" cols="55" rows="2" class="cm-wysiwyg input-large">{$product_data.details}</textarea>
            {include file="buttons/update_for_all.tpl"
                display=$show_update_for_all
                object_id="details"
                name="update_all_vendors[details]"
                component="products.details"
            }
        </div>
    </div>

    {*<div class="control-group {$no_hide_input_if_shared_product}">
        <label class="control-label" for="elm_product_size_fit">{__("size_fit")}:</label>
        <div class="controls">
            <textarea id="elm_product_size_fit" name="product_data[size_fit]" cols="55" rows="2" class="cm-wysiwyg input-large">{$product_data.size_fit}</textarea>
            {include file="buttons/update_for_all.tpl"
                display=$show_update_for_all
                object_id="size_fit"
                name="update_all_vendors[size_fit]"
                component="products.size_fit"
            }
        </div>
    </div>
    <div class="control-group {$no_hide_input_if_shared_product}">
        <label class="control-label" for="elm_product_delivery_returns">{__("delivery_returns")}:</label>
        <div class="controls">
            <textarea id="elm_product_delivery_returns" name="product_data[delivery_returns]" cols="55" rows="2" class="cm-wysiwyg input-large">{$product_data.delivery_returns}</textarea>
            {include file="buttons/update_for_all.tpl"
                display=$show_update_for_all
                object_id="delivery_returns"
                name="update_all_vendors[delivery_returns]"
                component="products.delivery_returns"
            }
        </div>
    </div>*}
