{if $addons.csc_one_page_checkout.disable=="Y"}
	{if "design/themes/`$runtime.layout.theme_name`/templates/views/checkout/checkout.tpl"|file_exists}    
    	{include file="design/themes/`$runtime.layout.theme_name`/templates/views/checkout/checkout.tpl"}
    {else}
    	{include file="design/themes/responsive/templates/views/checkout/checkout.tpl"}
    {/if}
{else}
	{script src="js/tygh/exceptions.js"}
	{script src="js/tygh/checkout.js"}

	{if version_compare($smarty.const.PRODUCT_VERSION, '4.10.1', '>=')}
		{script src="js/tygh/checkout/pickup_selector.js"}
		{script src="js/tygh/checkout/pickup_search.js"}
		{script src="js/tygh/checkout/lite_checkout.js"}
	{/if}
	{$smarty.capture.checkout_error_content nofilter}
	{include file="addons/csc_one_page_checkout/components/one_page_checkout.tpl"}
	{capture name="mainbox_title"}<span class="ty-checkout__title">{__("secure_checkout")}&nbsp;<i class="ty-checkout__title-icon ty-icon-lock"></i></span>{/capture}
{/if}