{** block-description:tmpl_copyright **}
<p class="bottom-copyright">
    &copy;
    {if $settings.Company.company_start_year && $smarty.const.TIME|date_format:"%Y" != $settings.Company.company_start_year}
        {$settings.Company.company_start_year} -
    {/if}
    
    {$smarty.const.TIME|date_format:"%Y"} {$settings.Company.company_name}. &nbsp;<a class="bottom-copyright" href="{"index.index"|fn_url}" target="_blank">All Rights Reserved.{*__("SIteName. All Rights Reserved.", ["[product]" => $smarty.const.PRODUCT_NAME])*}</a>
</p>