{if $product.seo_snippet.images}
<!--<div>
{$_product_count = $product.seo_snippet.images|count}
{if $_product_count > 4} {$_product_count = 4}{/if}
{$_width = 100/$_product_count}
{if $_product_count == 2} {$width = 100} {else if $_product_count == 3} {$width = 50} {else if $_product_count >= 4} {$width = 33} {/if}
{if $_product_count > 0}
 <div class="ty-product-details-image-section" style ="width: {if $_product_count == 1}100 {else} 75{/if}%">
{foreach from=$product.seo_snippet.images item=p_images key=p_key}
{if $p_images && $p_key < 4}
 <div class="ty-product-details-image main_{$p_key} {if $p_key == 0} active {else} hidden{/if}" style="width: 100%"> <img src="{$p_images}">
 </div>
{/if}
{/foreach}
</div>
<div class="ty-product-details-image-thumbnail-section" style ="width: {if $_product_count > 1}25{/if}%">
{foreach from=$product.seo_snippet.images item=p_images key=p_key}
{if $p_images && $p_key < 4}
 <div class="ty-product-details-image-thumbnail thumb_{$p_key} {if $p_key == 0} hidden {/if}" image_thumb_key ="{$p_key}"  style="width: {$width}%"><img src="{$p_images}"></div>
{/if}
{/foreach}
 </div>
{/if}
</div>-->
{/if}
