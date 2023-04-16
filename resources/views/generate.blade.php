@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('リファレンスリストです！') }}</div>

                <div class="card-body">

<?php 

sort($gen_citation_array);

foreach($gen_citation_array as $reference_list){
    echo $reference_list;
    echo '<br>';
}


//echo $res_cite_array['citations']['0']['citation'];
?>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection