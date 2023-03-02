<section class="ath_font_awesome__color-section{if $addons.ath_font_awesome.color_on == 'N'} hidden{/if}" id="ath_font_awesome_color_section">
	
	<div class="ath_font_awesome__color-section__colors ath_font_awesome__color-section__colors--def">
		<div class="control-group setting-wide" id="ath_fa_font_color">
			<label class="control-label">{__("ath_fa_font_color")}:</label>
			<div class="controls">
				{include file="common/colorpicker.tpl" cp_name="ath_fa_settings[font_color]" cp_id="ath_fa_settings_font_color" cp_value=$ath_fa_settings.font_color|default:'#7a8998' cp_class="cm-te-value-changer"}
			</div>
		</div>
		
		<div class="control-group setting-wide" id="ath_fa_icon_color">
			<label class="control-label">{__("ath_fa_icon_color")}:</label>
			<div class="controls">
				{include file="common/colorpicker.tpl" cp_name="ath_fa_settings[icon_color]" cp_id="ath_fa_settings_icon_color" cp_value=$ath_fa_settings.icon_color|default:'#34495e' cp_class="cm-te-value-changer"}
			</div>
		</div>
		
		<div class="control-group setting-wide" id="ath_fa_bg_color">
			<label class="control-label">{__("ath_fa_bg_color")}:</label>
			<div class="controls">
				{include file="common/colorpicker.tpl" cp_name="ath_fa_settings[bg_color]" cp_id="ath_fa_settings_bg_color" cp_value=$ath_fa_settings.bg_color|default:'#edeff1' cp_class="cm-te-value-changer"}
			</div>
		</div>
	</div>
	
	<div class="ath_font_awesome__color-section__colors ath_font_awesome__color-section__colors--active">
		<div class="control-group" id="ath_fa_font_color_active">
			<label class="control-label">{__("ath_fa_font_color_active")}:</label>
			<div class="controls">
				{include file="common/colorpicker.tpl" cp_name="ath_fa_settings[font_color_active]" cp_id="ath_fa_settings_font_color_active" cp_value=$ath_fa_settings.font_color_active|default:'#fff' cp_class="cm-te-value-changer"}
			</div>
		</div>
		
		<div class="control-group" id="ath_fa_icon_color_active">
			<label class="control-label">{__("ath_fa_icon_color_active")}:</label>
			<div class="controls">
				{include file="common/colorpicker.tpl" cp_name="ath_fa_settings[icon_color_active]" cp_id="ath_fa_settings_icon_color_active" cp_value=$ath_fa_settings.icon_color_active|default:'#fff' cp_class="cm-te-value-changer"}
			</div>
		</div>
		
		<div class="control-group" id="ath_fa_bg_color_active">
			<label class="control-label">{__("ath_fa_bg_color_active")}:</label>
			<div class="controls">
				{include file="common/colorpicker.tpl" cp_name="ath_fa_settings[bg_color_active]" cp_id="ath_fa_settings_bg_color_active" cp_value=$ath_fa_settings.bg_color_active|default:'#7a8998' cp_class="cm-te-value-changer"}
			</div>
		</div>
	</div>
	
</section>

<script>
	
	$( document ).ready( function() {
		
		$('#addon_option_ath_font_awesome_color_on').change(function() {
			if($(this).is(':checked')) {
				$('#ath_font_awesome_color_section').removeClass('hidden');
			} else {
				$('#ath_font_awesome_color_section').addClass('hidden');			
			}	
		});

		//cart icon
		$('#addon_option_ath_font_awesome_cart_icon').after('<i id="ath_preview-icon--cart"></i>');
		
		activeIcon = $('#addon_option_ath_font_awesome_cart_icon').val();
		$('#ath_preview-icon--cart').addClass('fa ath_preview-icon ' + activeIcon);
		
		$('#addon_option_ath_font_awesome_cart_icon').change(function() {
			activeIcon = $(this).val();
			$('#ath_preview-icon--cart').removeClass();
			$('#ath_preview-icon--cart').addClass('fa ath_preview-icon ' + activeIcon);
	    });

	    //user icon
	    $('#addon_option_ath_font_awesome_user_icon').after('<i id="ath_preview-icon--user"></i>');
		
		activeIcon = $('#addon_option_ath_font_awesome_user_icon').val();
		$('#ath_preview-icon--user').addClass('fa ath_preview-icon ' + activeIcon);
		
		$('#addon_option_ath_font_awesome_user_icon').change(function() {
			activeIcon = $(this).val();
			$('#ath_preview-icon--user').removeClass();
			$('#ath_preview-icon--user').addClass('fa ath_preview-icon ' + activeIcon);
	    });
	    
	});
</script>


