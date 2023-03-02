{** block-description:blog.recent_posts **}

{if $subitems}
<div class="ty-blog-sidebox">
    <ul class="ty-blog-sidebox__list">
        {foreach from=$items item="page"}
            <li class="ty-blog__item">
                {if $page.main_pair}
                        <div class="ty-blog__img-block">
                            <a href="{"pages.view?page_id=`$page.page_id`"|fn_url}">
                            {include file="common/image.tpl" image_width="100" image_height="100" obj_id=$page.page_id images=$page.main_pair}
                            </a>
                        </div>
                    {/if}
                    {if $page.page}
                        <div class="ty-blog__cont-block">
                            <h5 class="ty-blog-post_title"><a href="{"pages.view?page_id=`$page.page_id`"|fn_url}">{$page.page}</a></h5>
                            <span class="blog_post_time">{$page.timestamp|date_format:"%D"}</span>
                        </div>
                    {/if}    
            </li>    
        {/foreach}        
    </ul>
</div>
{else}
{if $subpages}
<div class="blog_page_header"><h3> Recent Posts</h3></div>
{/if}
<div class="ty-blog-sidebox">
    <ul class="ty-blog-sidebox__list">
        {$_count = 0}
        {foreach from=$subpages item="subpage" key="sp_key"}
        {if $_count < 4}
            <li class="ty-blog__item {$sp_key}">
                {if $subpage.main_pair}
                        <div class="ty-blog__img-block">
                            <a href="{"pages.view?page_id=`$subpage.page_id`"|fn_url}">
                            {include file="common/image.tpl" image_width="100" image_height="100" obj_id=$subpage.page_id images=$subpage.main_pair}
                            </a>
                        </div>
                    {/if}
                    {if $subpage.page}
                        <div class="ty-blog__cont-block">
                            <h5 class="ty-blog-post_title"><a href="{"pages.view?page_id=`$subpage.page_id`"|fn_url}">{$subpage.page}</a></h5>
                            <span class="blog_post_time">{$subpage.timestamp|date_format:"%D"}</span>
                        </div>
                    {/if}    
            </li> 
                {$_count = $_count +1}
            {/if}   
        {/foreach}        
    </ul>
</div>
{/if}


