{hook name="blocks:topmenu_dropdown"}

{if $items}
    <ul class="ty-menu__items cm-responsive-menu">
        {hook name="blocks:topmenu_dropdown_top_menu"}
            <li class="ty-menu__item ty-menu__menu-btn visible-phone">
                <a class="ty-menu__item-link">
                    <i class="ty-icon-short-list"></i>
                    <span>{__("menu")}</span>
                </a>
            </li>
        {foreach from=$items item="item1" name="item1"}
            {assign var="item1_url" value=$item1|fn_form_dropdown_object_link:$block.type}
            {assign var="unique_elm_id" value=$item1_url|md5}
            {assign var="unique_elm_id" value="topmenu_`$block.block_id`_`$unique_elm_id`"}

            {if $subitems_count}

            {/if}
            <li class="ty-menu__item{if !$item1.$childs} ty-menu__item-nodrop{else} cm-menu-item-responsive{/if}{if $item1.active || $item1|fn_check_is_active_menu_item:$block.type} ty-menu__item-active{/if}{if $item1.class} {$item1.class}{/if}">
                    {if $item1.$childs}
                        <a class="ty-menu__item-toggle visible-phone cm-responsive-menu-toggle">
                            <i class="ty-menu__icon-open ty-icon-down-open"></i>
                            <i class="ty-menu__icon-hide ty-icon-up-open"></i>
                        </a>
                    {/if}
                    <a {if $item1_url} href="{$item1_url}"{/if} class="ty-menu__item-link" {if $item1.new_window}target="_blank"{/if}>
                        {$item1.$name}
                    </a>
                {if $item1.$childs}

                    {if !$item1.$childs|fn_check_second_level_child_array:$childs}
                    {* Only two levels. Vertical output *}
                        <div class="ty-menu__submenu">
                            <ul class="ty-menu__submenu-items ty-menu__submenu-items-simple cm-responsive-menu-submenu">
                                {hook name="blocks:topmenu_dropdown_2levels_elements"}

                                {foreach from=$item1.$childs item="item2" name="item2"}
                                    {assign var="item_url2" value=$item2|fn_form_dropdown_object_link:$block.type}
                                    <li class="ty-menu__submenu-item{if $item2.active || $item2|fn_check_is_active_menu_item:$block.type} ty-menu__submenu-item-active{/if}{if $item2.class} {$item2.class}{/if}">
                                        <a class="ty-menu__submenu-link" {if $item_url2} href="{$item_url2}"{/if} {if $item2.new_window}target="_blank"{/if}>{$item2.$name}</a>
                                    </li>
                                {/foreach}
                                {if $item1.show_more && $item1_url}
                                    <li class="ty-menu__submenu-item ty-menu__submenu-alt-link">
                                        <a href="{$item1_url}"
                                           class="ty-menu__submenu-alt-link">{__("text_topmenu_view_more")}</a>
                                    </li>
                                {/if}

                                {/hook}
                            </ul>
                        </div>
                    {else}
                        <div class="ty-menu__submenu" id="{$unique_elm_id}">
                            {hook name="blocks:topmenu_dropdown_3levels_cols"}
                                <ul class="ty-menu__submenu-items cm-responsive-menu-submenu">
                                    {foreach from=$item1.$childs item="item2" name="item2"}
                                        
                                        <li class="ty-top-mine__submenu-col">
                                            {assign var="item2_url" value=$item2|fn_form_dropdown_object_link:$block.type}
                                            <div class="ty-menu__submenu-item-header{if $item2.active || $item2|fn_check_is_active_menu_item:$block.type} ty-menu__submenu-item-header-active{/if}{if $item2.class} {$item2.class}{/if}">
                                                <a{if $item2_url} href="{$item2_url}"{/if} class="ty-menu__submenu-link" {if $item2_url} name="{$item2.$name}" data-id="{$item2.category_id}"{/if} {if $item2.new_window}target="_blank"{/if}>{$item2.$name}</a>
                                            </div>
                                            {if $item2.$childs}
                                                <a class="ty-menu__item-toggle visible-phone cm-responsive-menu-toggle">
                                                    <i class="ty-menu__icon-open ty-icon-down-open"></i>
                                                    <i class="ty-menu__icon-hide ty-icon-up-open"></i>
                                                </a>
                                            {/if}
                                            <div class="ty-menu__submenu submenu2 hidden">
                                                <div class="ty-menu__submenu-itms">
                                                <ul class="ty-menu__submenu-list cm-responsive-menu-submenu">
                                                    <span class="category_name">
                                                    <a href="{"categories.view&category_id=`$item2.category_id`"|fn_url}">
                                                    {$item2.$name}</a>             
                                                    </span>
                                                    {if $item2.$childs}
                                                        {hook name="blocks:topmenu_dropdown_3levels_col_elements"}
                                                        {foreach from=$item2.$childs item="item3" name="item3"}
                                                            {assign var="item3_url" value=$item3|fn_form_dropdown_object_link:$block.type}
                                                            <li class="ty-menu__submenu-item{if $item3.active || $item3|fn_check_is_active_menu_item:$block.type} ty-menu__submenu-item-active{/if}{if $item3.class} {$item3.class}{/if}">
                                                                <a{if $item3_url} href="{$item3_url}"{/if}
                                                                        class="ty-menu__submenu-link" {if $item3.new_window}target="_blank"{/if}>{$item3.$name}</a>
                                                            </li>
                                                        {/foreach}
                                                        {if $item2.show_more && $item2_url}
                                                            <li class="ty-menu__submenu-item ty-menu__submenu-alt-link">
                                                                <a href="{$item2_url}"
                                                                   class="ty-menu__submenu-link" {if $item2.new_window}target="_blank"{/if}>{__("text_topmenu_view_more")}</a>
                                                            </li>
                                                        {/if}
                                                        {/hook}
                                                    {/if}

                                                </ul>

            {$feat_designers =''}
            {$feat_designers = fn_my_changes_get_categories_brand($item2.category_id)}
            <ul class="static_cat_link">
             {if !($item2.category_id == 502 || $item2.category_id == 613 || $item2.category_id == 622 || $item2.category_id == 723) }
             <h5>{__("featured_designers")}</h5>   
            {$n =0}        
            {foreach from=$feat_designers item="feat_designer" name="feat_designer"}
            {$n = $n+1}

               {*<li class="categ_brand {if $n > 10}hidden{/if}">
               <a href="{"companies.products?company_id=`$company.company_id`?feature_hash=10_`$feat_designer.variant_id`"|fn_url}" class="company-location"><bdi>{$categ_brand.variant nofilter}</bdi></a>
               </li>*}
                <li class="categ_brand {if $n > 10}hidden{/if}">
                   {if $n < 16} 
                <a href="{"categories.view&category_id=`$item2.category_id`?features_hash=10-`$feat_designer.variant_id`"|fn_url}">{$feat_designer.variant}</a>{/if}
            </li>                   
            {/foreach}
                {if $n > 10}<span class="display_more_brand">view more <i class="text-arrow">→</i></span>{/if}
             {else}
             <h5>{__("menu_designer_a_z")}</h5>
               {assign var="aa11" value=$item1.category_id}
             <div class = "search_by_alphabets">
            <div style="text-align:center;width:45px" class="jsx-1241051148"><a href="{"product_features.view_all&filter_id=10&cat=`$item1.category_id`&#0-9"|fn_url}" class="jsx-1241051148 alphabet-letter">0-9</a></div>
                <div style="text-align:center;width:20px" class="jsx-1241051148"><a href="{"product_features.view_all&filter_id=10&cat=`$item1.category_id`&#A"|fn_url}" class="jsx-1241051148 alphabet-letter">A</a></div>
                <div style="text-align:center;width:20px" class="jsx-1241051148"><a href="{"product_features.view_all&filter_id=10&cat=`$item1.category_id`&#B"|fn_url}" class="jsx-1241051148 alphabet-letter">B</a></div>
                <div style="text-align:center;width:20px" class="jsx-1241051148"><a href="{"product_features.view_all&filter_id=10&cat=`$item1.category_id`&#C"|fn_url}" class="jsx-1241051148 alphabet-letter">C</a></div>
                <div style="text-align:center;width:20px" class="jsx-1241051148"><a href="{"product_features.view_all&filter_id=10&cat=`$item1.category_id`&#D"|fn_url}" class="jsx-1241051148 alphabet-letter">D</a></div>
                <div style="text-align:center;width:20px" class="jsx-1241051148"><a href="{"product_features.view_all&filter_id=10&cat=`$item1.category_id`&#E"|fn_url}" class="jsx-1241051148 alphabet-letter">E</a></div>
                <div style="text-align:center;width:20px" class="jsx-1241051148"><a href="{"product_features.view_all&filter_id=10&cat=`$item1.category_id`&#F"|fn_url}" class="jsx-1241051148 alphabet-letter">F</a></div>
                <div style="text-align:center;width:20px" class="jsx-1241051148"><a href="{"product_features.view_all&filter_id=10&cat=`$item1.category_id`&#G"|fn_url}" class="jsx-1241051148 alphabet-letter">G</a></div>
                <div style="text-align:center;width:20px" class="jsx-1241051148"><a href="{"product_features.view_all&filter_id=10&cat=`$item1.category_id`&#H"|fn_url}" class="jsx-1241051148 alphabet-letter">H</a></div>
                <div style="text-align:center;width:20px" class="jsx-1241051148"><a href="{"product_features.view_all&filter_id=10&cat=`$item1.category_id`&#I"|fn_url}" class="jsx-1241051148 alphabet-letter">I</a></div>
                <div style="text-align:center;width:20px" class="jsx-1241051148"><a href="{"product_features.view_all&filter_id=10&cat=`$item1.category_id`&#J"|fn_url}" class="jsx-1241051148 alphabet-letter">J</a></div>
                <div style="text-align:center;width:20px" class="jsx-1241051148"><a href="{"product_features.view_all&filter_id=10&cat=`$item1.category_id`&#K"|fn_url}" class="jsx-1241051148 alphabet-letter">K</a></div>
                <div style="text-align:center;width:20px" class="jsx-1241051148"><a href="{"product_features.view_all&filter_id=10&cat=`$item1.category_id`&#L"|fn_url}" class="jsx-1241051148 alphabet-letter">L</a></div>
                <div style="text-align:center;width:20px" class="jsx-1241051148"><a href="{"product_features.view_all&filter_id=10&cat=`$item1.category_id`&#M"|fn_url}" class="jsx-1241051148 alphabet-letter">M</a></div>
                <div style="text-align:center;width:20px" class="jsx-1241051148"><a href="{"product_features.view_all&filter_id=10&cat=`$item1.category_id`&#N"|fn_url}" class="jsx-1241051148 alphabet-letter">N</a></div>
                <div style="text-align:center;width:20px" class="jsx-1241051148"><a href="{"product_features.view_all&filter_id=10&cat=`$item1.category_id`&#O"|fn_url}" class="jsx-1241051148 alphabet-letter">O</a></div>
                <div style="text-align:center;width:20px" class="jsx-1241051148"><a href="{"product_features.view_all&filter_id=10&cat=`$item1.category_id`&#P"|fn_url}" class="jsx-1241051148 alphabet-letter">P</a></div>
                <div style="text-align:center;width:20px" class="jsx-1241051148"><a href="{"product_features.view_all&filter_id=10&cat=`$item1.category_id`&#Q"|fn_url}" class="jsx-1241051148 alphabet-letter">Q</a></div>
                <div style="text-align:center;width:20px" class="jsx-1241051148"><a href="{"product_features.view_all&filter_id=10&cat=`$item1.category_id`&#R"|fn_url}" class="jsx-1241051148 alphabet-letter">R</a></div>
                <div style="text-align:center;width:20px" class="jsx-1241051148"><a href="{"product_features.view_all&filter_id=10&cat=`$item1.category_id`&#S"|fn_url}" class="jsx-1241051148 alphabet-letter">S</a></div>
                <div style="text-align:center;width:20px" class="jsx-1241051148"><a href="{"product_features.view_all&filter_id=10&cat=`$item1.category_id`&#T"|fn_url}" class="jsx-1241051148 alphabet-letter">T</a></div>
                <div style="text-align:center;width:20px" class="jsx-1241051148"><a href="{"product_features.view_all&filter_id=10&cat=`$item1.category_id`&#U"|fn_url}" class="jsx-1241051148 alphabet-letter">U</a></div>
                <div style="text-align:center;width:20px" class="jsx-1241051148"><a href="{"product_features.view_all&filter_id=10&cat=`$item1.category_id`&#V"|fn_url}" class="jsx-1241051148 alphabet-letter">V</a></div>
                <div style="text-align:center;width:20px" class="jsx-1241051148"><a href="{"product_features.view_all&filter_id=10&cat=`$item1.category_id`&#W"|fn_url}" class="jsx-1241051148 alphabet-letter">W</a></div>
                <div style="text-align:center;width:20px" class="jsx-1241051148"><a href="{"product_features.view_all&filter_id=10&cat=`$item1.category_id`&#X"|fn_url}" class="jsx-1241051148 alphabet-letter">X</a></div>
                <div style="text-align:center;width:20px" class="jsx-1241051148"><a href="{"product_features.view_all&filter_id=10&cat=`$item1.category_id`&#Y"|fn_url}" class="jsx-1241051148 alphabet-letter">Y</a></div>
                <div style="text-align:center;width:20px" class="jsx-1241051148"><a href="{"product_features.view_all&filter_id=10&cat=`$item1.category_id`&#Z"|fn_url}" class="jsx-1241051148 alphabet-letter">Z</a></div>
                <div style="text-align:center;width:200px" class="jsx-1241051148"><a href="{"product_features.view_all&filter_id=10&cat=`$item1.category_id`&cat=`$aa11`"|fn_url}" class="jsx-1241051148 alphabet-letter"><span class="display_more_brand">view more <i class="text-arrow">→</i></span></a></div>                
            </div>

             {/if}   
        </ul>
        {assign var="cat_image" value=$item2.category_id|fn_get_image_pairs:'category':'M':true:true}
                        
        <div class="menu_dropdown_cat_img">
            {include file="common/image.tpl"
                            images=$cat_image
                            no_ids=true
                            image_id="category_image"
                            image_width=$settings.Thumbnails.category_lists_thumbnail_width
                            image_height=$settings.Thumbnails.category_lists_thumbnail_height
                            class="ty-subcategories-img"
                            }   
        </div>
        {$sale_cats = fn_my_changes_get_categories_sale($item1.category_id)}
         {foreach from=$sale_cats item=sale_cat}
            {if 'sale' == strtolower($sale_cat.category)}               
            
        {$hggghgghgg = $sale_cat.category_id}
        <div class="ty-menu_block_sale"><h5>Sale</h5>            
            <a {*if $item2_url} href="{$item2_url}"{/if*} 
            href="{"categories.view?category_id=`$hggghgghgg`"|fn_url}" >
            {assign var="main_pair" value= $hggghgghgg|fn_get_image_pairs:'category':'M':true:true}
                                        {include file="common/image.tpl"
                                            show_detailed_link=false
                                            images=$main_pair
                                            no_ids=true
                                            image_id="category_image"
                                            image_width=$settings.Thumbnails.category_lists_thumbnail_width
                                            image_height=$settings.Thumbnails.category_lists_thumbnail_height
                                            class="ty-subcategories-img"
                                        }

            <span>{__("shop_now")}</span>
             </a>

             {*add {$item2.category_id} in place of 309*}    
        </div> 
            {/if}
        {/foreach}
    </div>
                                            </div>
                                        </li>
                                    {/foreach}
                                    {if $item1.show_more && $item1_url}
                                        <li class="ty-menu__submenu-dropdown-bottom">
                                            <a href="{$item1_url}" {if $item1.new_window}target="_blank"{/if}>{__("text_topmenu_more", ["[item]" => $item1.$name])}</a>
                                        </li>
                                    {/if}
                                </ul>
                            {/hook}
                        </div>
                    {/if}

                {/if}
            </li>
       
        {/foreach}

        {/hook}
    </ul>
{/if}
{/hook}

