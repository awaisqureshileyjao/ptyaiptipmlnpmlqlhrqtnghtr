{if $addons.csc_one_page_checkout.disable=="Y"}
{else}
	<!--notes removed by one page checkout addon-->
	{hook name="checkout:final_section_customer_notes"}
	{/hook}
{/if}