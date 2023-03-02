{if $profile_fields.$section}
<div class="hidden">
{foreach from=$profile_fields.$section item=field name="profile_fields"} 
	{assign var="data_name" value="user_data"}
    {assign var="data_id" value=$field.field_name}
    {assign var="value" value=$user_data.$data_id}
  
     {if $field.field_type == "A"}
        {$_country = $settings.General.default_country}
        {$_state = $value|default:$settings.General.default_state}

        <select  name="{$data_name}[{$data_id}]" >
            <option value="">- {__("select_state")} -</option>
            {if $states && $states.$_country}
                {foreach from=$states.$_country item=state}
                    <option {if $_state == $state.code}selected="selected"{/if} value="{$state.code}">{$state.state}</option>
                {/foreach}
            {/if}
        </select>
        <input type="text" value="{$_state}" disabled="disabled" class="cm-state cm-location-shipping ty-input-text hidden "/>

    {elseif $field.field_type == "O"}  {* Countries selectbox *}
        {assign var="_country" value=$value|default:$settings.General.default_country}
        <select  name="{$data_name}[{$data_id}]">           
            <option value="">- {__("select_country")} -</option>
            {foreach from=$countries item="country" key="code"}
            <option {if $_country == $code}selected="selected"{/if} value="{$code}">{$country}</option>
            {/foreach}          
        </select>    
    {elseif $field.field_type == "C"}  {* Checkbox *}
        <input type="hidden" name="{$data_name}[{$data_id}]" value="N" {if !$skip_field}{$disabled_param nofilter}{/if} />
        <input type="checkbox" name="{$data_name}[{$data_id}]" value="Y" {if $value == "Y"}checked="checked"{/if} />

    {elseif $field.field_type == "T"}
        <textarea name="{$data_name}[{$data_id}]">{$value}</textarea>
    
    {elseif $field.field_type == "S"}  {* Selectbox *}
        <select name="{$data_name}[{$data_id}]" >
            {if $field.required != "Y"}
            <option value="">--</option>
            {/if}
            {foreach from=$field.values key=k item=v}
            <option {if $value == $k}selected="selected"{/if} value="{$k}">{$v}</option>
            {/foreach}
        </select>    
    {elseif $field.field_type == "R"}  {* Radiogroup *}       
            {foreach from=$field.values key=k item=v name="rfe"}
            <input type="radio" name="{$data_name}[{$data_id}]" value="{$k}" {if (!$value && $smarty.foreach.rfe.first) || $value == $k}checked="checked"{/if} />
            {/foreach}      

    {else}  {* Simple input *}
        <input type="text" name="{$data_name}[{$data_id}]" value="{$value}"/>
    {/if}

{/foreach}
</div>

{/if}
