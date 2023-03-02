{literal}           
<script type="text/javascript">
jQuery(function($){
  $(".drawer_navigation #menu-reset").trigger('click');
  $(".drawer_navigation #menu").prop('checked',false);
  $(".drawer_navigation .menu-opener").removeClass('open');
  
	$(document).on("click",".drawer_navigation .menu-opener.open",function(){
    setTimeout(function(){ $(".drawer_navigation #menu-reset").trigger('click'); },50);
  });

  $(document).on("change",".drawer_navigation #menu",function(){
      $(".drawer_navigation .menu-opener").removeClass('open');
      if( $(this).prop('checked') )
        $(".drawer_navigation .menu-opener").addClass('open');
  });
  $(document).on("click",".drawer_navigation label",function(){
		obj = $(".drawer_navigation #"+$(this).attr('for'));
    if( obj.length )
			obj.prop('checked',!obj.prop('checked')).trigger('change');
    return false;
	});
});
</script>
{/literal}

<div class="drawer_navigation">
	<label class="menu-opener" for="menu"><span>&nbsp;</span></label>

    <form action="javascript:">
        <input id="menu" type="checkbox">
        <input id="menu-reset" type="reset">
        <nav class="nav_dn">
          <main>
            <label class="menu-toggle" for="menu"><span>&nbsp;</span></label>
                                
            <label class="menu-close" for="menu-reset"><span>&nbsp;</span></label>
            <menu>
              <menuitem>
                <span class="heading close_menu"><label class="menu-back" for="menu">Back</label> Menu</span>
              </menuitem>
              {$name = 'category'}
              {$childs= 'subcategories'}
              
              {foreach from=$items item="item1" name="item1"}
                {assign var="item1_url" value=$item1|fn_form_dropdown_object_link:$block.type}
                {assign var="unique_elm_id1" value="mb_menu_`$block.block_id`_`$item1_url|md5`"}  
                <menuitem>
                  <div class="item-line{if $item1.$childs} hc{/if}">
                     <a href="{$item1_url}"{if $item1.new_window} target="_blank"{/if}>
                        {$item1.$name}
                    </a>
                    {if $item1.$childs}
                      <label for="{$unique_elm_id1}">sdsadas</label>
                    {/if}
                  </div>
                    
                  {if $item1.$childs}
                    <input id="{$unique_elm_id1}" type="checkbox">
                    <nav>
                      <main>
                        <menu>
                          <menuitem>
                            <span class="heading"><label class="menu-back" for="{$unique_elm_id1}">Back</label>  {$item1.$name}</span>
                            {assign var="cat_image" value=$item1.category_id|fn_get_image_pairs:'category':'M':true:true}
                            {include file="common/image.tpl"
                            images=$cat_image
                            no_ids=true
                            image_id="category_image"
                            image_width=$settings.Thumbnails.category_lists_thumbnail_width
                            image_height=$settings.Thumbnails.category_lists_thumbnail_height
                            class="ty-subcategories-img"
                            }
                          </menuitem>

                          {foreach from=$item1.$childs item="item2" name="item2"}
                            {assign var="item2_url" value=$item2|fn_form_dropdown_object_link:$block.type}
                            {assign var="unique_elm_id2" value="mb_menu_`$block.block_id`_`$item2_url|md5`"}

                            <menuitem>
                              <div class="item-line{if $item2.$childs} hc{/if}">
                                <a href="{$item2_url}"{if $item2.new_window} target="_blank"{/if}>
                                    {$item2.$name}
                                </a>
                                {if $item2.$childs}                                  
                                  <label for="{$unique_elm_id2}"></label>
                                {/if}
                              </div>
                              {if $item2.$childs}
                                <input id="{$unique_elm_id2}" type="checkbox">
                                <nav>
                                  <main>
                                    <menu>
                                      <menuitem>
                                        <span class="heading"><label class="menu-back" for="{$unique_elm_id2}">Back</label> {$item2.$name}</span>
                                      </menuitem>
                                      {foreach from=$item2.$childs item="item3" name="item3"}
                                        {assign var="item3_url" value=$item3|fn_form_dropdown_object_link:$block.type}
                                        {assign var="unique_elm_id3" value="mb_menu_`$block.block_id`_`$item3_url|md5`"}

                                        <menuitem>
                                          <div class="item-line{if $item3.$childs} hc{/if}">
                                          <a href="{$item2_url}"{if $item2.new_window} target="_blank"{/if}>
                                              {$item3.$name}
                                          </a>
                                         </div>
                                        </menuitem>
                                      {/foreach}
                                       {$feat_designers =''}
            {$feat_designers = fn_my_changes_get_categories_brand($item2.category_id)}                                   
            <ul class="static_cat_link"><h5>{__("featured_designers")}</h5>
             {if !($item2.category_id == 502 || $item2.category_id == 613 || $item2.category_id == 622 || $item2.category_id == 723) }   
            {$n =0}
            {foreach from=$feat_designers item="feat_designer" name="feat_designer"}
            {$n = $n+1}

               {*<li class="categ_brand {if $n > 10}hidden{/if}">
               <a href="{"companies.products?company_id=`$company.company_id`?feature_hash=10_`$feat_designer.variant_id`"|fn_url}" class="company-location"><bdi>{$categ_brand.variant nofilter}</bdi></a>
               </li>*}
                <li class="categ_brand {if $n > 10}hidden{/if}">
                   {if $n < 16} 
                <a href="{"categories.view&category_id=`$item2.category_id`?features_hash=10-`$feat_designer.variant_id`"|fn_url}">{$feat_designer.variant}</a>{/if}
            </li>                   
            {/foreach}
                {if $n > 10}<span class="display_more_brand">view more <i class="text-arrow">→</i></span>{/if}
             {else}
               {assign var="aa11" value=$item1.category_id}
             <div class = "search_by_alphabets">
            <div style="text-align:center;width:45px" class="jsx-1241051148"><a href="{"product_features.view_all&filter_id=10&#0-9"|fn_url}" class="jsx-1241051148 alphabet-letter">0-9</a></div>
                <div style="text-align:center;width:20px" class="jsx-1241051148"><a href="{"product_features.view_all&filter_id=10&#A"|fn_url}" class="jsx-1241051148 alphabet-letter">A</a></div>
                <div style="text-align:center;width:20px" class="jsx-1241051148"><a href="{"product_features.view_all&filter_id=10&#B"|fn_url}" class="jsx-1241051148 alphabet-letter">B</a></div>
                <div style="text-align:center;width:20px" class="jsx-1241051148"><a href="{"product_features.view_all&filter_id=10&#C"|fn_url}" class="jsx-1241051148 alphabet-letter">C</a></div>
                <div style="text-align:center;width:20px" class="jsx-1241051148"><a href="{"product_features.view_all&filter_id=10&#D"|fn_url}" class="jsx-1241051148 alphabet-letter">D</a></div>
                <div style="text-align:center;width:20px" class="jsx-1241051148"><a href="{"product_features.view_all&filter_id=10&#E"|fn_url}" class="jsx-1241051148 alphabet-letter">E</a></div>
                <div style="text-align:center;width:20px" class="jsx-1241051148"><a href="{"product_features.view_all&filter_id=10&#F"|fn_url}" class="jsx-1241051148 alphabet-letter">F</a></div>
                <div style="text-align:center;width:20px" class="jsx-1241051148"><a href="{"product_features.view_all&filter_id=10&#G"|fn_url}" class="jsx-1241051148 alphabet-letter">G</a></div>
                <div style="text-align:center;width:20px" class="jsx-1241051148"><a href="{"product_features.view_all&filter_id=10&#H"|fn_url}" class="jsx-1241051148 alphabet-letter">H</a></div>
                <div style="text-align:center;width:20px" class="jsx-1241051148"><a href="{"product_features.view_all&filter_id=10&#I"|fn_url}" class="jsx-1241051148 alphabet-letter">I</a></div>
                <div style="text-align:center;width:20px" class="jsx-1241051148"><a href="{"product_features.view_all&filter_id=10&#J"|fn_url}" class="jsx-1241051148 alphabet-letter">J</a></div>
                <div style="text-align:center;width:20px" class="jsx-1241051148"><a href="{"product_features.view_all&filter_id=10&#K"|fn_url}" class="jsx-1241051148 alphabet-letter">K</a></div>
                <div style="text-align:center;width:20px" class="jsx-1241051148"><a href="{"product_features.view_all&filter_id=10&#L"|fn_url}" class="jsx-1241051148 alphabet-letter">L</a></div>
                <div style="text-align:center;width:20px" class="jsx-1241051148"><a href="{"product_features.view_all&filter_id=10&#M"|fn_url}" class="jsx-1241051148 alphabet-letter">M</a></div>
                <div style="text-align:center;width:20px" class="jsx-1241051148"><a href="{"product_features.view_all&filter_id=10&#N"|fn_url}" class="jsx-1241051148 alphabet-letter">N</a></div>
                <div style="text-align:center;width:20px" class="jsx-1241051148"><a href="{"product_features.view_all&filter_id=10&#O"|fn_url}" class="jsx-1241051148 alphabet-letter">O</a></div>
                <div style="text-align:center;width:20px" class="jsx-1241051148"><a href="{"product_features.view_all&filter_id=10&#P"|fn_url}" class="jsx-1241051148 alphabet-letter">P</a></div>
                <div style="text-align:center;width:20px" class="jsx-1241051148"><a href="{"product_features.view_all&filter_id=10&#Q"|fn_url}" class="jsx-1241051148 alphabet-letter">Q</a></div>
                <div style="text-align:center;width:20px" class="jsx-1241051148"><a href="{"product_features.view_all&filter_id=10&#R"|fn_url}" class="jsx-1241051148 alphabet-letter">R</a></div>
                <div style="text-align:center;width:20px" class="jsx-1241051148"><a href="{"product_features.view_all&filter_id=10&#S"|fn_url}" class="jsx-1241051148 alphabet-letter">S</a></div>
                <div style="text-align:center;width:20px" class="jsx-1241051148"><a href="{"product_features.view_all&filter_id=10&#T"|fn_url}" class="jsx-1241051148 alphabet-letter">T</a></div>
                <div style="text-align:center;width:20px" class="jsx-1241051148"><a href="{"product_features.view_all&filter_id=10&#U"|fn_url}" class="jsx-1241051148 alphabet-letter">U</a></div>
                <div style="text-align:center;width:20px" class="jsx-1241051148"><a href="{"product_features.view_all&filter_id=10&#V"|fn_url}" class="jsx-1241051148 alphabet-letter">V</a></div>
                <div style="text-align:center;width:20px" class="jsx-1241051148"><a href="{"product_features.view_all&filter_id=10&#W"|fn_url}" class="jsx-1241051148 alphabet-letter">W</a></div>
                <div style="text-align:center;width:20px" class="jsx-1241051148"><a href="{"product_features.view_all&filter_id=10&#X"|fn_url}" class="jsx-1241051148 alphabet-letter">X</a></div>
                <div style="text-align:center;width:20px" class="jsx-1241051148"><a href="{"product_features.view_all&filter_id=10&#Y"|fn_url}" class="jsx-1241051148 alphabet-letter">Y</a></div>
                <div style="text-align:center;width:20px" class="jsx-1241051148"><a href="{"product_features.view_all&filter_id=10&#Z"|fn_url}" class="jsx-1241051148 alphabet-letter">Z</a></div>
                <div style="text-align:center;width:200px" class="jsx-1241051148"><a href="{"product_features.view_all&filter_id=10&cat=`$aa11`"|fn_url}" class="jsx-1241051148 alphabet-letter"><span class="display_more_brand">view more <i class="text-arrow">→</i></span></a></div>                
            </div>

             {/if}   
        </ul>
                                    </menu>
                                  </main>
                                </nav>
                              {/if}
                            </menuitem>
                          {/foreach}

                        </menu>
                      </main>
                    </nav>
                    {/if}
                </menuitem>
              {/foreach}
            </menu>
            <div class="ty-account-info__buttons buttons-container drawer-menu-login-btns">
        <a href="https://dev.thedelamode.com/login/?return_url=index.php" class="ty-btn ty-btn__secondary thedelamode_login_btn" rel="nofollow">Sign in</a>
    <a href="https://dev.thedelamode.com/profiles-add/" rel="nofollow" class="ty-btn ty-btn__primary ">Register</a>
    </div>
          </main>
        </nav>
    </form>
</div>
