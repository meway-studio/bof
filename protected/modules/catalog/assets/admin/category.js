$('#CatalogCategoryTree').delegate("a", "click",function(event) {
	// On link click get parent li ID and redirect to category update action
	var id = $(this).parent("li").attr('id').replace('CatalogCategoryTreeNode_', '');
	window.location = '/catalog/admin/category/index/id/' + id;
}).bind("move_node.jstree", function(e, data) {
	data.rslt.o.each(function(i) {
		$.ajax({
			async: false,
			type: 'GET',
			url: "/catalog/admin/category/moveNode",
			data: {
				"id": $(this).attr("id").replace('CatalogCategoryTreeNode_', ''),
				"ref": data.rslt.cr === -1 ? 1 : data.rslt.np.attr("id").replace('CatalogCategoryTreeNode_', ''),
				"position": data.rslt.cp + i
			}
			//            success : function (r) {
			//            }
		});
	});
});

function CategoryRedirectToFront (obj) {
	var id = $(obj).attr("id").replace('CatalogCategoryTreeNode_', '');
	window.open('/catalog/admin/category/redirect/id/' + id, '_blank');
}