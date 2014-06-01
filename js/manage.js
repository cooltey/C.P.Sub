/**
 * 2013/10/16 Manage Page Javascript
 * Author: Cooltey Feng
 *
 */
 
 $(function () {
    $("#add_more_file").click(function(){
		var getForm = $("#article_file").clone();
		$("#article_file").after(getForm);
	});
 })
 