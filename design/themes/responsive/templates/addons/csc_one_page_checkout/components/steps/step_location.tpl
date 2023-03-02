  <div class="cm-location-fields">
  		{if $smarty.request.profile == "new"}
          {assign var="hide_profile_name" value=false}
      {else}
          {assign var="hide_profile_name" value=true}
      {/if}
     <div class="clearfix">
          <div class="checkout__block">
              {include file="views/profiles/components/multiple_profiles.tpl" show_text=true hide_profile_name=$hide_profile_name hide_profile_delete=true profile_id=$cart.profile_id create_href="profiles.update?profile=new" use_ajax=false}
          </div>
      </div>
      
      
      
      {include file="addons/csc_one_page_checkout/components/profile_fields.tpl" section='L' body_id="" ship_to_another=false title=$title}
   </div>
