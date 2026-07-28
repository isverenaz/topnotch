@extends('admin.layouts.app')
@section('admin.title')
    @lang('admin.edit')
@endsection
@section('admin.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.css">
@endsection
@section('admin.content')
    <div class="main-content">
        <div class="dashboard-breadcrumb mb-25">
            <h2>@lang('admin.edit')</h2>
        </div>
        @include('components.admin.error')
        <div class="row">
            <div class="col-12">
                <form action="{{ route('admin.study-abroads.update', $studyAbroad->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    @include('admin.study-abroads._form', [
                        'studyAbroad' => $studyAbroad,
                        'locales' => $locales,
                        'currentLang' => $currentLang,
                        'countries' => $countries,
                        'educationalDegrees' => $educationalDegrees,
                    ])
                </form>
            </div>
        </div>
    </div>
@endsection
@section('admin.js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.0/Sortable.min.js"></script>
    <script src="{{ asset('summernote/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('summernote/editor_summernote.js') }}"></script>
    <script>
        (function ($) {
            const universityRoute = @json(route('admin.universities.getUniversityByCountryId'));
            const currentLang = @json($currentLang);
            const selectedUniversityId = ($('#university_id').data('selected') || '').toString();

            function renderUniversities(universities, selectedId = '') {
                const select = $('#university_id');
                select.empty().append('<option value="">@lang("admin.choose")</option>');

                universities.forEach(function (university) {
                    const label = university.name?.[currentLang] || university.name?.az || '';
                    const option = $('<option>').val(university.id).text(label);
                    if (selectedId && selectedId.toString() === university.id.toString()) {
                        option.prop('selected', true);
                    }
                    select.append(option);
                });
            }

            function loadUniversities(countryId, selectedId = '') {
                if (!countryId) {
                    $('#university_id').empty().append('<option value="">@lang("admin.choose")</option>');
                    return;
                }

                $.ajax({
                    url: universityRoute,
                    type: 'GET',
                    data: { country_id: countryId },
                    success: function (response) {
                        if (response.success && Array.isArray(response.universities)) {
                            renderUniversities(response.universities, selectedId);
                        } else {
                            $('#university_id').empty().append('<option value="">@lang("admin.choose")</option>');
                        }
                    }
                });
            }

            $(document).on('change', '#country_id', function () {
                loadUniversities($(this).val());
            });

            const currentCountry = $('#country_id').val();
            if (currentCountry) {
                loadUniversities(currentCountry, selectedUniversityId);
            }

            document.getElementById('mainImageUpload').addEventListener('change', function (event) {
                const preview = document.getElementById('mainImagePreview');
                preview.innerHTML = '';
                const file = event.target.files[0];
                if (!file) return;
                const img = document.createElement('img');
                img.src = URL.createObjectURL(file);
                img.style.maxWidth = '280px';
                img.style.width = '100%';
                img.style.height = 'auto';
                img.style.border = '1px solid #d9d9d9';
                img.style.padding = '4px';
                preview.appendChild(img);
            });
        })(jQuery);
    </script>
@endsection
