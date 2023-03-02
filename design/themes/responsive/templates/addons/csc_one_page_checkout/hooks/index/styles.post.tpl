<style>
	{foreach from = $addons.csc_one_page_checkout item=v key=k}
		{if $k|strpos:'clr'!==false || $k|strpos:'size'!==false}
			@copc_{$k}:{$v};
		{/if}
	{/foreach}
	
</style>
{style src="addons/csc_one_page_checkout/styles.less"}
{style src="addons/csc_one_page_checkout/tbwfields.css"}
{if $smarty.const.PRODUCT_VERSION < '4.4.1'}
	{style src="addons/csc_one_page_checkout/styles_old.less"}
{/if}

