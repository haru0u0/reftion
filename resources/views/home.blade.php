@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('notionにレファレンスを新規追加する') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="{{ url('/insert') }}" method="post">
                    @csrf
              		<label for="doi">doi:</label>
	            	<input type="text" id="doi" name="doi" size="50"><br><br>
            		<input type="submit" value="新規追加">
	                </form>
                </div>
            </div>
<br><br>
            <div class="card">
                <div class="card-header">{{ __('notionからレファレンスリストを出力する') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="{{ url('/generate') }}" method="post">
                    @csrf
                    <label for="project">project:</label>
	            	<input type="text" id="pj" name="pj" size="50"><br><br>
            		<input type="submit" value="新規作成">
	                </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
