@extends('admin.layouts.app')
@section('admin.title')
    @lang('admin.study_abroads')
@endsection
@section('admin.css')
    <style>
        .study-card-meta {
            display: flex;
            flex-wrap: wrap;
            gap: .5rem;
            margin-top: .75rem;
        }

        .study-card-meta .badge {
            font-weight: 500;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/css/aos.css') }}">
@endsection
@section('admin.content')
    <div class="main-content">
        <div class="dashboard-breadcrumb mb-25">
            <h2>@lang('admin.study_abroads')</h2>
            @can('study-abroad-create')
                <a class="btn btn-sm btn-primary" href="{{ route('admin.study-abroads.create') }}">
                    <i class="fa-light fa-plus"></i> @lang('admin.add')
                </a>
            @endcan
        </div>

        @include('components.admin.error')

        <div class="row">
            <div class="col-12">
                <div class="panel">
                    <div class="panel-body">
                        <div class="row g-4">
                            @forelse($studyAbroads as $data)
                                @php
                                    $title = data_get($data, "name.$currentLang") ?? data_get($data, 'name.az');
                                    $shortText = data_get($data, "text.$currentLang") ?? data_get($data, 'text.az');
                                @endphp
                                <div class="col-xl-4 col-lg-6 col-md-6">
                                    <div class="card h-100">
                                        <div class="card-header d-flex align-items-start justify-content-between gap-3">
                                            <div>
                                                <div class="fw-semibold">{{ $title }}</div>
                                                <div class="small text-muted">{{ data_get($data, "country.name.$currentLang") ?? data_get($data, 'country.name.az') }}</div>
                                            </div>
                                            <div class="d-flex gap-2">
                                                @can('study-abroad-edit')
                                                    <a href="{{ route('admin.study-abroads.edit', $data->id) }}" class="btn btn-sm btn-icon btn-primary" title="@lang('admin.edit')">
                                                        <i class="fa-light fa-edit"></i>
                                                    </a>
                                                @endcan
                                                @can('study-abroad-delete')
                                                    <button class="btn btn-sm btn-icon btn-danger" data-bs-toggle="modal" data-bs-target="#delete{{ $data->id }}">
                                                        <i class="fa-light fa-trash-can"></i>
                                                    </button>
                                                @endcan
                                            </div>
                                        </div>

                                        @if(!empty($data->image))
                                            <div class="card-body p-0">
                                                <img src="{{ asset('uploads/studyAbroads/' . $data->image) }}" alt="{{ $title }}" class="img-fluid w-100" style="aspect-ratio: 16 / 10; object-fit: cover;">
                                            </div>
                                        @endif

                                        <div class="card-body">
                                            <p class="mb-2 text-muted">{{ \Illuminate\Support\Str::limit(strip_tags($shortText), 140) }}</p>
                                            <div class="study-card-meta">
                                                <span class="badge bg-light text-dark">{{ data_get($data, "university.name.$currentLang") ?? data_get($data, 'university.name.az') }}</span>
                                                @if(!empty($data->degree))
                                                    <span class="badge bg-light text-dark">{{ data_get($data, "degree.name.$currentLang") ?? data_get($data, 'degree.name.az') }}</span>
                                                @endif
                                                <span class="badge {{ $data->status ? 'bg-success' : 'bg-secondary' }}">
                                                    {{ $data->status ? __('admin.active') : __('admin.nonactive') }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-12">
                                    <div class="alert alert-light border mb-0">
                                        Məlumat tapılmadı.
                                    </div>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @foreach($studyAbroads as $value)
        <div class="modal fade" id="delete{{ $value->id }}" tabindex="-1" aria-labelledby="delete{{ $value->id }}Label" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title" id="delete{{ $value->id }}Label">@lang('admin.delete')</h2>
                        <button type="button" class="btn btn-sm btn-icon btn-outline-primary" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa-light fa-times"></i>
                        </button>
                    </div>
                    <form action="{{ route('admin.study-abroads.destroy', $value->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="modal-body">
                            <h2>@lang('admin.delete_about')</h2>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">@lang('admin.not')</button>
                            <button type="submit" class="btn btn-sm btn-primary">@lang('admin.yes')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endsection
@section('admin.js')
    <script src="{{ asset('admin/assets/vendor/js/aos.js') }}"></script>
@endsection
