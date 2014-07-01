$(document).ready(function() {
	var setting = {
		data: {
			simpleData: {
				enable: true
			}
		}
	};
	$.fn.zTree.init($("#member-tree"), setting, treeData).expandAll(true);
});
