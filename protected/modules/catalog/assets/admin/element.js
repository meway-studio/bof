/**
 * Scripts for js tree
 */
$('#CatalogCategoryTree').delegate("a", "click",function(event) {
	// On link click get parent li ID and redirect to category update action
	var id = $(this).parent("li").attr('id').replace('CatalogCategoryTreeNode_', '');
	$('#CatalogElement_category_id').val(id);
});