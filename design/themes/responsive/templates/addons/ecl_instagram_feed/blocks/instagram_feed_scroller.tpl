{assign var=instagram_feed value=$block.properties.hashtag|fn_ecl_instagram_feed_get_data:$block.properties.posts_amount}

{if $instagram_feed}
{$obj_prefix = "`$block.block_id`000"}

{if $block.properties.outside_navigation == "Y"}
    <div class="owl-theme ty-owl-controls">
        <div class="owl-controls clickable owl-controls-outside"  id="owl_outside_nav_{$block.block_id}">
            <div class="owl-buttons">
                <div id="owl_prev_{$obj_prefix}" class="owl-prev"><i class="ty-icon-left-open-thin"></i></div>
                <div id="owl_next_{$obj_prefix}" class="owl-next"><i class="ty-icon-right-open-thin"></i></div>
            </div>
        </div>
    </div>
{/if}

<div id="scroll_list_{$block.block_id}" class="owl-carousel ty-scroller-list">
    {foreach from=$instagram_feed.pictures item=picture key=key}
        <div class="ty-scroller-list__item">
            <div class="ty-grid-list__item ty-instagram-grid-list__item">
                <a href="{$smarty.const.INSTAGRAM_PICTURES_URL}{$picture.code}" target="_blank"><img src="{$picture.thumbnail_src}" /></a>
                {if $block.properties.display_likes_count == 'Y' || $block.properties.display_comments_count == 'Y' || $block.properties.display_photo_description == 'Y'}
                <div class="ty-instagram-content">
                    <div class="ty-instagram-content-inner">
                        {if $block.properties.display_likes_count == 'Y' && isset($picture.likes_count)}
                            <a class="ty-instagram-likes" href="{$smarty.const.INSTAGRAM_PICTURES_URL}{$picture.code}" target="_blank"><i class="ty-icon-heart"></i>{$picture.likes_count}</a>
                        {/if}
                        {if $block.properties.display_comments_count == 'Y' &&  isset($picture.comments_count)}
                            <a class="ty-instagram-comments" href="{$smarty.const.INSTAGRAM_PICTURES_URL}{$picture.code}" target="_blank"><i class="ty-icon-bubble"></i>{$picture.comments_count}</a>
                        {/if}
                        {if $block.properties.display_photo_description == 'Y'}
                        <p class="ty-instagram-text">{$picture.caption nofilter}</p>
                        {/if}
                    </div>
                </div>
                {/if}
            </div>    
        </div>
    {/foreach}
</div>

{include file="common/scroller_init.tpl" prev_selector="#owl_prev_`$obj_prefix`" next_selector="#owl_next_`$obj_prefix`"}

<style>
{$prop = "theme_editor.background"}
#scroll_list_{$block.block_id} .ty-instagram-grid-list__item:hover div {
    background: {$block.properties.$prop|default:'#369ff3'};
}
#scroll_list_{$block.block_id} .ty-instagram-grid-list__item img {
    height: calc(1200px / {$block.properties.item_quantity|default:5} - 20px);
    object-fit: cover;
}
</style>
{/if}