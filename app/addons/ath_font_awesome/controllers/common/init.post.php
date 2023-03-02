<?php
/***************************************************************************
*                                                                          *
*   (c) 2016 ThemeHills - Themes and addons				        	       *
*                                                                          *
****************************************************************************/

use Tygh\Settings;
use Tygh\Registry;

if (!defined('BOOTSTRAP')) { die('Access denied'); }

$wysiwyg_editor = Registry::get('settings.Appearance.default_wysiwyg_editor');

if ( array_search($wysiwyg_editor, array('one','redactor', 'tinymce', 'ckeditor')) ) {
	Registry::set('settings.Appearance.default_wysiwyg_editor', '../../addons/ath_font_awesome/editors/'.$wysiwyg_editor);
}
