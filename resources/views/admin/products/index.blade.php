@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <table class="table table-responsive">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Наименование</th>
                    <th>Поставщик</th>
                    <th>Стоимость</th>
                </tr>
                </thead>
                <tbody>
                @forelse($products as $product)
                    <tr>
                        <td>{{$product->id}}</td>
                        <td>{{$product->name}}</td>
                        <td>{{$product->vendor->name}}</td>
                        <td class="ajax-editable" data-product-id="{{$product->id}}" data-attribute-name="price"
                            data-attribute-type="int"
                            contenteditable="true">{{$product->price}}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">Пока нам нечего продавать :(</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
            <div class="col-sm-12 pagination">
                {{$products->links()}}
            </div>
        </div>
    </div>
@endsection