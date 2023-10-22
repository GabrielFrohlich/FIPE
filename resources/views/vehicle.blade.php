@extends('layout')

@section('content')
<div class="container mx-auto">
    <div class="border shadow rounded-xl">
        {{-- Breadcrumb --}}
        <h4 class="p-2 text-xl">
            <a href="{{route('fipe.models', ['type' => $type, 'brand_id' => $brand_id])}}" class="text-blue-500">{{$vehicle['Marca']}}</a> / <a href="/fipe/{{$type}}/{{$brand_id}}/{{$model_id}}" class="text-blue-500">{{$vehicle['Modelo']}}</a> / <a href="#" class="text-blue-500">{{$vehicle['AnoModelo']}}</a></h4>
        <hr>

        <div class="p-4">
            @foreach($vehicle as $key => $value)
            <div class="grid grid-cols-2 gap-3 mb-2">
                <div class="text-right">
                    <strong>{{$key}}:</strong>
                </div>
                <div>{{$value}}</div>
            </div>
            @endforeach
        </div>

    </div>
</div>
@endsection