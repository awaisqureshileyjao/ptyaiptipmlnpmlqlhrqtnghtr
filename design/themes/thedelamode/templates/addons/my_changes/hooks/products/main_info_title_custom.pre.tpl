<div class="ty-grid-list__item-category-name">
    {*foreach from=$product.category_ids item="category_id"}
    <div class="cat-line"></div>
    {$category_id|fn_get_category_name}
    {/foreach*}
    <div class="cat-line"></div>
    {$product.category_ids.0|fn_get_category_name}
</div>

