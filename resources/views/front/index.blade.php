@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="text-center">
                    Температура воздуха в Брянске: {{$weather->fact->temp}}<br/>
                    Температура комфорта: {{$weather->fact->feels_like}}<br/>
                    Обновлено: {{date('d.m.y H:i', $weather->now) . ' GTM'}}<br/>
                    Обновление каждые {{config('yandexweather.cacheTime')}} минут
                </div>
            </div>
        </div>
    </div>
@endsection