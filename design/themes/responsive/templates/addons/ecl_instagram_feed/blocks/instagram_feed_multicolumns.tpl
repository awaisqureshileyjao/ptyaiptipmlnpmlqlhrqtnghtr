{assign var=instagram_feed value=$block.properties.hashtag|fn_ecl_instagram_feed_get_data:$block.properties.posts_amount}

{if $instagram_feed}
{assign var=columns value=$block.properties.number_of_columns|default:3}
{split data=$instagram_feed.pictures size=$columns assign="splitted_pictures"}

<div id="insta_list_{$block.block_id}" class="grid-list">
    <div class="ty-grid-list__item">
        <div class="grid-list">
            {foreach from=$splitted_pictures item=splitted_picture}
                {foreach from=$splitted_picture item=picture}
                    {if $picture}
                    <div class="ty-column{$columns}">
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
                    {/if}
                {/foreach}
            {/foreach}
        </div>
    </div>
</div>

<style>
{$prop = "theme_editor.background"}
#insta_list_{$block.block_id} .ty-instagram-grid-list__item:hover div {
    background: {$block.properties.$prop|default:'#369ff3'};
}
</style>
{/if}