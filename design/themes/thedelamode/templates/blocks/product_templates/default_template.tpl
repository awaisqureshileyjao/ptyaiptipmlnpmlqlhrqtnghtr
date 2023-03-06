{script src="js/tygh/exceptions.js"}

<div class="ty-product-block ty-product-detail">
    <div class="ty-product-block__wrapper clearfix">
    {hook name="products:view_main_info"}
        {if $product}
            {assign var="obj_id" value=$product.product_id}
            {include file="common/product_data.tpl" product=$product but_role="big" but_text=__("add_to_cart")}
            
            <div class="ty-product-block__left">
                <div class="ty-product-block__left_block_part_one">
                    
                    <div class="ty-product-block__img-wrapper" style="width: {*$settings.Thumbnails.product_details_thumbnail_width}px*}100%">
                        {hook name="products:image_wrap"}
                            {if !$no_images}
                                <div class="ty-product-block__img cm-reload-{$product.product_id}" data-ca-previewer="true" id="product_images_{$product.product_id}_update">
                                    {assign var="product_labels" value="product_labels_`$obj_prefix``$obj_id`"}
                                    {$smarty.capture.$product_labels nofilter}
        
                                    {include file="views/products/components/product_images.tpl" product=$product show_detailed_link="Y" image_width=$settings.Thumbnails.product_details_thumbnail_width image_height=$settings.Thumbnails.product_details_thumbnail_height}
                                <!--product_images_{$product.product_id}_update--></div>
                            {/if}
                        {/hook}
                    </div>
                </div>
                <div class="ty-product-block__left_block_part_two">    
                
                {assign var="form_open" value="form_open_`$obj_id`"}
                {$smarty.capture.$form_open nofilter}

                {hook name="products:main_info_title_custom_okkkkkkk"}
                    {if !$hide_title}
                        <h1 class="ty-product-block-title" {live_edit name="product:product:{$product.product_id}"}>
                        
                        {hook name="products:brand"}
                            {hook name="products:brand_default"}
                                <div class="brand">
                                    {include file="views/products/components/product_features_short_list.tpl" features=$product.header_features}
                                </div>
                            {/hook}
                        {/hook}
                        
                        <bdi>{$product.product nofilter}</bdi></h1>
                    {/if}

                    
                {/hook}

                {assign var="old_price" value="old_price_`$obj_id`"}
                {assign var="price" value="price_`$obj_id`"}
                {assign var="clean_price" value="clean_price_`$obj_id`"}
                {assign var="list_discount" value="list_discount_`$obj_id`"}
                {assign var="discount_label" value="discount_label_`$obj_id`"}

                {hook name="products:promo_text"}
                {if $product.promo_text}
                <div class="ty-product-block__note-wrapper">
                    <div class="ty-product-block__note ty-product-block__note-inner">
                        {$product.promo_text nofilter}
                    </div>
                </div>
                {/if}
                {/hook}

                <div class="{if $smarty.capture.$old_price|trim || $smarty.capture.$clean_price|trim || $smarty.capture.$list_discount|trim}prices-container {/if}price-wrap">
                    {if $smarty.capture.$old_price|trim || $smarty.capture.$clean_price|trim || $smarty.capture.$list_discount|trim}
                        <div class="ty-product-prices">
                            {if $smarty.capture.$old_price|trim}{$smarty.capture.$old_price nofilter}{/if}
                    {/if}

                    {if $smarty.capture.$price|trim}
                        <div class="ty-product-block__price-actual">
                            <p class="pre_price_text">{__("now")}</p>{$smarty.capture.$price nofilter}
                        </div>
                    {/if}

                    {if $smarty.capture.$old_price|trim || $smarty.capture.$clean_price|trim || $smarty.capture.$list_discount|trim}
                            {$smarty.capture.$clean_price nofilter}
                            {$smarty.capture.$list_discount nofilter}
                        </div>
                    {/if}
                </div>

                {hook name="products:main_info_title"}{/hook}
                
                <div class="ty-product-block__advanced-option clearfix">
                  {*  {if $capture_options_vs_qty}{capture name="product_options"}{$smarty.capture.product_options nofilter}{/if}
                    {assign var="advanced_options" value="advanced_options_`$obj_id`"}
                    {$smarty.capture.$advanced_options nofilter}
                    {if $capture_options_vs_qty}{/capture}{/if}

                    *}
                </div>

                <div class="ty-product-block__sku">
                    {assign var="sku" value="sku_`$obj_id`"}
                    {$smarty.capture.$sku nofilter}
                </div>

                {if $capture_options_vs_qty}{capture name="product_options"}{$smarty.capture.product_options nofilter}{/if}
                <div class="ty-product-block__field-group">
                    {assign var="product_amount" value="product_amount_`$obj_id`"}
                    {$smarty.capture.$product_amount nofilter}

                    {assign var="qty" value="qty_`$obj_id`"}
                    {$smarty.capture.$qty nofilter}

                    {assign var="min_qty" value="min_qty_`$obj_id`"}
                    {$smarty.capture.$min_qty nofilter}
                </div>
                {if $capture_options_vs_qty}{/capture}{/if}

                {assign var="product_edp" value="product_edp_`$obj_id`"}
                {$smarty.capture.$product_edp nofilter}

                {if $show_descr}
                {assign var="prod_descr" value="prod_descr_`$obj_id`"}
                    <h3 class="ty-product-block__description-title">{__("description")}</h3>
                    <div class="ty-product-block__description">{$smarty.capture.$prod_descr nofilter}</div>
                {/if}
                
                {if $capture_buttons}{capture name="buttons"}{/if}
                <div class="ty-product-block__button {if $product.variation_features}option_avail {/if}">

                    {if $show_details_button}
                        {include file="buttons/button.tpl" but_href="products.view?product_id=`$product.product_id`" but_text=__("view_details") but_role="submit"}
                    {/if}

                    {*if !$hide_wishlist_button}
                    <button id="button_cart_`{$product.product_id}`" class="ty-btn ty-btn__tertiary ty-btn-icon ty-add-to-wish cm-submit text-button" type="submit" name="dispatch[wishlist.add..`$product.product_id`]">
                     {$wsp =false}
                       {if $smarty.session.wishlist.products}
                            {foreach from=$smarty.session.wishlist.products item=wp}

                              {if  in_array($product.product_id, $wp)}
                                {$wsp =true}
                              {/if}
                            {/foreach}                        
                        {/if}                        
                        <i class="fa fa-heart{if $wsp == true} {else}-o{/if}" aria-hidden="true"></i>
                    </button>                    
                    {/if*}

                    {if $capture_options_vs_qty}{capture name="product_options"}{$smarty.capture.product_options nofilter}{/if}
                <div class="ty-product-block__option">
                    {assign var="product_options" value="product_options_`$obj_id`"}
                    {$smarty.capture.$product_options nofilter}
                </div>
                    {if $product.variation_features}<span class="prod_fet_tit">{__("sizeguide")}</span>{/if}
                {if $capture_options_vs_qty}{/capture}{/if}

                    
                    {assign var="add_to_cart" value="add_to_cart_`$obj_id`"}
                    {$smarty.capture.$add_to_cart nofilter}

                    {assign var="list_buttons" value="list_buttons_`$obj_id`"}
                    {$smarty.capture.$list_buttons nofilter}
                </div>
                {if $capture_buttons}{/capture}{/if}

                {assign var="form_close" value="form_close_`$obj_id`"}
                {$smarty.capture.$form_close nofilter}

                {hook name="products:product_detail_bottom"}
                {/hook}
                
                <div class="product_description_details">
                <div class="product_description_tabs">
                    {if $show_product_tabs}
                        {hook name="products:product_tabs"}
                            {include file="views/tabs/components/product_tabs.tpl"}
        
                            {if $blocks.$tabs_block_id.properties.wrapper}
                                {include file=$blocks.$tabs_block_id.properties.wrapper content=$smarty.capture.tabsbox_content title=$blocks.$tabs_block_id.description}
                            {else}
                                {$smarty.capture.tabsbox_content nofilter}
                            {/if}
                        {/hook}
                    {/if}
                </div>
                {*<div class="product_description_del_ret">
                {include file="blocks/static_templates/delivery_return.tpl"}
                </div>*}
                </div>
            </div>
          </div>  
        {/if}

    {/hook}
    </div>

    {if $smarty.capture.hide_form_changed == "Y"}
        {assign var="hide_form" value=$smarty.capture.orig_val_hide_form}
    {/if}

</div>

<div class="product-details">
</div>

{capture name="mainbox_title"}{assign var="details_page" value=true}{/capture}

{literal}
<script type="text/javascript">
    $(document).ready(function(){
    var products = 201;//{/literal}{$product.product_id|json_encode}{literal}
    $(document).on('click','.ty-product-block__button.option_avail .ty-btn__tertiary .fa-heart-o',function(){
              $.ajax({url: "/index.php?dispatch=wishlist.check",
                         type : "POST",                         
                         data: {product_id: product_id}, 
                        success: function(data) {
                    //$("#h11").html(result);
                }
            });    

    });
});

</script>
{/literal}

        