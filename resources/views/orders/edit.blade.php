@extends('layouts.dashboard')

@section('title', 'Edit')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
<li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
    <!-- Info boxes -->
        <div class="row">
            <div class="col">
                <div class="card card-primary card-outline">
                    <div class="card-header">Edit Order</div>
                    <div class="card-body">
                        @if ($errors->any())
                        @foreach ($errors->all() as $error)
                        <div class="alert alert-danger">
                        {{ $error }}
                        </div>
                        @endforeach
                        @endif
                        @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                        @endif
                        <form action="{{ url()->current() }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="title">Judul</label>
                                <input type="text" name="title" id="title" class="form-control" placeholder="Judul" value="{{ old('title') ? old('title') : $order->title }}">
                            </div>
                            <div class="form-group">
                                <label for="category">Kategori</label>
                                <select name="category" id="category" class="form-control">
                                    @php
                                        $category = old('category') ? old('category') : $order->category;
                                    @endphp
                                    <option value="">Pilih Kategori</option>
                                    <option value="technical" @if ($category == 'technical') selected @endif>Teknis</option>
                                    <option value="nontechnical" @if ($category == 'nontechnical') selected @endif>Non Teknis</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="assign">Kepada</label>
                                <select name="assign" id="assign" class="form-control">
                                    <option value="">Pilih User</option>
                                    @foreach ($users as $user)
                                        @php
                                            $currentUser = old('assign') ? old('assign') : $order->assign_id;
                                        @endphp
                                        <option value="{{ $user->id }}" @if ($currentUser == $user->id) selected @endif>{{ $user->fullname }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="description">Deskripsi</label>
                                <textarea name="description" id="description" class="form-control">{!! old('description') ? old('description') : $order->description; !!}</textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-flat btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.js" integrity="sha512-+cXPhsJzyjNGFm5zE+KPEX4Vr/1AbqCUuzAS8Cy5AfLEWm9+UI9OySleqLiSQOQ5Oa2UrzaeAOijhvV/M4apyQ==" crossorigin="anonymous"></script>
<script>
$(document).ready(function() {
    $('#description').summernote({
        tabsize: 2,
        height: 250,
        placeholder: "Deskripsikan masalahnya disini"
    });
});
</script>
@endsection

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.css" integrity="sha512-pDpLmYKym2pnF0DNYDKxRnOk1wkM9fISpSOjt8kWFKQeDmBTjSnBZhTd41tXwh8+bRMoSaFsRnznZUiH9i3pxA==" crossorigin="anonymous" />
@endsection
