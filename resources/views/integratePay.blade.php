<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <title>Integrate Pay</title>
</head>
<body>
    <button id="momopay_button">MOMO PAY</button>
    <button id="">
        <a href="{{ $result['payment_methods'][2]['nganluong_apipoint'] }}">NGAN LUONG PAY</a>
    </button>
    <script>
        // momo pay
        jQuery(document).on('click', '#momopay_button', function () {
            const data = <?= isset($result['payment_methods'][1]['momopay_data']) ? json_encode($result['payment_methods'][1]['momopay_data']) : '{}' ?>;
            jQuery.post("{{ isset($result['payment_methods'][1]['momopay_apipoint']) ? $result['payment_methods'][1]['momopay_apipoint'] : '' }}", JSON.stringify(data)).then(function (res) {
                if (res.errorCode == 0) {
                    window.location = res.payUrl;
                }
            });
        });
        // ngan luong pay

    </script>
</body>
</html>
