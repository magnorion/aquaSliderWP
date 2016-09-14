<style>
	#wpfooter{
		display: none;
	}
</style>
<div id="aqua-admin-body">
	<div id="aqua-admin-title">
		<h2> Configuração do Slider </h2>
		<div id="aqua-admin-alert"> <p> <i class="fa fa-cube"></i> <span></span> </p></div>
		<div id="aqua-admin-newImage">
			<button id="aqua-admin-btn-new-img"> <i class="fa fa-plus"></i> Nova imagem </button>
			<button id="aqua-admin-btn-save-img"> <i class="fa fa-floppy-o"></i> Salvar Imagens </button>
		</div>
	</div>
	<div id="aqua-container-admin">
		<div id="aqua-images-content">
			<p id="no_img_alert"> Não existem imagens para o slider :( </p>
		</div>
		<div id="aqua-params-admin">
			<h3> Partâmetros </h3>
			<form action="#" id="aqua-form-params">
				<div>
					<label> Largura: </label>
					<input type="text" name="aqua-slider-width" />
					<p> Largura do slider. (Fixo ou %)  </p>
				</div>
				<div>
					<label> Altura: </label>
					<input type="text" name="aqua-slider-height" />
					<p> Altura do slider. (Fixo ou %) </p>
				</div>
				<div>
					<label> Contador: </label>
					<select name="aqua-slider-bullet">
						<option value="image"> Imagem </option>
						<option value="number"> Numérico </option>
					</select>
					<p> O tipo de contador do slider.  </p>
				</div>
				<div>
					<label> Animação: </label>
					<input type="text" name="aqua-slider-animation" />
					<p> Tempo para transição quando o slider estiver automático. </p>
				</div>
				<div>
					<label> Controle: </label>
					<select name="aqua-slider-control">
						<option value="on"> Ligado </option>
						<option value="off"> Desligado </option>
					</select>
					<p> Ativar ou desativar as setas do slider. </p>
				</div>
				<div>
					<label> AutoPlay: </label>
					<select name="aqua-slider-autoPlay">
						<option value="on"> Ligado </option>
						<option value="off"> Desligado </option>
					</select>
					<p> Ativar ou desaviar o auto player. </p>
				</div>
				<div>
					<label> Efeito: </label>
					<select name="aqua-slider-effect">
						<option value="fade"> Fade em tiras </option>
						<option value="basic-fade"> Fade básico </option>
						<option value="slice-wave"> Onda </option>
						<option value="slice"> Tiras </option>
					</select>
					<p> Efeito de transição do slider. </p>
				</div>
				<div>
					<button id="aqua-btn-params"> <i class="fa fa-file"></i> Atualizar Parâmetros </button>
				</div>
			</form>
			<div style="height:60px;margin-bottom: 35px;">
				<p style="padding: 0px;margin: 0px;font-weight: bold;"> Ativar Slider: </p>
				<span> Adicione na página que o slider deve aparecer! </span> <br/>
				<code id="aqua-code-box"> aquaSlider(); </code>
			</div>
		</div>
	</div>
	<div id="aqua-image-config">
		<div>
			<label>Url:</label>
			<input type="text" name="aqua-img-url" id="img-url" readonly />
		</div>
		<div>
			<label>Link:</label>
			<input type="text" name="aqua-img-link" placeholder="http://" />
		</div>
		<a href="#" id="aqua-slider-media-libray" style="float: left;" class="button">Biblioteca</a>
		<button style="left:4%;" id="aqua-admin-image-btn" btn-type="none"> Atualizar Imagem </button>
	</div>
</div>
