{*$wishlist_count = count($smarty.session.wishlist.products)*}
{$wishlist_count = fn_wishlist_get_count()}
<div class="ty-account-info__item ty-dropdown-box__item">
<a class="ty-account-info__a" href="{"wishlist.view"|fn_url}" rel="nofollow">
{if $wishlist_count > 0} <i class="fa fa-heart-o"></i> <span class="wish_products_count">{$wishlist_count}</span> 
{else} 
<i class="fa fa-heart-o"></i><span class="wish_products_count">0</span>
{/if}
</a>
</div>

