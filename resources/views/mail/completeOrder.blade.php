<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8"/>
    <title></title>
</head>
<body>
@if($vendor)
    Добрый день, {{$vendor->name}}!
@endif
Заказ #{{$order->id}} завершен
<br/>
Товары в заказе:
<ul>
    @foreach($products as $product)
        <li>{{$product->name}} - {{$product->quantity}} шт</li>
    @endforeach
</ul>
<hr>
Сумма заказа: {{getOrderTotal($products)}}
</body>
</html>