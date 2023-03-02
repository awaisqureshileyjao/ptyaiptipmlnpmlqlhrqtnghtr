<div class="ty-other-pay clearfix">
    <ul class="ty-payments-list">        
            {foreach from=$payments item="payment"}
                {if $payment_id == $payment.payment_id}
                    {$instructions = $payment.instructions}
                {/if}

                <li class="ty-payments-list__item">
                    <input id="payment_{$payment.payment_id}" class="ty-payments-list__checkbox cm-select-payment" type="radio" name="payment_id" value="{$payment.payment_id}" data-ca-url="{$url}" data-ca-result-ids="{$result_ids}" {if $payment_id == $payment.payment_id}checked="checked"{/if} {if $payment.disabled}disabled{/if} />
                    <div class="ty-payments-list__item-group">
                        <label for="payment_{$payment.payment_id}" class="ty-payments-list__item-title">
                            <div class="copc_payment_desc">
                            {$payment.payment}
                            {if $payment.description}
                                <div class="ty-payments-list__description">
                                {$payment.description nofilter}
                                 </div>
                             {/if}
                             </div>
                             {if $payment.image}
                                <div class="ty-payments-list__image">
                                {include file="common/image.tpl" obj_id=$payment.payment_id images=$payment.image class="ty-payments-list__image"}
                                </div>
                            {/if}
                             
                        </label>                        
                        {if $payment_id == $payment.payment_id}
                            {if $payment.template && $payment.template != "cc_outside.tpl"}
								 {capture name="payment_template"}
									<div class="csc_phone_input_block">
										{include file=$payment.template card_id=$payment.payment_id}
									</div>
								{/capture}
                            {/if}
                        {/if}
						
                    </div>
                </li>

            {/foreach}       
    </ul>
    <div class="ty-payments-list__instruction">
		{if $payment.template && $smarty.capture.payment_template|trim != ""}
			{$smarty.capture.payment_template nofilter}
		{/if}
        {$instructions nofilter}
    </div>
</div>
