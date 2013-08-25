$(function() {
    var table = $('#view-all').dataTable({
	"bJQueryUI": true
    });
    table.makeEditable({
	"sUpdateURL": "pages/view-all-edit.php",
	"aoColumns": [null, null, null, null, null, null, {}, null]
    });
});
