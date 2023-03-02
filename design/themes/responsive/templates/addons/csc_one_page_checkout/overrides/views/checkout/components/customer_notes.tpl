{if $addons.csc_one_page_checkout.disable=="Y"}
	{if "design/themes/`$runtime.layout.theme_name`/templates/views/checkout/components/customer_notes.tpl"|file_exists}    
    	{include file="design/themes/`$runtime.layout.theme_name`/templates/views/checkout/components/customer_notes.tpl"}
    {else}
    	{include file="design/themes/responsive/templates/views/checkout/components/customer_notes.tpl"}
    {/if}
{else}
{hook name="checkout:notes"}
	<div class="ty-customer-notes">	    
	    <textarea class="ty-customer-notes__text cm-focus" name="customer_notes" cols="60" rows="3" placeholder="{__("type_comments_here")}">{$cart.notes}</textarea>
	</div>
{/hook}
{/if}