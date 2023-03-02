{*if !$hide_wishlist_button}

    {include file="addons/wishlist/views/wishlist/components/add_to_wishlist.tpl"
        wishlist_but_id="button_wishlist_`$obj_prefix``$product.product_id`"
        wishlist_but_name="dispatch[wishlist.add..`$product.product_id`]"
        wishlist_but_role="text"
    }
{/if*}

    {if !$hide_wishlist_button}
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
    {/if}