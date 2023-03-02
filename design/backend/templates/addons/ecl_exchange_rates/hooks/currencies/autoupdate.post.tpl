{if $runtime.mode == 'update'}
<div class="control-group">
	<label class="control-label" for="auto_update_{$id}">{__("exchange_rates.auto_update")}:</label>
	<div class="controls">
		<input type="hidden" name="currency_data[auto_update]" value="N" />
		<input type="checkbox" name="currency_data[auto_update]" value="Y" {if $currency.auto_update == "Y"}checked="checked"{/if} id="auto_update_{$id}" {if $currency.is_primary == "Y"}disabled="disabled"{/if}>
	</div>
</div>
<div class="control-group">
	<label class="control-label" for="rate_modifier_{$id}">{__("exchange_rates.rate_modifier")}, %:</label>
	<div class="controls">
		 <input type="text" name="currency_data[rate_modifier]" size="7" value="{$currency.rate_modifier}" id="rate_modifier_{$id}" {if $currency.is_primary == "Y"}disabled="disabled"{/if}>
	</div>
</div>
<div class="control-group">
	<label class="control-label cm-required" for="coefficient_{$id}">{__("exchange_rates.yahoo_rate_on")} {if $currency.timestamp}{$currency.timestamp|date_format:"`$settings.Appearance.date_format`, `$settings.Appearance.time_format`"}{else}{$smarty.const.TIME|date_format:"`$settings.Appearance.date_format`, `$settings.Appearance.time_format`"}{/if}:</label>
	<div class="controls">
		<input type="text" name="currency_data[yahoo_rate]" size="7" value="{$currency.yahoo_rate}" id="coefficient_{$id}" class="cm-coefficient" disabled="disabled">
		<a href="{"exchange_rates.update?currency_id=`$currency.currency_id`"|fn_url}" class="cm-ajax" data-ca-target-id="content_group{$currency.currency_id}">{__('update')}</a>
	</div>
</div>
{/if}