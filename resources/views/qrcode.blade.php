<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <script type="text/javascript" src="instascan.min.js"></script>
</head>
<body>
  <a href="{{ asset('viewVueQRcode') }}">viewVueQRcode</a>
    ============ acces camera device ======================
    @if(!isset($detail))
      <table>
        <tr>
          <th>id</th>
          <th>qr code</th>
        </tr>
        @foreach($list_qr as $key => $value)
          <tr>
            <td> {{ $value->id }} </td>
            <td> {!! QrCode::size(450)->generate($value->qr_code); !!} </td>
        </tr>
       
        @endforeach
      </table>
    @else
      <p>
        {{ $detail->detail }}
      </p>
    @endif

<form action="{{ action('qrcodeController@getqrcode') }}" method="post" enctype="multipart/form-data">
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
  {{-- <input type="file" accept="image/*" capture="camera" id="preview" name="preview" />
  <input type="submit" value="submit"> --}}
  <input type='text' size='16' placeholder="Tracking Code"  name="not_found" class='qrcode-text'>
  <label class='qrcode-text-btn'>
    <input type='file' accept="image/*" capture='environment' name="name_of_qr" onclick="return showQRIntro();" onchange="openQRCamera(this);" tabindex='-1'>
  </label> 
<input type='submit' value="Go">
</form>

{{-- text reatime --}}



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://rawgit.com/sitepoint-editors/jsqrcode/master/src/qr_packed.js"></script>
<script >
function openQRCamera(node) {
  var reader = new FileReader();
  reader.onload = function() {
    node.value = "";
    qrcode.callback = function(res) {
      if(res instanceof Error) {
        alert("Không tìm thấy sản phẩm");
      } else {
        node.parentNode.previousElementSibling.value = res;
        alert(res);
      }
    };
    qrcode.decode(reader.result);
  };
  reader.readAsDataURL(node.files[0]);
}

function showQRIntro() {
  return confirm("Use your camera to take a picture of a QR code.");
}

</script>
</body>
</html>