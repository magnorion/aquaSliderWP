(function($){
	$(document).ready(function(){
		if($("#aqua-slider-box-image").length > 0){
			update_height_wp();
		}

		function update_height_wp(){
			var new_size = $("#aqua-slider-box-image").height();
			new_size;
			$("#wpbody").height(new_size);
		}

		$("#aqua-slider-add-image").click(function(e){
			e.preventDefault();
			$(".aqua-slider-new-image").css({"display":"block"}).animate({
				opacity:1
			},1000);
			update_height_wp();
			return false;
		});

		$('#aqua-slider-media-libray').click(function() {
			formfield = $('#upload_image').attr('name');
			tb_show('', 'media-upload.php?type=image&TB_iframe=true');
			return false;
		});

		function show_image(){
			$(".aqua-slider-new-image img").css({"opacity":0,"display":"none"}); //Reset the css		
			var aqua_image_display = $(".aqua-slider-new-image img");
			
			$("#aqua-image-title,.aqua-slider-new-image-btn").css({"opacity":1});
			aqua_image_display.attr("src",imgurl).css({"display":"block"}).animate({opacity:1},1000);
		}


		function aqua_slider_close_new_image(){
			$(".aqua-slider-new-image").animate({"opacity":0},500,function(){
				$(".aqua-slider-new-image img").css({"opacity":0,"display":"none"});
				$("#aqua-image-title,.aqua-slider-new-image-btn").css({"opacity":0});
				var aqua_image_display = $(".aqua-slider-new-image img");
				aqua_image_display.attr("src","");
				$("#aqua-slider-image-input").val("");
				$("input[name='new_image_link']").val("");
				$(".aqua-slider-new-image").css({"display":"none"});
				update_height_wp();
			});
		}

		$("#close-new-image-box").on("click",function(){
			aqua_slider_close_new_image();
		});

		window.send_to_editor = function(html) {
			$(".tb-close-icon").trigger("click"); // Close the wp media libray
			
			$("#aqua-slider-image-input").val("");
			imgurl = $('img',html).attr('src');
			$("#aqua-slider-image-input").val(imgurl);
			show_image();
			update_height_wp();
		}


		//Ajax ( Get All Params )
		$.ajax({
			url:ajaxurl,
			method:"GET",
			data:{
				action:"aqua_slider_get_all_params"
			}
		}).success(function(data){
			var json = JSON.parse(data);
			console.log(json);
			if(json.msg){
				return false;
			}else{
				var container = $("#aqua-slider-box-param");
				container.find("input[name='width']").val(json.width);
				container.find("input[name='height']").val(json.height);
				container.find("select[name='bullet']").val(json.bullet);
				container.find("input[name='animation']").val(json.animation);
				container.find("select[name='player']").val(json.player);
				container.find("select[name='control']").val(json.control);
				container.find("select[name='autoPlay']").val(json.autoPlay);
			}
		});

		// Ajax ( New image ) ---
		$(".aqua-slider-new-image-btn").click(function(e){
			e.preventDefault();
			var aqua_slider_newImage = $("input[name='new_image_url']").val();
			var aqua_slider_newLink = $("input[name='new_image_link']").val();
			$.ajax({
				url:ajaxurl,
				method:"GET",
				data:{
					action:"aqua_slider_image_insert",
					img_url:aqua_slider_newImage,
					img_link:aqua_slider_newLink
				}
			}).success(function(data){
				json = JSON.parse(data);
				if(json.status == 200){
					aqua_slider_close_new_image();
					get_all_images();
				}
				$(".aqua-slider-box-info span").text(json.msg);
				aqua_slider_box_info();
			});
		});

		// Ajax ( Get all images )
		function get_all_images(){
			var self = $("#aqua-slider-all-image-display");
			self.animate({"opacity":0,"height":0},1000,function(){
				self.empty();
				$.ajax({
					url:ajaxurl,
					method:"GET",
					data:{
						action:"aqua_slider_get_all_images"
					}
				}).success(function(data){
					var json = JSON.parse(data);
					var counter = json.length;
					var container_size;
					if(typeof(json.msg) != 'undefined')
						return false;
					var select_build = "";
					for(i=1;i<=counter;i++){
						select_build += "<option value='"+i+"'>"+i+"</option>";
					}

					for(i=0;i<=counter;i++){
						// Json data ---
						if(typeof(json[i]) == 'undefined' || json[i].url == 'null' )
							break;

						var url = json[i].url;
						var link = json[i].link;
						var position = json[i].position;

						// DOM ---
						var aqua_slider_image_container = $("#aqua-slider-all-image-display");
						var div_children = $("<div>").addClass("aqua-slider-img-use");
						
						aqua_slider_image_container.append(div_children);
						div_children.html('\
							<div><label> Posição: </label><select name="position"><option value="'+ position +'"> '+ position +' </option>'+select_build+'</select></div>\
							<div><label> Imagem url: </label> <input readonly type="text" placeholder="http://..." class="aqua-input-config aqua-slider-image-config" value='+url+' name="url" /></div>\
							<div><label> Link: </label> <input type="text" placeholder="http://..." class="aqua-input-config aqua-slider-image-config" value="'+link+'" name="link" /></div>\
							<div>\
								<label id="aqua-image-title"> Imagem: </label> \
								<div class="aqua-slider-image-displayer">\
									<img src="'+url+'" />\
								</div>\
							</div>\
							<div><label></label> <a href="#" aqua-delete-item="'+i+'" class="aqua-slider-remove-image" style="float:right;margin-top:10px"> x Remover Imagem </a> </div>\
						');
					}
					counter_size = Number($(".aqua-slider-img-use").height());
					counter_qtd = Number($(".aqua-slider-img-use").length);

					container_size = (counter_size * counter_qtd);
					var current_container_size = $(".aqua-select-image").height();
					container_size =  container_size + current_container_size;

					$("#aqua-slider-all-image-display").animate({"height":container_size},1000,function(){
						$("#aqua-slider-all-image-display").animate({opacity:1},500);
						update_height_wp();
					});
				});
			});
		}// Get all the images from BD ---
		get_all_images();

		$("#aqua-slider-all-image-display").on("click",".aqua-slider-img-use .aqua-slider-remove-image",function(e){
			e.preventDefault();
			var self = $(this).parents("div").parents(".aqua-slider-img-use");// Parent Container ---
			var url_image = self.find(".aqua-slider-image-displayer img").attr("src");
			var aqua_slider_delete_confirm = confirm("Deseja remover esta imagem?\n "+url_image);
			
			if(!aqua_slider_delete_confirm)
				return false;

			$.ajax({
				url:ajaxurl,
				method:"GET",
				data:{
					action:"aqua_slider_remove_image",
					url: url_image
				}
			}).success(function(data){
				var json = JSON.parse(data);
				$(".aqua-slider-box-info span").text(json.msg);
				aqua_slider_box_info();
				get_all_images();
			});
		});

		//Send all data ---
		function aqua_slider_send_params(){
			var container = $("#aqua-slider-box-param");
			//Inputs
			var params_to_send = {
				"width": container.find("input[name='width']").val(),
				"height": container.find("input[name='height']").val(),
				"bullet": container.find("select[name='bullet']").val(),
				"animation": container.find("input[name='animation']").val(),
				"player": container.find("select[name='player']").val(),
				"control": container.find("select[name='control']").val(),
				"autoPlay": container.find("select[name='autoPlay']").val()
			};
			$.ajax({
				url:ajaxurl,
				method:"POST",
				data:{
					action:"aqua_slider_send_params",
					params: params_to_send
				}
			}).success(function(data){
				var json = JSON.parse(data);
				$(".aqua-slider-box-info span").text(json.msg);
				aqua_slider_box_info();
			});
		}

		$("#aqua-slider-send-params").on("click",function(e){
			e.preventDefault();
			aqua_slider_send_params();
		});

		function aqua_slider_send_images(){
			image_data_array = {"image":[]};
			$("#aqua-slider-box-image .aqua-select-image #aqua-slider-all-image-display").find(".aqua-slider-img-use").each(function(){
				var self = $(this);
				var position = self.find("select[name='position']").val();
				var url = self.find("input[name='url']").val();
				var link = self.find("input[name='link']").val();
				var array = [position,url,link];
				image_data_array.image.push(array);
			});
			counter_all_images = 0;
			counter_all_images = Number(image_data_array.image.length);

			$.ajax({
				url:ajaxurl,
				method:"POST",
				data:{
					action:"aqua_slider_send_images",
					img_array:image_data_array,
					number_images:counter_all_images
				}
			}).success(function(data){
				var json = JSON.parse(data);
				$(".aqua-slider-box-info span").text(json.msg);
				get_all_images();
				aqua_slider_box_info();
			});
		}

		$("#aqua-slider-send-images").on("click",function(e){
			e.preventDefault();
			aqua_slider_send_images();
		});

		// Function call box info --------------
		function aqua_slider_box_info(){
			$(".aqua-slider-box-info").css({"display":"block"});
			var body = $("html, body");
			body.stop().animate({scrollTop:0},500, function() { 
			   $(".aqua-slider-box-info").animate({opacity:1},1000);
			   setTimeout(function(){
			   		$(".aqua-slider-box-info").animate({opacity:0},1000,function(){
			   			$(this).css({"display":"none"});
			   			$(".aqua-slider-box-info span").text("");
			   		});
			   },1100);
			});
		}
	});
})(jQuery);