{if $_REQUEST.cat}
{$category_id = $_REQUEST.cat}
{$filter_var = fn_my_changes_selected_variants($category_id, $variants)}
{$variants = $filter_var}
{if $variants}

{$size = 4}
{split data=$variants size=$size assign="splitted_filter" preverse_keys=true}
<div class="ty-features-header">

{foreach from=$splitted_filter item="group"}
    {foreach from=$group item="ranges" key="index"}
        {if $ranges}     
                <div class="filter_criteria">
                    <a class="filetr_brand_by_alphbet" fiter_data="{$index}" href="{"product_features.view_all&filter_id=10&cat=`$category_id`#`$index`"|fn_url}">{$index}</a>                    
                </div>
         {/if}       
    {/foreach}
{/foreach}
</div>

<div class="ty-features-all">
{$options[] = ''}
{foreach from=$splitted_filter item="group"}
    {foreach from=$group item="ranges" key="index"}
    {strip}
    <div class="ty-features-all__group ty-column6">
            {if $ranges}
                {include file="common/subheader.tpl" title=$index class="ty-subheader search_result_$index"}
                <ul class="ty-features-all__list">
                {foreach from=$ranges item="range"}                                       
                    <li class="ty-features-all__list-item"><a href="{"categories.view&category_id=`$category_id`?features_hash=10-`$range.variant_id`"|fn_url}" class="ty-features-all__list-a">{$range.variant|fn_text_placeholders}</a></li>
                   
                {/foreach}
            </ul>
            {else}&nbsp;{/if}
    </div>
    {strip}
    {/foreach}
{/foreach}
</div>
{/if}
{else}
{if $variants}

{$size = 4}
{split data=$variants size=$size assign="splitted_filter" preverse_keys=true}
<div class="ty-features-header">
{foreach from=$splitted_filter item="group"}
    {foreach from=$group item="ranges" key="index"}
       
                <div class="filter_criteria">
                    <a class="filetr_brand_by_alphbet" fiter_data="{$index}" href="{"product_features.view_all&filter_id=10#`$index` "|fn_url}">{$index}</a>
                </div>
                
    {/foreach}
{/foreach}
</div>

<div class="ty-features-all">
{$options[] = ''}
{foreach from=$splitted_filter item="group"}
    {foreach from=$group item="ranges" key="index"}
    {strip}
    <div class="ty-features-all__group ty-column6">
            {if $ranges}
                {include file="common/subheader.tpl" title=$index class="ty-subheader search_result_$index"}
                <ul class="ty-features-all__list">
                {foreach from=$ranges item="range"}                   
                    <li class="ty-features-all__list-item"><a href="{"product_features.view?variant_id=`$range.variant_id`"|fn_url}" class="ty-features-all__list-a">{$range.variant|fn_text_placeholders}</a></li>                   
                   
                {/foreach}
            </ul>
            {else}&nbsp;{/if}
    </div>
    {strip}
    {/foreach}
{/foreach}
</div>
{/if}

{/if}

{literal}
<script type="text/javascript">
    $(document).ready(function(){
        $(document).on('click','.ty-features-header .filter_criteria .filetr_brand_by_alphbet',function(){
            $('.filetr_brand_by_alphbet').removeClass('active');
            $(this).addClass('active');
            setTimeout(function(){
            location.reload();
        }, 200);
           
        });
    });
</script>
{/literal}