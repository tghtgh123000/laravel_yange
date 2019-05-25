<?php
/** @var Illuminate\Pagination\LengthAwarePaginator $fruits */
/** @var App\Fruit $fruit */
/** @var App\Fruit $newFruit */
?>

@extends('layouts.app')

@section('content')

    <div class="container" style="font-family: 'Microsoft YaHei UI'">
        <div>
            <span>第<code>{{$newFruit->periodsId}}</code>期果子预计在<code>{{$newFruit->resultTime}}</code>收成，敬请期待！</span>
            <a>我要种水果？</a>
        </div>
        <div style="height: 10px"></div>
        <table class="table table-striped table-bordered">
            <thead>
                <th>时间</th>
                <th>期数</th>
                <th>结果</th>
            </thead>
            <tbody>
                @foreach ($fruits as $fruit)
                    <tr>
                        <td>{{ $fruit->resultTime }}</td>
                        <td>{{ $fruit->periodsId }}</td>
                        <td>
                            <img width="30" src="\img\{{ $fruit->result }}.png">
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div>
            {{ $fruits->links() }}
        </div>
    </div>

@endsection