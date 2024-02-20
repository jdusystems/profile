@extends('admin.master')

@section('main')
    <div class="row">
        <div class="col-md-12">
            <!-- DATA TABLE -->
            <h3 class="title-5 m-b-35">Talabalar rasmlari</h3>
            <div class="card">
                <div class="card-header">Barcha talabalar rasmlarini yuklab olish</div>
                <div class="card-body">
                    <a href="{{ route('admin.downloadImages') }}" class="btn btn-secondary">
                        <i class="fa fa-download"></i>&nbsp; Yuklab olish</a>
                </div>
            </div>
            <!-- END DATA TABLE -->
        </div>
    </div>
@endsection
