<table class="table table-responsive">
    <thead>
    <tr>
        <th>#</th>
        <th>Партнер</th>
        <th>Сумма</th>
        <th>Состав заказа</th>
        <th>Статус</th>
    </tr>
    </thead>
    <tbody>
    @forelse($orders as $order)
    <tr>
        <td><a href="{{route('admin.orders.edit', $order)}}">{{$order->id}}</a></td>
        <td>{{$order->partner->name}}</td>
        <td>{{getOrderTotal($order)}}</td>
        <td>
            @foreach($order->products as $product)
            {{$product->name}} <br/>
            @endforeach
        </td>
        <td>{{getOrderStatusName($order->status)}}</td>
    </tr>
    @empty
    <tr>
        <td colspan="5" class="text-center">Пока нет заказов</td>
    </tr>
    @endforelse
    </tbody>
</table>