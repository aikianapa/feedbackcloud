<section class="element-wrapper">
	<h6 class="element-header">
		<div class="row">
			<div class="col-12 col-sm-4">Twilio sender</div>
			<div class="col-12 col-sm-8 header-buttons">
				<button data-wb-ajax="/module/twilio/settings" data-wb-html=".ajax-target" class="btn btn-sm btn-info pull-right header-button" data-wb-href><i class="fa fa-gear"></i> Settings</button>
			</div>
		</div>
	</h6>

	<form class="form-horizontal" role="form">
		<div class="row">
			<div class="form-group col-12">
			<label class="form-control-label">Send text</label>
			<textarea name="text" rows="auto" class="col-12 form-control"></textarea>
			</div>
			<div class="form-group col-12">
			<label class="form-control-label">Phones list</label>
			<textarea name="list" class="form-control"></textarea>
			</div>
			<div class="form-group col-12">
			<button class="btn btn-success" data-wb-ajax="/module/twilio/sender_listform/">Send</button>
			<button class="btn btn-warning" onclick="twilioSenderReport();return false;">Get report</button>
			</div>
			<div class="form-group col-12">
			<label class="form-control-label">Results</label>
			<textarea id="twilioSenderResult" rows="10" class="form-control"></textarea>
			</div>
		</div>
	</form>
	<script>
		function twilioSenderReport() {
			$.get("/module/twilio/sender_logview/",function(data){
				$("#twilioSenderResult").text(data);
			});
		}
	</script>
</section>
