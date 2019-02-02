@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#overdue">Просроченные</a></li>
                <li><a data-toggle="tab" href="#current">Текущие</a></li>
                <li><a data-toggle="tab" href="#new">Новые</a></li>
                <li><a data-toggle="tab" href="#finished">Выполеннные</a></li>
            </ul>
            <div class="tab-content">
                <div id="overdue" class="tab-pane fade in active">
                    <h3>Просроченные</h3>
                    @include('admin.orders.partials.ordersTable', ['orders' => $overdueOrders])
                </div>
                <div id="current" class="tab-pane fade">
                    <h3>Текущие</h3>
                    @include('admin.orders.partials.ordersTable', ['orders' => $currentOrders])
                </div>
                <div id="new" class="tab-pane fade">
                    <h3>Новые</h3>
                    @include('admin.orders.partials.ordersTable', ['orders' => $newOrders])
                </div>
                <div id="finished" class="tab-pane fade">
                    <h3>Выполеннные</h3>
                    @include('admin.orders.partials.ordersTable', ['orders' => $finishedOrders])
                </div>
            </div>
        </div>
    </div>
@endsection