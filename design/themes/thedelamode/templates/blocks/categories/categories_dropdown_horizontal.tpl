{** block-description:dropdown_horizontal **}

{if $block.snapping_id eq 1121 && $block.block_id eq 155}  
  {include file="blocks/drawer_menu.tpl"}
{/if}


{include file="blocks/topmenu_dropdown.tpl" items=$items name="category" childs="subcategories"}