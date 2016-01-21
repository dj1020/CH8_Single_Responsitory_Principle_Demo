<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>購物車結帳頁面</title>
</head>
<body>
    <div>
        <h1>Checkout 結帳頁</h1>
        <h3 align="center"> 顧客：<span style="color: #a94442;">{{ $account->name }}</span> 購物清單</h3>
        <div align="center">
            <form action="/checkout" method="POST">
                <table border="1" width="50%">
                    <tr align="center">
                        <th>商品名稱</th>
                        <th>商品價錢</th>
                    </tr>
                    @foreach ($cart->getList() as $product)
                        <tr align="center">
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->price }}</td>
                            <input name="product_ids[]" type="hidden" value="{{ $product->id }}"/>
                        </tr>
                    @endforeach
                </table>
                <br/>

                {{ csrf_field() }}
                <input name="account_id" type="hidden" value="{{ $account->id }}"/>
                <input type="submit" value="提交訂單"/>
            </form>
        </div>
    </div>
</body>
</html>