<div class="padding">
	<table width="100%">
		<tbody>
			<tr>
				<td width="20%" valign="top">
					<div style="display: none;" class="indicator" id="indicator"></div>
					<div id="payment_type_list">
						<fieldset class="adminform">
							<legend>Lista de Formas de Pago</legend>

							<table>
								<tbody>
									<tr>
										<td>
											<div class="button-menu">
												<div class="page">
													<span> <a
														onclick="new Ajax.Updater({success:'payment_type_list'}, '/paymenttype/editPaymentType/id/1/func/cashbox/use/1/comm/1/cashbox_id', {asynchronous:false, evalScripts:false, on404:function(request, json){alert('Not found...? Wrong URL...?')}, onFailure:function(request, json){alert('HTTP Error ' + request.status + '!')}}); new Ajax.Updater({success:'upload_amount'}, '/cashbox/uploadAmount/func/cashbox/comm/1/cashbox_id', {asynchronous:true, evalScripts:true, onComplete:function(request, json){Element.hide('indicator_1');}, onLoading:function(request, json){Element.show('indicator_1')}});;; return false;"
														href="#">Efectivo Boliviano</a>
													</span>
												</div>
											</div>
										</td>
										<td>
											<div class="button-menu">
												<div class="page">
													<span> <a
														onclick="new Ajax.Updater({success:'payment_type_list'}, '/paymenttype/editPaymentType/id/2/func/cashbox/use/1/comm/1/cashbox_id', {asynchronous:false, evalScripts:false, on404:function(request, json){alert('Not found...? Wrong URL...?')}, onFailure:function(request, json){alert('HTTP Error ' + request.status + '!')}}); new Ajax.Updater({success:'upload_amount'}, '/cashbox/uploadAmount/func/cashbox/comm/1/cashbox_id', {asynchronous:true, evalScripts:true, onComplete:function(request, json){Element.hide('indicator_1');}, onLoading:function(request, json){Element.show('indicator_1')}});;; return false;"
														href="#">Tarjeta Boliviano</a>
													</span>
												</div>
											</div>
										</td>
									</tr>
									<tr>
										<td>
											<div class="button-menu">
												<div class="page">
													<span> <a
														onclick="new Ajax.Updater({success:'payment_type_list'}, '/paymenttype/editPaymentType/id/5/func/cashbox/use/1/comm/1/cashbox_id', {asynchronous:false, evalScripts:false, on404:function(request, json){alert('Not found...? Wrong URL...?')}, onFailure:function(request, json){alert('HTTP Error ' + request.status + '!')}}); new Ajax.Updater({success:'upload_amount'}, '/cashbox/uploadAmount/func/cashbox/comm/1/cashbox_id', {asynchronous:true, evalScripts:true, onComplete:function(request, json){Element.hide('indicator_1');}, onLoading:function(request, json){Element.show('indicator_1')}});;; return false;"
														href="#">Efectivo Dolar</a>
													</span>
												</div>
											</div>
										</td>
										<td></td>
									</tr>
								</tbody>
							</table>
						</fieldset>
					</div>
				</td>
				<td width="30%" valign="top">
					<div style="display: none;" class="indicator" id="indicator_1"></div>
					<div id="upload_amount">
						<div id="sf_admin_container">
							<div class="save-ok">
								<h2>La Caja esta abierta para el usuario - Fabiola Espinoza.</h2>
							</div>
						</div>
						<form method="post" action="/cashbox/addAmount"
							onsubmit="if ($('username').value != '' &amp;&amp; $('password').value != '' &amp;&amp; $('comment').value != '') { new Ajax.Updater({success:'amount_list'}, '/cashbox/addAmount', {asynchronous:false, evalScripts:false, on404:function(request, json){alert('Not found...? Wrong URL...?')}, onFailure:function(request, json){alert('HTTP Error ' + request.status + '!')}, parameters:Form.serialize(this)}); new Ajax.Updater({success:'upload_amount'}, '/cashbox/uploadAmount/func/cashbox/comm/1/cashbox_id', {asynchronous:true, evalScripts:true, onComplete:function(request, json){Element.hide('indicator_1');}, onLoading:function(request, json){Element.show('indicator_1')}});; }; return false;"
							name="posfrm">
							<fieldset class="adminform">
								<legend>Aprobado Por</legend>
								<table class="admintable">
									<tbody>
										<tr>
											<td width="100" class="key font_bold font_16">Supervisor:</td>
											<td><input type="text" size="16" class="font_bold font_14"
												value="" id="username" name="username"></td>
										</tr>
										<tr>
											<td width="100" class="key font_bold font_16">Contraseña:</td>
											<td><input type="password" size="16"
												class="font_bold font_14" value="" id="password"
												name="password"></td>
										</tr>
									</tbody>
								</table>
							</fieldset>


							<fieldset class="adminform">

								<legend>Insertar Montos</legend>

								<table class="admintable">
									<tbody>
										<tr>
											<td width="100" class="key font_bold font_16">Comentarios:</td>
											<td><textarea cols="30" rows="3" id="comment" name="comment"></textarea>
												<div id="error_for_comment" class="form_error"
													style="display: none;">↓&nbsp; &nbsp;↓</div> <br></td>
										</tr>
										<tr>
											<td width="100" class="key font_bold font_16">Movimiento:</td>
											<td class="font_bold font_16" colspan="2"><select
												class="font_bold font_16" id="movement" name="movement"><option
														value="1">Depósito</option>
													<option value="3">Alivio</option>
													<option value="2">Cerrar</option>
											</select>
												<div id="error_for_movement" class="form_error"
													style="display: none;">↓&nbsp; &nbsp;↓</div> <br></td>
										</tr>
									</tbody>
								</table>

								<table class="admintable">
									<tbody>
										<tr>
										</tr>
									</tbody>
								</table>
							</fieldset>
							<div style="text-align: center"></div>
						</form>
					</div>
				</td>

				<td width="45%" valign="top">
					<div style="display: none;" class="indicator" id="indicator_2"></div>
					<div id="amount_list">


						<table class="adminlist">
							<thead>
								<tr>
									<th>Tipo de Pago</th>
									<th>Monto</th>
									<th>Supervisor</th>
									<th>Comentarios</th>
									<th>Creado el</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
					</div>
				</td>
			</tr>
		</tbody>
	</table>
</div>