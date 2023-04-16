@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('登録完了') }}</div>

                <div class="card-body">
<p>{{$res_cite_array['name']}}を登録しました。</p>
<a href="{{$res_notion_array['url']}}">登録したページはこちらから確認してください。</a> 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection