<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>購物車結帳頁面</title>
</head>
<body>
    <div>
        <h1>Checkout 結帳頁</h1>
        <div>
            <pre>{{ var_export($cart, true) }}</pre>
            <pre>{{ var_export($account, true) }}</pre>
        </div>
    </div>
</body>
</html>