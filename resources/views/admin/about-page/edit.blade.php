@extends('admin.layouts.app')

@section('admin.title')
    About
@endsection

@section('admin.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <!-- Flatpickr JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <style>
        .input-group-text {
            cursor: pointer;
        }

        .input-group-text i {
            font-size: 1.2rem;
        }

    </style>
@endsection

@section('admin.content')
    <div class="main-content">
        <div class="dashboard-breadcrumb mb-25">
            <h2>About</h2>
        </div>

        @include('components.admin.error')

        <div class="row">
            <div class="col-12">
                <form action="{{ route('admin.about-page.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="panel">
                        <div class="panel-body">

                            <ul class="nav nav-pills nav-justified" role="tablist">
                                @foreach($locales as $key => $lang)
                                    <li class="nav-item">
                                        <a class="nav-link @if($key == 0) active @endif"
                                           data-bs-toggle="tab"
                                           href="#lang_{{ $lang->code }}"
                                           role="tab">
                                            {{ $lang->code }}
                                        </a>
                                    </li>
                                @endforeach

                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#other" role="tab">
                                        @lang('admin.other')
                                    </a>
                                </li>
                            </ul>

                            <div class="tab-content p-3 text-muted">

                                @foreach($locales as $key => $lang)
                                    <div class="tab-pane @if($key == 0) active @endif"
                                         id="lang_{{ $lang->code }}"
                                         role="tabpanel">

                                        <div class="row g-3">
                                            <div class="col-12">
                                                <label class="form-label">Başlıq - {{ $lang->code }}</label>
                                                <input type="text"
                                                       class="form-control"
                                                       name="title[{{ $lang->code }}]"
                                                       value="{{ old('title.'.$lang->code, $about->title[$lang->code] ?? '') }}">
                                            </div>

                                            <div class="col-12">
                                                <label class="form-label">Alt başlıq - {{ $lang->code }}</label>
                                                <input type="text"
                                                       class="form-control"
                                                       name="sub_title[{{ $lang->code }}]"
                                                       value="{{ old('sub_title.'.$lang->code, $about->sub_title[$lang->code] ?? '') }}">
                                            </div>

                                            <div class="col-12">
                                                <label class="form-label">Mətn - {{ $lang->code }}</label>
                                                <textarea class="editor form-control"
                                                          name="text[{{ $lang->code }}]">{{ old('text.'.$lang->code, $about->text[$lang->code] ?? '') }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                                <div class="tab-pane" id="other" role="tabpanel">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label class="form-label">Şəkil</label>
                                            <input type="file" class="form-control" name="image">

                                            @if(!empty($about->image))
                                                <div class="mt-3">
                                                    <img src="{{ asset('uploads/about/'.$about->image) }}"
                                                         style="max-width: 180px; height: auto;">
                                                </div>
                                            @endif
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">@lang('admin.status')</label>
                                            <select class="form-control" name="status">
                                                <option value="1" @selected(($about->status ?? 1) == 1)>@lang('admin.active')</option>
                                                <option value="0" @selected(($about->status ?? 1) == 0)>@lang('admin.nonactive')</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <button type="submit" class="btn btn-sm btn-primary">
                                @lang('admin.save')
                            </button>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('admin.js')
    <script src="{{ asset('summernote/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('summernote/editor_summernote.js') }}"></script>
@endsection
