@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
        {{-- <div class="card">
                <div class="card-header">{{ __('Add a reference to Notion') }}</div>

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
            		<input type="submit" value="Add">
	                </form>
                </div>
            </div>
            --}}
<br><br>
            <div class="card">
                <div class="card-header">{{ __('Generate a reference list from your Notion DB') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="{{ url('/generate') }}" method="post">
                    @csrf
                    <label for="tag">tag:</label>
                    <select name="tag">
                        <?php
                            foreach ( $tag_name_array as $value ) {
                                echo '<option value="', $value, '">', $value, '</option>';
                            }
                            var_dump($db_properties_array);
                        ?>
                    </select>
                    
                    <br><br>
            		<input type="submit" value="Get a reference list!">
	                </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
