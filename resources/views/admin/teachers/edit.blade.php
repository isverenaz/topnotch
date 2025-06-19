@extends('admin.layouts.app')
@section('admin.title')
    @lang('admin.edit')
@endsection
@section('admin.css')
    <meta name="_token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.css">
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/css/swiper-bundle.min.css') }}">
@endsection
@section('admin.content')
    <div class="main-content">
        <div class="dashboard-breadcrumb mb-25">
            <h2>@lang('admin.edit')</h2>
        </div>
        @include('components.admin.error')
        <div class="row">
            <div class="col-12">
                <form action="{{ route('admin.teachers.update',$teacher['id']) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="panel">
                        <div class="panel-body">
                            <ul class="nav nav-pills nav-justified" role="tablist">
                                @if(!empty($locales))
                                    @foreach($locales as $key => $lang)
                                        <li class="nav-item waves-effect waves-light">
                                            <a class="nav-link @if(++$key ==1) active @endif" data-bs-toggle="tab"
                                               href="#{{$lang->code}}" role="tab">
                                                <span class="d-none d-sm-block">{{$lang->code}}</span>
                                            </a>
                                        </li>
                                    @endforeach
                                @endif
                                <li class="nav-item waves-effect waves-light">
                                    <a class="nav-link" data-bs-toggle="tab"
                                       href="#other" role="tab">
                                        <span class="d-none d-sm-block">@lang('admin.other')</span>
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content p-3 text-muted">
                                @if(!empty($locales))
                                    @foreach($locales as $key => $lang)
                                        <div class="tab-pane @if(++$key ==1) active @endif" id="{{$lang['code']}}"
                                             role="tabpanel">
                                            <div class="row g-3">
                                                <div class="col-12">
                                                    <label class="form-label">@lang('admin.name') - {{$lang['code']}}</label>
                                                    <input type="text" class="form-control" name="name[{{$lang['code']}}]" value="{{ $teacher['name'][$lang['code']] ?? NULL }}">
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                                <div class="tab-pane" id="other" role="tabpanel">
                                    <div class="row g-3">
                                        <div class="col-sm-12">
                                            <label class="form-label">@lang('admin.positions')</label>
                                            <select class="form-control" name="position_id">
                                                <option value="" >@lang('admin.choose')</option>
                                                @if(!empty($positions[0]))
                                                    @foreach($positions as $position)
                                                        <option value="{{$position['id']}}" @if($position['id'] == $teacher['position_id']) selected="selected" @endif>{{$position['name'][$currentLang]}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <div class="col-sm-12">
                                            <label class="form-label">@lang('admin.status')</label>
                                            <select class="form-control" name="status">
                                                <option value="1" @if($teacher['status'] ==1) selected @endif>@lang('admin.active')</option>
                                                <option value="0" @if($teacher['status'] ==0) selected @endif>@lang('admin.nonactive')</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-12">
                                            <label class="form-label">@lang('admin.is_main')</label>
                                            <select class="form-control" name="is_main">
                                                <option value="1" @if($teacher['is_main'] ==1) selected @endif>@lang('admin.active')</option>
                                                <option value="0" @if($teacher['is_main'] ==0) selected @endif>@lang('admin.nonactive')</option>
                                            </select>
                                        </div>

                                        <div class="col-sm-12">
                                            <label class="form-label">@lang('admin.main_image')</label>
                                            <input type="file" name="image" id="mainImageUpload">
                                            <p> Şəkilin maksimum ölçüsü  1000x646 piksel olmalıdır. Şəkil faylının maksimum ölçüsü 101 KB olmalıdır.</p>
                                            <div id="mainImagePreview" style="margin-top: 10px;"></div>

                                            @if(!empty($teacher['image']))
                                            <div class="col-md-5">
                                                <img src="{{ asset('uploads/teachers/'.$teacher->image) }}" style="width: 288px;!important;">
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-sm btn-primary">@lang('admin.save')</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('admin.js')
    <script src="{{ asset('admin/assets/vendor/js/swiper-bundle.min.js') }}"></script>
    @if(!empty($teacher['image']))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Tek resim için: Dosya adını göster
            document.getElementById('mainImageUpload').addEventListener('change', function(event) {
                const mainImagePreview = document.getElementById('mainImagePreview');
                mainImagePreview.innerHTML = ''; // Önizleme alanını temizle
                const file = event.target.files[0];
                if (file) {
                    const img = document.createElement('img');
                    img.src = URL.createObjectURL(file); // Resmin src'sini ayarla
                    img.style.width = '150px';
                    img.style.height = 'auto';
                    img.style.border = '1px solid #ccc';
                    img.style.padding = '5px';
                    img.style.marginTop = '5px';

                    // Önizleme alanına resmi ekle
                    mainImagePreview.appendChild(img);
                }
            });
        });
    </script>
    @endif
    <script src="{{ asset('summernote/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('summernote/editor_summernote.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.summernote-height').summernote({
                airMode: true, // Eğer airMode kullanılıyorsa
                disableResizeEditor: true,
                toolbar: false, // Eğer toolbar varsa, kapat
                disableDragAndDrop: true,
                callbacks: {
                    onInit: function() {
                        // Editoru deaktiv et
                        $(this).summernote('disable');
                    }
                }
            });
        });

    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                var errorDiv = document.getElementById('error-message');
                if (errorDiv) {
                    errorDiv.style.display = 'none';
                }
            }, 2000);
        });
    </script>
@endsection

