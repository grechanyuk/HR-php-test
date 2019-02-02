@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <form id="order-form" method="post" action="{{route('admin.orders.update', $order)}}">
                {{method_field('PUT')}}
                @include('admin.orders.partials.form')
                {{csrf_field()}}
            </form>
            <div class="col-sm-12 text-right">
                <button type="submit" form="order-form" class="btn btn-primary">Сохранить</button>
            </div>
        </div>
    </div>
@endsection