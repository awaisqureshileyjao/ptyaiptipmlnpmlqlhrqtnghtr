{** block-description:text_links **}
{if $items}
    {if $smarty.request.dispatch|default:''|in_array:['categories.view','index.index']}

        <div class="ty-product-filters__wrapper" data-ca-product-filters="wrapper">
        {$sub_list = []}
        {foreach from=$items item="category"}
            {if $category.parent_id > 0}
                {$sub_list[$category.parent_id][] = $category}
            {/if}
        {/foreach}
        
        {foreach from=$items item="category"}
            {if $category.parent_id eq 0}
                <div class="ty-product-filters__block">
                    {$subcats = $sub_list[$category.category_id]|default:[]}
                    <div id="sw_content_cat_{$category.category_id}" class="ty-product-filters__switch cm-combination-filter_cat_{$category.category_id}">
                        <span class="ty-product-filters__title"><a class="ty-text-links__a1" href="{$category|fn_form_dropdown_object_link:$block.type}" >{$category.category}</a></span>
                        {if !empty($subcats )}
                        <i class="ty-product-filters__switch-down ty-icon-down-open"></i>
                        <i class="ty-product-filters__switch-right ty-icon-up-open"></i>
                        {/if}
                    </div>
                    {if !empty($subcats)}
                    <div class="ty-product-filters ty-product-filters-submenus hidden" id="content_cat_{$category.category_id}" >
                        {foreach from=$subcats item="category_2"}
                            <div class="ty-product-filters__block">
                                {$subcats_2 = $sub_list[$category_2.category_id]|default:[]}
                                <div id="sw_content_cat_{$category_2.category_id}" class="ty-product-filters__switch cm-combination-filter_cat_{$category_2.category_id}">
                                    <span class="ty-product-filters__title"><a class="ty-text-links__a1" href="{$category_2|fn_form_dropdown_object_link:$block.type}" >{$category_2.category}</a></span>
                                    {if !empty($subcats_2 )}
                                    <i class="ty-product-filters__switch-down ty-icon-down-open"></i>
                                    <i class="ty-product-filters__switch-right ty-icon-up-open"></i>
                                    {/if}
                                </div>
                                {if !empty($subcats_2)}
                                <div class="ty-product-filters ty-product-filters-submenus2 hidden" id="content_cat_{$category_2.category_id}" >
                                    {foreach from=$subcats_2 item="category_3"}
                                    <div class="ty-product-filters__block">
                                        <div id="sw_content_cat_{$category_3.category_id}" class="ty-product-filters__switch cm-combination-filter_cat_{$category_3.category_id}">
                                            <a class="ty-text-links__a1" href="{$category_3|fn_form_dropdown_object_link:$block.type}" >{$category_3.category}</a>
                                        </div>
                                    </div>
                                    {/foreach}
                                </div>
                                {/if}
                            </div>
                        {/foreach}
                    </div>
                    {/if}
                </div>
            {/if}
        {/foreach} 
        </div>
    {else}
        <ul class="ty-text-links">
            {foreach from=$items item="category"}
            <li class="ty-text-links__item ty-level-{$category.level|default:0}{if $category.active || $category|fn_check_is_active_menu_item:$block.type} ty-text-links__active{/if}">
                <a class="ty-text-links__a"
                   href="{$category|fn_form_dropdown_object_link:$block.type}"
                >
                    {$category.category}
                </a>
            </li>
            {/foreach}
        </ul>
    {/if}

{/if}