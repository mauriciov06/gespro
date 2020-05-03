@if(Session::has('message-error'))
<div class="alert alert-danger" role="alert" style="margin-top: 18px;">
	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">×</span>
	</button> 
	{{Session::get('message-error')}}
</div>
@endif