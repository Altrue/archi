function addOrDelete(id){
	if(document.getElementById('check'+id).checked == true){
        $.ajax({
			url: 'ajout',
			type: 'POST',
			async: true,
			data: {
				tzId : id
			}
		}).error(function(){
			$('#alert').remove();
			$('<div></div>', {
				'class': 'alert alert-danger alert-dismissable',
				'id' : 'alert',
				'style' : 'width:300px;float:right;height:30px;padding:3px;margin:0;',
				html: '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Une erreur c&apos;est produite !'
			}).insertAfter($('#check'.id));
		});
    }
    else{
        $.ajax({
			url: 'delete',
			type: 'POST',
			async: true,
			data: {
				tzId : id
			}
		}).error(function(){
			$('#alert').remove();
			$('<div></div>', {
				'class': 'alert alert-danger alert-dismissable',
				'id' : 'alert',
				'style' : 'width:300px;float:right;height:30px;padding:3px;margin:0;',
				html: '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Une erreur c&apos;est produite !'
			}).insertAfter($('#check'+id));
		});
    }
}