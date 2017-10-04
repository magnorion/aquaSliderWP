(function($){
	$(document).ready(function(){
		// admin height
		var param_size = Number($("#aqua-params-admin").height());
		$("#aqua-admin-body").css({"height":param_size+100});
		// ---

		//Check images when starts ---
		$.ajax({
			url:ajaxurl,
			method:"GET",
			data:{
				action:"get_all_images"
			}
		}).done(function(data){
			var json = JSON.parse(data);
			if(typeof(json.msg) == 'undefined'){
				var count = json.length;
				var index;
				var key;
				for(index = 1; index <= count; index++){
					key = index - 1;
					var obj = {
						url: json[key].url,
						link: json[key].link,
						pos: json[key].position
					};
					var builder = "<div class='aqua-box-image' aqua-box-position='"+obj.pos+"'>"
						+"<div class='aqua-image-display'>"
							+"<div class='aqua-overlay'></div>"
							+"<img link-url='"+obj.link+"' src='"+obj.url+"' />"
						+"</div>"
						+"<div class='aqua-data-display'>"
							+"<div class='btn-data-position'>"
								+"<span><i class='fa fa-picture-o'></i> <label>"+obj.pos+"</label></span>"
								+"<span title='Editar' class='aqua-btn-img aqua-img-edit'><i class='fa fa-pencil'></i></span>"
								+"<span title='Remover' class='aqua-btn-img aqua-img-del'><i class='fa fa-trash-o'></i></span>"
							+"</div>"
							+"<div class='img-drop-icon'></div>"
						+"</div>"
					+"</div>";
					$("#aqua-images-content").append(builder);
				}
			}
			check_images();
		});
		// ---

		// Params ---
		$.ajax({
			url:ajaxurl,
			method:"GET",
			data:{
				action:"get_all_params"
			}
		}).done(function(data){
			var json = JSON.parse(data);
			if(json.msg == "Existe!"){
				$("input[name='aqua-slider-width']").val(json.params.width);
				$("input[name='aqua-slider-height']").val(json.params.height);
				$("select[name='aqua-slider-bullet']").val(json.params.bullet);
				$("input[name='aqua-slider-animation']").val(json.params.animation);
				$("select[name='aqua-slider-control']").val(json.params.control);
				$("select[name='aqua-slider-autoPlay']").val(json.params.autoPlay);
				$("select[name='aqua-slider-type']").val(json.params.effect);
			}
		});
		// ---

		// Media WP ---
		
		file_frame = wp.media.frames.file_frame = wp.media({
			title:    "Insert Media",    // For production, this needs i18n.
			button: {
				text: "Upload Image"     // For production, this needs i18n.
			},
			multiple: false
		});

		var image_data;
		file_frame.on( 'select', function() {
			image_data = file_frame.state().get( 'selection' ).first().toJSON();
			imgurl = image_data.url;
			$("#img-url").val(imgurl);
			console.log(imgurl);
		});

		$('#aqua-slider-media-libray').click(function() {
			file_frame.open();
			return false;
		});
		// ---

		$("#aqua-images-content").sortable({
			cancel: "#no_img_alert",
			deactivate: function(){
				var self = $(this);
				var index = 1;
				self.find(".aqua-box-image").each(function(){
					var box = $(this);
					box.attr("aqua-box-position",index);
					box.find(".aqua-data-display label").text(index);
					index++;
				});
			}
		});
		//Remove a image ---
		$("#aqua-images-content").on("click",".aqua-box-image .aqua-data-display .aqua-img-del",function(){
			var self = $(this).parents(".aqua-data-display").parents(".aqua-box-image");
			var ask_del = confirm("Deseja remover esta imagem?");
			if(ask_del){
				var img = {
					url: self.find(".aqua-image-display img").attr("src"),
					pos: self.find(".aqua-data-display span label").text()
				};
				$.ajax({
					url:ajaxurl,
					method:"POST",
					data:{
						action:"remove_image",
						img_data:img
					}
				}).done(function(data){
					var json = JSON.parse(data);
					if(json.msg = "Imagem deletada!"){
						self.attr("aqua-box-position","").animate({opacity:0},1000,function(){
							self.remove();
							callAlert("Imagem removida!");
							check_images();
						});
					}else{
						console.log(json);
					}
				});
			}
		});
		// ---

		//Edit image ---
		$("#aqua-images-content").on( "click",".aqua-box-image .aqua-data-display .aqua-img-edit",function() {
	    	var data = $(this).parents(".aqua-data-display").parents(".aqua-box-image");
	    	getImgData(data);
	    	modal.dialog( "open" );
	    });
		// ---

		// Params form
		$("#aqua-btn-params").on("click",function(e){
			e.preventDefault();
			var params = {
				width: $("input[name='aqua-slider-width']").val(),
				height: $("input[name='aqua-slider-height']").val(),
				bullet: $("select[name='aqua-slider-bullet']").val(),
				animation: $("input[name='aqua-slider-animation']").val(),
				control: $("select[name='aqua-slider-control']").val(),
				autoPlay: $("select[name='aqua-slider-autoPlay']").val(),
				effect: $("select[name='aqua-slider-effect']").val()
			}
			$.ajax({
				url:ajaxurl,
				method:"POST",
				data:{
					action:"send_all_params",
					params:params
				}
			}).done(function(data){
				callAlert("Parâmetros atualizados!");
			});
		});


		//modal
		var img_data;
		var old_img;
		function getImgData(data){
			var self = data;
			if(self == 0){
				$("#aqua-admin-image-btn").attr("btn-type","create").text("Adicionar Imagem");
				img_data = {
					url: "",
					link: ""
				};
			}else{
				$("#aqua-admin-image-btn").attr("btn-type","update").text("Atualizar Imagem");
				img_data = {
					url: $(self).find(".aqua-image-display img").attr("src"),
					link: $(self).find(".aqua-image-display img").attr("link-url")
				};
			}
			return img_data;
		}
		var modal = $("#aqua-image-config").dialog({
			autoOpen: false,
			modal:true,
			height: 300,
			width: 500,
			closeText: "x",
			resizable: false,
			position: { my: 'top', at: 'top+150' },
			open:function(){
				var modal = $("#aqua-image-config");
				modal.find("input[name='aqua-img-url']").val(img_data.url);
				modal.find("input[name='aqua-img-link']").val(img_data.link);
				old_img = $("input[name='aqua-img-url']").val(); //Get the old image ---
			}
		});
	    // ---

	    //New Image
	    $("#aqua-admin-btn-new-img").on("click",function(){
	    	getImgData(0);
	    	modal.dialog( "open" );
	    });
	    // ---

	    //Add/Update Image ---
	    $("#aqua-admin-image-btn").on("click",function(e){
	    	e.preventDefault();
	    	var self = $(this);
	    	var img_data = {
	    		url: $("#aqua-image-config").find("#img-url").val(),
	    		link: $("#aqua-image-config").find("input[name='aqua-img-link']").val(),
	    		type: self.attr("btn-type")
	    	};
	    	if(img_data.url == "")
	    		return false;

	    	if(img_data.type == "create"){
	    		var counter_boxs = Number($(".aqua-box-image").length)+ 1;
	    		var builder = "<div class='aqua-box-image' aqua-box-position='"+counter_boxs+"'>"
					+"<div class='aqua-image-display'>"
						+"<div class='aqua-overlay'></div>"
						+"<img link-url='"+img_data.link+"' src='"+img_data.url+"' />"
					+"</div>"
					+"<div class='aqua-data-display'>"
						+"<span><i class='fa fa-picture-o'></i> <label>"+counter_boxs+"</label></span>"
						+"<span title='Editar' class='aqua-btn-img aqua-img-edit'><i class='fa fa-pencil'></i></span>"
						+"<span title='Remover' class='aqua-btn-img aqua-img-del'><i class='fa fa-trash-o'></i></span>"
						+"<div class='img-drop-icon'></div>"
					+"</div>"
				+"</div>";
				$("#aqua-images-content").append(builder);
				$(".ui-dialog-titlebar-close").trigger("click");
	    	}else if(img_data.type == "update"){
	    		var old_img_box;
	    		$("#aqua-images-content").find(".aqua-box-image").each(function(){
	    			var self = $(this);
	    			if(self.find(".aqua-image-display img").attr("src") == old_img){
	    				old_img_box = self.find(".aqua-image-display img");
	    			}
	    		});
	    		$(".ui-dialog-titlebar-close").trigger("click");
	    		old_img_box.animate({opacity:0},1000,function(){
	    			old_img_box.attr("src",img_data.url).attr("link-url",img_data.link).animate({opacity:1},1000);
	    		});
	    	}
	    	check_images();
	    });
	    // ---

	    var check_img;
	    function check_images(){
    		check_img = $("#aqua-images-content .aqua-box-image").length;
    		if(check_img == 0){
				$("#no_img_alert").css({"display":"block","opacity":1});
			}else{
				$("#no_img_alert").css({"display":"none","opacity":0});
			}
			return check_img;
	    }

	    //Save all Images
	    $("#aqua-admin-btn-save-img").on("click",function(){
	    	check_images();
	    	if(check_img < 1)
	    		return false;

	    	var imgs = { data:[] };
	    	$("#aqua-images-content").find(".aqua-box-image").each(function(){
	    		var self = $(this);
	    		var img_url = self.find(".aqua-image-display img").attr("src");
	    		var img_link = self.find(".aqua-image-display img").attr("link-url");
	    		var img_pos = self.find(".aqua-data-display span label").text();
	    		if(img_pos == "")
	    			return true;

	    		imgs.data.push({
	    			"url":img_url,
	    			"link":img_link,
	    			"pos":img_pos
	    		});
	    	});
	    	
	    	$.ajax({
	    		url:ajaxurl,
	    		method:"POST",
	    		data:{
	    			action:"save_all_images",
	    			data_img:imgs
	    		}
	    	}).done(function(data){
	    		var json = JSON.parse(data);
	    		if(json.msg == "Imagens alteradas!")
	    			callAlert("Imagens atualizadas!");
	    		else
	    			callAlert("Houve algum erro!");
	    	});
	    });
	    // ---

	    //Call alerts
	    function callAlert(data){
	    	var text = data;
	    	var box = $("#aqua-admin-alert");
	    	box.css({"display":"block"}).find("p span").text(text);
	    	var body = $("html, body");
			body.stop().animate({scrollTop:0},200);
	    	box.animate({opacity:1},1000,function(){
	    		setTimeout(function(){
	    			box.animate({opacity:0},1000,function(){box.css({"display":"none"});});
	    		},1000);
	    	});
	    }
	    // --- 
	})
})(jQuery);