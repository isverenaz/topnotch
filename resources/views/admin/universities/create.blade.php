@extends('admin.layouts.app')
@section('admin.title')
    @lang('admin.edit')
@endsection
@section('admin.css')
    <meta name="_token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.css">
@endsection
@section('admin.content')
    <div class="main-content">
        <div class="dashboard-breadcrumb mb-25">
            <h2>@lang('admin.add')</h2>
        </div>
        @include('components.admin.error')
        <div class="row">
            <div class="col-12">
                <form action="{{ route('admin.universities.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
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
                                                    <input type="text" class="form-control" name="name[{{$lang['code']}}]">
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                                <div class="tab-pane" id="other" role="tabpanel">

                                    <div class="row g-3">
                                        <div class="col-sm-12">
                                            <label class="form-label">@lang('admin.countries')</label>
                                            <select class="form-control" name="country_id">
                                                <option value="" >@lang('admin.choose')</option>
                                                @if(!empty($countries[0]))
                                                    @foreach($countries as $country)
                                                        <option value="{{$country['id']}}" >{{$country['name'][$currentLang]}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <div class="col-sm-12">
                                            <label class="form-label">@lang('admin.status')</label>
                                            <select class="form-control" name="status">
                                                <option value="1" >@lang('admin.active')</option>
                                                <option value="0" >@lang('admin.nonactive')</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-12">
                                            <label class="form-label">@lang('admin.is_main')</label>
                                            <select class="form-control" name="is_main">
                                                <option value="1" >@lang('admin.active')</option>
                                                <option value="0" >@lang('admin.nonactive')</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-12">
                                            <label class="form-label">@lang('admin.photo')</label>
                                            <input type="file" name="image" id="mainImageUpload">
                                            <p>Şəkilin maksimum ölçüsü  1000x646 piksel olmalıdır. Şəkil faylının maksimum ölçüsü 101 KB olmalıdır.</p>
                                            <div id="mainImagePreview" style="margin-top: 10px;"></div>
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

    <script>
        $(document).ready(function () {
            $('#input-category').on('change', function () {
                let parentId = $(this).val();
                let subCategoryWrapper = $('#sub-category-wrapper');
                let subCategorySelect = $('#input-sub-category');

                // Əgər parent_id boşdursa, sub_category selectini gizlədirik
                if (!parentId) {
                    subCategoryWrapper.hide();
                    subCategorySelect.html('<option value="">@lang("admin.choose")</option>');
                    return;
                }

                // AJAX ilə alt kateqoriyaları gətiririk
                $.ajax({
                    url: '{{ route('admin.service-category.getParentCategories') }}', // Bu URL `web.php` faylında göstərilməlidir
                    type: 'GET',
                    data: { category_id: parentId },
                    success: function (response) {
                        if (response.success && response.parentCategories.length > 0) {
                            // Alt kateqoriyaları doldur
                            subCategorySelect.html('<option value="">@lang("admin.choose")</option>');
                            $.each(response.parentCategories, function (index, subCategory) {
                                subCategorySelect.append(
                                    `<option value="${subCategory.id}">${subCategory.title}</option>`
                                );
                            });
                            subCategoryWrapper.show();
                        } else {
                            // Alt kateqoriya yoxdursa, seçimi gizlət
                            subCategoryWrapper.hide();
                            subCategorySelect.html('<option value="">@lang("admin.choose")</option>');
                        }
                    },
                    error: function () {
                        alert('@lang("admin.error_loading_categories")');
                    }
                });
            });
        });
    </script>
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
    <script src="{{ asset('summernote/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('summernote/editor_summernote.js') }}"></script>
@endsection

