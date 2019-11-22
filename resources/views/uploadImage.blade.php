<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Upload image</title>
</head>
<body>
    
  <div class="upload" style="display: flex;">
    <form action="{{ asset('uploadOneImage') }}" method="post" enctype="multipart/form-data" style="
      width: 21%;
      border: 1px solid dodgerblue;
      padding: 12px;
      margin-bottom: 10px;">
        @csrf
       <p> ======== upload one image========== </p>
        <input type="file" name="image">
        <input type="submit" value="submit">
    </form>

    <form action="{{ asset('uploadMultiImage') }}" method="post" enctype="multipart/form-data" style="
      width: 21%;
      border: 1px solid dodgerblue;
      padding: 12px;
      margin-bottom: 10px;">
        @csrf
       <p> ======== upload multi image========== </p>
        <input type="file" name="images[]" multiple>
        <input type="submit" value="submit">
    </form>
  </div>
  <div class="list-img">
      @foreach($data as $key => $value)
          <span>{{ ++$key }}</span>
          <img src="{{ asset('').$value->image}}">
      @endforeach
  </div>
</body>
</html>