<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if(isset($err))
            {{$err}}

            @endif
            @if(isset($data))

            {{$data}}
            @endif
        </div>
    <ol>
        <li><a href="{{ asset('viewcheckout') }}">send box momo</a></li>
        <li><a href="{{ asset('viewImportExportExcel') }}">import export</a></li>
        <li><a href="{{ asset('qrcode') }}">scan qr code</a></li>
        <li><a href="{{ asset('viewImage') }}">upload image</a></li>
        <li><a href="{{ asset('sendMail') }}">send mail</a></li>
    </ol>
<p>==================get api SCTDL==================================</p>
        <form action="{{ action('GetCompanyAPI@checkExit') }}" method="post">
            @csrf
            <input type="text" name="mst" placeholder="nhập mst 5801372016">
            <button type="submit">sunmit</button>
        </form>
        <p>==========================================================</p>
        Checkbox: <input type="checkbox" name="myCheck" onclick="check()">

        text : <input type="text" name="myText" readonly>
<p>===========================VIEW MORE ROW===================================</p>
       <div class="container">
    <h2 style="margin-top: 10px;">Laravel Store Data To Json Format In Database - Tutsmake.com</h2>
    <br>
    <br>

    @if ($message = Session::get('success'))
    <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
          <strong>{{ $message }}</strong>
    </div>
    <br>
    @endif

    <form id="laravel_json" method="post" action="{{route('store-json')}}">
      @csrf
      <!-- <div class="form-group">
        <label for="formGroupExampleInput">Name</label>
        <input type="text" name="name" class="form-control" id="formGroupExampleInput" placeholder="Please enter name">
      </div>
      <div class="form-group">
        <label for="email">Email Id</label>
        <input type="text" name="email" class="form-control" id="email" placeholder="Please enter email id">
      </div>
      <div class="form-group">
        <label for="mobile_number">Mobile Number</label>
        <input type="text" name="mobile_number" class="form-control" id="mobile_number" placeholder="Please enter mobile number">
      </div> -->
      <div class="form-group">
       <button type="submit" class="btn btn-success">Submit</button>
      </div>
        <input type="number" hidden="" name="count" value=1 id="count">
                      <table id="t1" border="1" width="100%" cellspacing="0" cellpadding="0" class="table-1">
                          <tr>
                              <th valign="top" width="50%">
                                  <p align="center">Tên sản phẩm</p>
                              </th>
                              <th valign="top" width="20%">
                                  <p align="center">Đơn vị</p>
                              </th>
                              <th valign="top" width="20%">
                                  <p align="center">Sản lượng</p>
                              </th>
                              <th valign="top" width="10%">
                              </th>
                          </tr>
                          <tr>
                              <td valign="top" width="50%">
                                   <input type="text" required="" placeholder="Điền vào đây..." name="sanpham1" >
                              </td>
                              <td valign="top" width="20%">
                                   <input type="text" required="" placeholder="Điền vào đây..." name="donvi1" >
                              </td>
                              <td valign="top" width="20%">
                                  <input type="text" required="" placeholder="Điền vào đây..." name="sanluong1" >
                              </td>
                              <td valign="top" width="10%">
                                  <input type="button" value="Xoá dòng" onclick="deleteRow(this)" style="background: none;color: red;" />
                              </td>
                          </tr>
                  </table>
                 <div class="nut">
                  <input  class="btn btn-success" type="button" value="Thêm dòng" onclick="add1()" /></div>
    </body>
    <script>

        function check(){
            if(document.getElementsByName("myCheck")[0].checked == true){
                document.getElementsByName("myText")[0].removeAttribute("readonly");
                }
            }
        function add1() {

                          var count = parseInt(document.getElementById("count").value);
                        var nextVal = count + 1;
                          var num = document.getElementById("t1").rows.length;
                          var x = document.createElement("tr");

                          a = document.createElement("td");
                          anode = document.createElement("input");
                          b = document.createAttribute("type");
                          b.value = "text";
                         anode.setAttribute('placeholder','Điền vào đây...');
                         anode.setAttribute('name','sanpham'+ nextVal);
                         anode.setAttribute('require','');
                          a.appendChild(anode);
                          x.appendChild(a);

                          a = document.createElement("td");
                          anode = document.createElement("input");
                          b = document.createAttribute("type");
                          b.value = "text";
                         anode.setAttribute('placeholder','Điền vào đây...');
                         anode.setAttribute('name','donvi' + nextVal);
                         anode.setAttribute('require','');
                          a.appendChild(anode);
                          x.appendChild(a);

                          a = document.createElement("td");
                          anode = document.createElement("input");
                          b = document.createAttribute("type");
                          b.value = "text";
                          anode.setAttribute('placeholder','Điền vào đây...');
                          anode.setAttribute('name','sanluong' + nextVal);
                          anode.setAttribute('require','');
                          a.appendChild(anode);
                          x.appendChild(a);

                          a = document.createElement("td");
                          anode = document.createElement('input');
                          anode.setAttribute('type','button');
                          anode.setAttribute('value','Xoá dòng');
                          anode.setAttribute('style','background:none; color:red');
                          anode.setAttribute('onclick','deleteRow(this)');
                          a.appendChild(anode);
                          x.appendChild(a);
                          document.getElementById("t1").appendChild(x);
                          document.getElementById('count').setAttribute('value', nextVal);
                      }

              function deleteRow(e,v) {
                var tr = e.parentElement.parentElement;
                var tbl = e.parentElement.parentElement.parentElement;
                tbl.removeChild(tr);

              }
    </script>
</html>
