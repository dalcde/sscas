// -*- js-indent-level: 4; indent-tabs-mode: nil -*-
const FIELDS = ['ENNAME',
                'CHNAME',
                'SCHHOUSE',
                'CLASSCODE',
                'CLASSNO',
                'SEX'];

$(function() {
    $("#input").submit(function() {
        $.ajax({
            type: "POST",
            url: "pages/input-process.php",
            data: "REGNO="+$("#REGNO").val(),
            dataType: 'json',
            success: function(data) {
                var id = $("#REGNO").val();
                if (data) {
                    for (var i in FIELDS) {
			$('#' + FIELDS[i]).html(data[FIELDS[i]]);
		    }
		    $('#photo').html("<img src=\"photos/"+id+".JPG\" alt=\"No photo found: "+id+"\"width=\"236\" height=\"295\"/>");

		    if (data["duplicate"]) {
			alert("Student "+ id + " already entered");
		    }
		} else {
		    alert("Student " + id + " does not exist");
		    for (var i in FIELDS) {
			$('#' + FIELDS[i]).html("");
			$('#photo').html("");
		    }
		}
		$("#REGNO").select();
	    }
        });
        return false;
    });
});
