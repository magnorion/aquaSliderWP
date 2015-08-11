<?php
	 add_action ( 'admin_enqueue_scripts', function () {
        if ( is_admin () ){
        	wp_enqueue_media ();
        }
    });
?>
<div id="aqua-slider-setup">
	<div id="aqua-slider-admin-box">
		<div class="wrap">
			<h2 style="margin-bottom: 10px;"> Configurações do Aqua Slider </h2>
			<div id="aqua-slider-box-param">
				<h3> Parâmetros </h3>
				<form id="aqua-slider-config" action="#" name="aqua-slider-config">
					<div><label> width: </label> <input placeholder="Largura" type="text" class="aqua-input-config" name="width" /></div>
					<p> Largura do slider. (Fixo ou %) </p>
					<div><label> height: </label> <input type="text" placeholder="Altura" class="aqua-input-config" name="height" /></div>
					<p> Altura do slider. (Fixo ou %) </p>
					<div>
						<label> bullet: </label> 
						<select name="bullet" class="aqua-input-config">
							<option value="number">Numérico</option>
							<option value="image">Imagem</option>
						</select>
					</div>
					<p> O tipo de contador do slider. </p>
					<div><label> animation: </label> <input type="text" placeholder="Tempo" class="aqua-input-config" name="animation" /></div>
					<p> Tempo para transição quando o slider estiver automático. </p>
					<div>
						<label> control: </label> 
						<select name="control" class="aqua-input-config">
							<option value="on">Ligado</option>
							<option value="off">Desligado</option>
						</select>
					</div>
					<p> Ativar ou desativar as setas do slider. </p>
					<div>
						<label> autoPlay: </label>
						<select name="autoPlay" class="aqua-input-config">
							<option value="on">Ligado</option>
							<option value="off">Desligado</option>
						</select>
					</div>
					<p> Ativar ou desaviar o auto player. </p>
					<button class="aqua-slider-btn-config" id="aqua-slider-send-params"> Atualizar Parâmetros </button>
					<div id="aqua-slider-box-code">
							<label> Ativar Slider: </label><br/>
							<p> Adicione na página que o slider deve aparecer! </p>
							<code> 
								aquaSlider(); 
							</code>
					</div>
			</div>
			<div id="aqua-slider-box-image">
				<div class="aqua-select-image">
					<h3> Imagens </h3>
					<p> ( Imagens com posição 0 não aparecerão no slider! ) </p>
					<button class="aqua-slider-btn-config" id="aqua-slider-add-image"> Nova Imagem </button>
					<div class="aqua-slider-new-image" style="display: none;opacity:0">
						<a href="#" id="aqua-slider-media-libray" style="float: left;" class="button">Biblioteca</a>
						<a href="#" class="button" style="float: left;background-color: #DF5353;color: #fff;border-color: #DF5353;margin-left: 10px;box-shadow:none" id="close-new-image-box"> x </a>
						<br/>
						<div><label> Imagem url: </label> <input readonly type="text" placeholder="http://..." class="aqua-input-config aqua-slider-image-config" id="aqua-slider-image-input" name="new_image_url" /></div>
						<div><label> Link: </label> <input type="text" placeholder="http://..." class="aqua-input-config aqua-slider-image-config" name="new_image_link" /></div>
						<div>
							<label id="aqua-image-title" style="opacity:0"> Imagem: </label> 
							<div class="aqua-slider-image-displayer">
								<img style="display:none;opacity:0" src="" />
							</div>
						</div>
						<div>
							<a href="#" style="opacity:0" class="aqua-slider-new-image-btn"> + Adicionar Imagem </a>
						</div>
					</div>
					<div id="aqua-slider-all-image-display" style="opacity: 0; height: 0px; overflow-y: hidden;">				
					</div>
					<button class="aqua-slider-btn-config" id="aqua-slider-send-images" style="margin-top: 10px;"> Atualizar Imagens </button>
				</div>
			</div>
			</form> <!-- Finaliza o form -->
		</div>
		<div class="aqua-slider-box-info">
			<span></span>
		</div>
	</div>
</div>
</div>
<style>
	#wpfooter{
		display: none;
	}
</style>