<div class="ty-search-block">
    <form action="{""|fn_url}" name="search_form" method="get">
        <input type="hidden" name="match" value="all" />
        <input type="hidden" name="subcats" value="Y" />
        <input type="hidden" name="pcode_from_q" value="Y" />
        <input type="hidden" name="pshort" value="Y" />
        <input type="hidden" name="pfull" value="Y" />
        <input type="hidden" name="pname" value="Y" />
        <input type="hidden" name="pkeywords" value="Y" />
        <input type="hidden" name="search_performed" value="Y" />

        {hook name="search:additional_fields"}{/hook}

        {strip}
            {if $settings.General.search_objects}
                {assign var="search_title" value=__("search")}
            {else}
                {assign var="search_title" value=__("search_products")}
            {/if}
            <input type="text" name="q" value="{$search.q}" id="search_input{$smarty.capture.search_input_id}" title="{$search_title}" class="ty-search-block__input cm-hint search1" />
            {if $settings.General.search_objects}
                {include file="buttons/magnifier.tpl" but_name="search.results" alt=__("search")}
            {else}
                {include file="buttons/magnifier.tpl" but_name="products.search" alt=__("search")}
            {/if}
        {/strip}

        {capture name="search_input_id"}{$block.snapping_id}{/capture}

    </form>
</div>

<div id="my_div">
   <form action="{""|fn_url}" name="search_form" method="get">
        <input type="hidden" name="match" value="all" />
        <input type="hidden" name="subcats" value="Y" />
        <input type="hidden" name="pcode_from_q" value="Y" />
        <input type="hidden" name="pshort" value="Y" />
        <input type="hidden" name="pfull" value="Y" />
        <input type="hidden" name="pname" value="Y" />
        <input type="hidden" name="pkeywords" value="Y" />
        <input type="hidden" name="search_performed" value="Y" />

        {hook name="search:additional_fields"}{/hook}

        {strip}
            {if $settings.General.search_objects}
                {assign var="search_title" value=__("search")}
            {else}
                {assign var="search_title" value=__("search_products")}
            {/if}
            <input type="text" name="q" value="{$search.q}" id="search_input{$smarty.capture.search_input_id}" title="{$search_title}" class="ty-search-block__input cm-hint search2" />
            {if $settings.General.search_objects}
                {include file="buttons/magnifier.tpl" but_name="search.results" alt=__("search")}
            {else}
                {include file="buttons/magnifier.tpl" but_name="products.search" alt=__("search")}
            {/if}
        {/strip}

        {capture name="search_input_id"}{$block.snapping_id}{/capture}

    </form> 
</div>

{literal}
<style type="text/css">
    .custom_search
    {
        height: 100px !important;
        z-index: 100;
        border-radius: 0px !important;;
        border:none !important;;
        width: 100% !important;;
        overflow-x: hidden;
    }

    .custom_live_reload_box
    {
      position: relative !important;;
      top: 100px !important;
    }
    .search2::after 
    {
      content: "+";
      float: right;
      color: red;
    }

</style>
<script type="text/javascript">

$(document).ready(function(){
  $(".search1").click(function(){
    $('#my_div').insertAfter('.tygh-top-panel');
    $('.live-search-box').insertAfter('.search2');
    $('.search2').addClass('custom_search');
    $('.live-search-box').addClass('custom_live_reload_box');
    $('.search2').slideDown();
    $('.search1').hide();
    $('.ty-search-magnifier').hide();
  });
});


</script>
{/literal}
