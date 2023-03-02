{if !$runtime.company_id && !$runtime.simple_ultimate && !fn_allowed_for("MULTIVENDOR")}
{__('ecl_please_select_store_to_update')}
{else}
{__('instagram_feed_text')}:
<br/><br/>
{if fn_allowed_for("MULTIVENDOR")}
<strong>{$config.current_location}/ecl_instagram_update/</strong>
{else}
<strong>https://{$runtime.company_data.secure_storefront}/ecl_instagram_update/</strong>
{/if}
<br/><br/>

<a class="btn btn-primary cm-new-window" href="{"ecl_instagram.process"|fn_url}">{__('generate_token')}</a>
{/if}