@extends('layout')

@section('content')


    <div class="container mx-auto p-2">
        <div class="border shadow">
            <x-table :tableData="$tableData" :columns="array_keys($tableData[0])" :baselink="$baselink"></x-table>
        </div>
    </div>

@endsection