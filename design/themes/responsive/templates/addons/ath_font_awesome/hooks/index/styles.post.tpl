{style src="../../../../js/addons/ath_font_awesome/use.fontawesome.css"}

{assign var="ath_fa_settings" value=""|fn_get_font_awesome_settings}

<style>
	@ath_cart_icon: {$addons.ath_font_awesome.cart_icon};
	@ath_user_icon: {$addons.ath_font_awesome.user_icon};
	
	@ath_fa_font-size: {$addons.ath_font_awesome.font_size|default:'inherit'};
	@ath_fa_vertical-align: {$addons.ath_font_awesome.vertical_align};
	@ath_fa_drop-down: {$addons.ath_font_awesome.drop_down};
	
	{* 	colors *}
	@ath_fa_color_on: {$addons.ath_font_awesome.color_on|default:'N'};
	
	@ath_fa_font_color: {$ath_fa_settings.font_color|default:'#7a8998'};
	@ath_fa_bg_icon_color: {$ath_fa_settings.icon_color|default:'#34495e'};
	@ath_fa_bg_color: {$ath_fa_settings.bg_color|default:'#edeff1'};
	
	@ath_fa_font_color_active: {$ath_fa_settings.font_color_active|default:'#fff'};
	@ath_fa_bg_icon_color_active: {$ath_fa_settings.icon_color_active|default:'#fff'};
	@ath_fa_bg_color_active: {$ath_fa_settings.bg_color_active|default:'#7a8998'};
</style>

{style src="addons/ath_font_awesome/styles.less"}
