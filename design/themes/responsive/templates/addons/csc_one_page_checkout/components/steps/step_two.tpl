 {if !$profile_fields['L']}
      {if $smarty.request.profile == "new"}
          {assign var="hide_profile_name" value=false}
      {else}
          {assign var="hide_profile_name" value=true}
      {/if}
      
      
     <div class="clearfix">
          <div class="checkout__block">
              {include file="views/profiles/components/multiple_profiles.tpl" show_text=true hide_profile_name=$hide_profile_name hide_profile_delete=false profile_id=$cart.profile_id create_href="profiles.update?profile=new" use_ajax=false}
          </div>
      </div>
  {/if}
  {if $profile_fields['C']}
	  <div class="clearfix">
		  <div class="checkout__block">
			  {include file="addons/csc_one_page_checkout/components/profile_fields.tpl" section='C' body_id="copc_contact_information" ship_to_another=true title=__('contact_information')}
		  </div>
	  </div>
	  <p></p>
  {/if}
  
  {if $settings.Checkout.address_position == "billing_first"}
      {assign var="first_section" value="B"}
      {assign var="first_section_text" value=__("billing_address")}
      {assign var="sec_section" value="S"}
      {assign var="sec_section_text" value=__("shipping_address")}
      {assign var="ship_to_another_text" value=__("text_ship_to_billing")}
      {assign var="body_id" value="sa"}
  {else}
      {assign var="first_section" value="S"}
      {assign var="first_section_text" value=__("shipping_address")}
      {assign var="sec_section" value="B"}
      {assign var="sec_section_text" value=__("billing_address")}
      {assign var="ship_to_another_text" value=__("text_billing_same_with_shipping")}
      {assign var="body_id" value="ba"}
  {/if}
     
  {if $profile_fields[$first_section]}
      <div class="clearfix" data-ct-address="billing-address">
          <div class="checkout__block">
              {include file="addons/csc_one_page_checkout/components/profile_fields.tpl" section=$first_section body_id="" ship_to_another=true title=$first_section_text}
          </div>
      </div>
  {/if}

  {if $profile_fields[$sec_section]}
      <div class="clearfix shipping-address__switch" data-ct-address="shipping-address">
          {include file="addons/csc_one_page_checkout/components/profile_fields.tpl" section=$sec_section body_id=$body_id address_flag=$profile_fields|fn_compare_shipping_billing ship_to_another=$cart.ship_to_another title=$sec_section_text grid_wrap="checkout__block"}
      </div>
  {/if}
  
  {include file="addons/csc_one_page_checkout/components/profile_fields_disabled.tpl" section="D"}
               

               
           
