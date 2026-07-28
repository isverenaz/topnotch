@php
    $isEdit = !empty($studyAbroad);
    $nameValue = fn($code) => old("name.$code", data_get($studyAbroad, "name.$code"));
    $textValue = fn($code) => old("text.$code", data_get($studyAbroad, "text.$code"));
    $fullTextValue = fn($code) => old("full_text.$code", data_get($studyAbroad, "full_text.$code"));
    $currentCountryId = old('country_id', data_get($studyAbroad, 'country_id'));
    $currentUniversityId = old('university_id', data_get($studyAbroad, 'university_id'));
    $currentDegreeId = old('degree_id', data_get($studyAbroad, 'degree_id'));
    $currentStatus = old('status', data_get($studyAbroad, 'status', 1));
@endphp

<div class="panel">
    <div class="panel-body">
        <ul class="nav nav-pills nav-justified" role="tablist">
            @foreach($locales as $key => $lang)
                <li class="nav-item waves-effect waves-light">
                    <a class="nav-link @if($loop->first) active @endif" data-bs-toggle="tab" href="#{{ $lang->code }}" role="tab">
                        <span class="d-none d-sm-block">{{ strtoupper($lang->code) }}</span>
                    </a>
                </li>
            @endforeach
            <li class="nav-item waves-effect waves-light">
                <a class="nav-link" data-bs-toggle="tab" href="#other" role="tab">
                    <span class="d-none d-sm-block">@lang('admin.other')</span>
                </a>
            </li>
        </ul>

        <div class="tab-content p-3 text-muted">
            @foreach($locales as $lang)
                <div class="tab-pane @if($loop->first) active @endif" id="{{ $lang->code }}" role="tabpanel">
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label">@lang('admin.title') - {{ $lang->code }}</label>
                            <input type="text" class="form-control" name="name[{{ $lang->code }}]" value="{{ $nameValue($lang->code) }}">
                        </div>
                        <div class="col-12">
                            <label class="form-label">@lang('admin.text') - {{ $lang->code }}</label>
                            <textarea class="form-control" name="text[{{ $lang->code }}]" rows="4">{{ $textValue($lang->code) }}</textarea>
                        </div>
                        <div class="col-12">
                            <label class="form-label">@lang('admin.full_text') - {{ $lang->code }}</label>
                            <textarea class="editor form-control"
                                      data-locale="{{ $lang->code }}"
                                      data-csrf-token="{{ csrf_token() }}"
                                      name="full_text[{{ $lang->code }}]"
                                      rows="8">{!! $fullTextValue($lang->code) !!}</textarea>
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="tab-pane" id="other" role="tabpanel">
                <div class="row g-3">
                    <div class="col-lg-4 col-md-6">
                        <label class="form-label">@lang('admin.countries')</label>
                        <select class="form-control" name="country_id" id="country_id" data-selected="{{ $currentCountryId }}">
                            <option value="">@lang('admin.choose')</option>
                            @foreach($countries as $country)
                                <option value="{{ $country->id }}" @selected((string) $currentCountryId === (string) $country->id)>
                                    {{ data_get($country, "name.$currentLang") }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <label class="form-label">@lang('admin.universities')</label>
                        <select class="form-control" name="university_id" id="university_id" data-selected="{{ $currentUniversityId }}">
                            <option value="">@lang('admin.choose')</option>
                            @if($isEdit && !empty($studyAbroad->university))
                                <option value="{{ $studyAbroad->university->id }}" selected>
                                    {{ data_get($studyAbroad, "university.name.$currentLang") }}
                                </option>
                            @endif
                        </select>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <label class="form-label">@lang('admin.educational_degree')</label>
                        <select class="form-control" name="degree_id">
                            <option value="">@lang('admin.choose')</option>
                            @foreach($educationalDegrees as $degree)
                                <option value="{{ $degree->id }}" @selected((string) $currentDegreeId === (string) $degree->id)>
                                    {{ data_get($degree, "name.$currentLang") }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <label class="form-label">@lang('admin.status')</label>
                        <select class="form-control" name="status">
                            <option value="1" @selected((string) $currentStatus === '1')>@lang('admin.active')</option>
                            <option value="0" @selected((string) $currentStatus === '0')>@lang('admin.nonactive')</option>
                        </select>
                    </div>

                    <div class="col-12">
                        <label class="form-label">@lang('admin.main_image')</label>
                        <input type="file" name="image" id="mainImageUpload" class="form-control">
                        <div class="form-text">Recommended: 1228x1228px, under 226 KB.</div>
                        <div id="mainImagePreview" class="mt-3"></div>
                        @if($isEdit && !empty($studyAbroad->image))
                            <div class="mt-3">
                                <img src="{{ asset('uploads/studyAbroads/' . $studyAbroad->image) }}" alt="{{ data_get($studyAbroad, "name.$currentLang") }}" style="max-width: 280px; width: 100%; height: auto;">
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-sm btn-primary">@lang('admin.save')</button>
    </div>
</div>
