@extends('layouts.master',['body' => 'page-faq'])
@section('head')
<link rel="stylesheet" href="{{asset('global/vendor/summernote/summernote.css')}}">
<script>
    function hapus(id) {
        $(`.${id}`).remove();
    }
</script>
@endsection
@section('content')

<!-- Page -->
<div class="page">
    <div class="page-header">
        <h1 class="page-title">Setting Sistem Pakar</h1>
    </div>

    <div class="page-content container-fluid">
        <div class="row">
            <div class="col-xl-3 col-md-4">
                <!-- Panel -->
                <div class="panel">
                    <div class="panel-body">
                        <div class="list-group faq-list" role="tablist">
                            <a class="list-group-item active" data-toggle="tab" href="#category-1"
                                aria-controls="category-1" role="tab">Katgeori Gejala</a>
                                <a class="list-group-item" data-toggle="tab" href="#category-3" aria-controls="category-3"
                                    role="tab">Gejala</a>
                            <a class="list-group-item" data-toggle="tab" href="#category-2" aria-controls="category-2"
                                role="tab">Hama dan Solusi</a>
                                <a class="list-group-item" data-toggle="tab" href="#category-4" aria-controls="category-4"
                                role="tab">Aturan</a>
                        </div>
                    </div>
                </div>
                <!-- End Panel -->
            </div>

            <div class="col-xl-9 col-md-8">
                <!-- Panel -->
                <div class="panel">
                    <div class="panel-body">
                        <div class="tab-content">
                            @include('pakar.komponen.kategori')
                            @include('pakar.komponen.gejala')
                            @include('pakar.komponen.hama')
                            @include('pakar.komponen.rule')
                        </div>
                    </div>
                </div>
                <!-- End Panel -->
            </div>
        </div>
    </div>
</div>


 

@endsection
@section('footer')
<script src="{{asset('global/vendor/summernote/summernote.min.js')}}"></script>
<script src="{{asset('global/js/Plugin/summernote.js')}}"></script>

<script src="{{asset('assets/examples/js/forms/editor-summernote.js')}}"></script>
<script src="{{asset('global/js/Plugin/input-group-file.js')}}"></script>
@endsection