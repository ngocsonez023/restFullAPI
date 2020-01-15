<div class="qrrealtime">
	@if(isset($data))
		<b>Tên :</b>
		<p>{{ $data->qr_code}}</p> <br>
		<b>Chi tiết :</b>
    	<p>{{ $data->detail}}</p>
    @else
    	<p>không có data</p>
    @endif	
</div>