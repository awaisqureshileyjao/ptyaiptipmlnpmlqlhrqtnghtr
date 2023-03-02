{include file="views/profiles/components/profiles_scripts.tpl"}

    <div class="ty-account">

        <form name="profiles_register_form" enctype="multipart/form-data" action="{""|fn_url}" method="post">
            {if $_REQUEST.dispatch != 'profiles.add'}
                 <div class="clearfix">                
                    <div class="ty-control-group ty-profile-field__item ty-first-name">
                    <label for="elm_6" class="ty-control-group__title cm-profile-field   ">Full name</label>
                    <input x-autocompletetype="given-name" type="text" id="elm_6" name="user_data[firstname]" size="32" value="" class="ty-input-text   cm-focus">
                    </div>
                    <div class="ty-control-group ty-profile-field__item ty-phone">
                    <label for="elm_9" class="ty-control-group__title cm-profile-field cm-mask-phone-label  ">Phone</label>
                    <input x-autocompletetype="tel" type="text" id="elm_9" name="user_data[phone]" size="32" value="" class="ty-input-text cm-mask-phone js-mask-phone-inited">
                    </div>
                    <div class="ty-control-group ty-profile-field__item ty-dob">
                    <label for="elm_54" class="ty-control-group__title cm-profile-field   ">Date of Birth</label>
                    <div class="ty-calendar__block">
                    <input type="text" id="elm_54" name="user_data[fields][54]" class="ty-calendar__input cm-calendar" value="" size="10" autocomplete="disabled">
                    <a class="cm-external-focus ty-calendar__link" data-ca-external-focus-id="elm_54">
                    <i class="ty-icon-calendar ty-calendar__button" title="Calendar"></i>
                    </a>
                    <input type="text" hidden="" disabled="" name="fake_mail" aria-hidden="true">
                    </div>

                    </div>
                    <div class="ty-control-group ty-profile-field__item ty-billing-address">
                    <label for="elm_52" class="ty-control-group__title cm-profile-field   ">Address</label>
                    <input type="text" id="elm_52" name="user_data[fields][52]" size="32" value="" class="ty-input-text  ">
                    </div>
                    <div class="ty-control-group ty-profile-field__item ty-gender">
                    <label for="elm_53" class="ty-control-group__title cm-profile-field   ">Gender</label>
                    <div id="elm_53">
                    <input class="radio  elm_53" type="radio" id="elm_53_1" name="user_data[fields][53]" value="1" checked="checked"><span class="radio">Male</span>
                    <input class="radio  elm_53" type="radio" id="elm_53_2" name="user_data[fields][53]" value="2"><span class="radio">Female</span>
                    </div>
                    </div>
                </div>
            {/if}



            {include file="views/profiles/components/profile_fields.tpl" section="C" nothing_extra="Y"}
            {include file="views/profiles/components/profiles_account.tpl" nothing_extra="Y" location="checkout"}

            {if $smarty.request.return_url}
                <input type="hidden" name="return_url" value="{$smarty.request.return_url}" />
            {/if}

            
            {hook name="profiles:account_update"}         
            
            {/hook}

            {include file="common/image_verification.tpl" option="register" align="left" assign="image_verification"}
            {if $image_verification}
            <div class="ty-control-group">
                {$image_verification nofilter}
            </div>
            {/if}

            <div class="ty-profile-field__buttons buttons-container">
                {include file="buttons/register_profile.tpl" but_name="dispatch[{$dispatch}]"}
            </div>
        </form>

        <span class="have_an_account">{__("already_hv_an_acoount")}<a data-ca-target-id="login_block{$block.snapping_id}" class="cm-dialog-opener cm-dialog-auto-size thedelamode_login_btn close" data-ca-dialog-title="" rel="nofollow">{__("login")}</a></span>

    </div>
    {capture name="mainbox_title"}{__("register_new_account")}{/capture}
