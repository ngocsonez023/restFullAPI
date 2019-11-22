<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Import Export</title>
</head>
<body>
    <div class="box" style="display: flex; ">
        <form class="item" action="{{ URL::to('importExcel') }}" method="post" enctype="multipart/form-data" style="display: flex;border: 1px solid dodgerblue;padding: 10px;">
            @csrf
            {{-- ========= import excel ======== --}}
            <input type="file" name="file">
            <input class="btn btn-success" type="submit" value="import">
        </form>
        <form style="border: 1px solid dodgerblue;padding: 10px;" enctype="multipart/form-data" action="{{ URL::to('exportExcel')}}" method="post">
            @csrf
            <input type="submit" value="export">
        </form>
        <div class="item" style="border: 1px solid dodgerblue;padding: 10px;">
            <a href="{{ asset('exportpdf') }}" >export pdf</a>
        </div>
    </div>
    
    <table>
        <th>stt</th>
        <th>code</th>
        <tbody>
            @foreach($data as $key => $value)
                <tr>
                    <td>{{ ++$key }}</td>
                    <td>{{ $value->qr_code }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>