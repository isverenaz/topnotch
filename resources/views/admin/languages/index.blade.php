@extends('admin.layouts.app')
@section('admin.title')
    @lang('admin.languages')
@endsection
@section('admin.css')
    <meta name="_token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/css/jquery.uploader.css') }}">
@endsection
@section('admin.content')
    <!-- main content start -->
    <div class="main-content">
        @include('components.admin.error')
        <div class="row">
            <div class="col-12">
                <div class="panel">

                    <div class="panel-header">
                        <h5>@lang('admin.languages')</h5>
                        <div class="btn-box d-flex flex-wrap gap-2">
                            <div id="tableSearch"></div>
                            @can('languages-create')
                            <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#addTaskModal"><i class="fa-light fa-plus"></i> @lang('admin.add')
                            </button>
                            @endcan
                        </div>
                    </div>
                    <div class="panel-body">
                        <table class="table table-dashed table-hover digi-dataTable task-table table-striped"
                               id="taskTable">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>@lang('admin.title')</th>
                                <th>@lang('admin.settings')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(!empty($languages[0]) && isset($languages[0]))
                                @foreach($languages as $data)
                                    @if(empty($data['parent_id']))
                                        <tr>
                                            <td>{{ $data['id'] }}</td>
                                            <td>
                                                <div class="table-category-card">
                                                    <div class="part-txt">
                                                        <span class="category-name">{{ !empty($data['name'][$currentLang])? $data['name'][$currentLang]: null }}</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="btn-box">
                                                    @can('languages-view')
                                                    @if(!empty($data['parentLanguages'][0]) && isset($data['parentLanguages'][0]))
                                                        <button class="btn btn-sm btn-icon btn-primary" data-bs-toggle="modal"
                                                                data-bs-target="#eyeMain{{$data['id']}}"><i
                                                                class="fa-light fa-eye"></i>
                                                        </button>
                                                    @endif
                                                    @endcan
                                                    @can('languages-edit')
                                                    <button class="btn btn-sm btn-icon btn-primary" data-bs-toggle="modal"
                                                            data-bs-target="#editMain{{$data['id']}}"><i
                                                            class="fa-light fa-edit"></i>
                                                    </button>
                                                    @endcan
                                                    @can('languages-delete')
                                                    <button class="btn btn-sm btn-icon btn-danger" data-bs-toggle="modal"
                                                            data-bs-target="#deleteMain{{$data['id']}}"><i
                                                            class="fa-light fa-trash-can"></i></button>
                                                    @endcan
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                        <div class="table-bottom-control"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- main content end -->

    <!-- add new task modal -->
    <div class="modal fade" id="addTaskModal" tabindex="-1" aria-labelledby="addTaskModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title" id="addTaskModalLabel">@lang('admin.add')</h2>
                    <button type="button" class="btn btn-sm btn-icon btn-outline-primary" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fa-light fa-times"></i>
                    </button>
                </div>
                <form action="{{ route('admin.languages.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
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
                                                <label class="form-label">@lang('admin.title')
                                                    - {{$lang['code']}}</label>
                                                <input type="text" class="form-control" name="name[{{$lang['code']}}]">
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                            <div class="tab-pane" id="other" role="tabpanel">
                                <div class="row g-3">
                                    <div class="col-md-12">
                                        <label for="input-category" class="form-label">@lang('admin.main_category')</label>
                                        <select class="form-control" name="parent_id" id="input-category">
                                            <option value="">@lang('admin.choose')</option>
                                            @foreach($mainLanguages as $mainLang)
                                                <option value="{{$mainLang->id}}">{{ !empty($mainLang['name'][$currentLang])? $mainLang['name'][$currentLang]: null }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @if(!empty($teachers))
                                        <div class="col-md-12">
                                            <label for="input-category" class="form-label">@lang('admin.teachers')</label>
                                            <select class="form-control" name="teacher_id" id="input-category">
                                                <option value="">@lang('admin.choose')</option>
                                                @foreach($teachers as $teacher)
                                                    <option value="{{$teacher->id}}">{{ !empty(json_decode($teacher, true)['name'][$currentLang])? json_decode($teacher, true)['name'][$currentLang]: null }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endif
                                    <div class="col-sm-12">
                                        <label class="form-label">@lang('admin.status')</label>
                                        <select class="form-control" name="status">
                                            <option value="1" >Aktiv</option>
                                            <option value="0" >Deactiv</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">@lang('admin.close')</button>
                        <button type="submit" class="btn btn-sm btn-primary">@lang('admin.save')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- add new task modal -->

    @if(!empty($languages[0]) && isset($languages[0]))
        @foreach($languages as $value)
            <!-- edit task modal -->
            <div class="modal fade" id="editMain{{$value['id']}}" tabindex="-1" aria-labelledby="editMain{{$value['id']}}Label" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <form action="{{ route('admin.languages.update',$value['id']) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="modal-body">
                                <ul class="nav nav-pills nav-justified" role="tablist">
                                    @if(!empty($locales))
                                        @foreach($locales as $key => $lang)
                                            <li class="nav-item waves-effect waves-light">
                                                <a class="nav-link @if(++$key ==1) active @endif" data-bs-toggle="tab" href="#edit-main{{$value['id']}}{{$lang->code}}" role="tab">
                                                    <span class="d-none d-sm-block">{{$lang->code}}</span>
                                                </a>
                                            </li>
                                        @endforeach
                                    @endif
                                    <li class="nav-item waves-effect waves-light">
                                        <a class="nav-link" data-bs-toggle="tab"
                                           href="#editother-main{{$value['id']}}" role="tab">
                                            <span class="d-none d-sm-block">@lang('admin.other')</span>
                                        </a>
                                    </li>
                                </ul>
                                <div class="tab-content p-3 text-muted">
                                    @if(!empty($locales))
                                        @foreach($locales as $key => $lang)
                                            <div class="tab-pane @if(++$key ==1) active @endif"
                                                 id="edit-main{{$value['id']}}{{$lang['code']}}" role="tabpanel">
                                                <div class="row g-3">
                                                    <div class="col-12">
                                                        <label class="form-label">@lang('admin.title')
                                                            - {{$lang['code']}}</label>
                                                        <input type="text" class="form-control"
                                                               name="name[{{$lang['code']}}]"
                                                               value="{{ !empty($value['name'][$lang['code']])? $value['name'][$lang['code']]: NULL }}">
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                    <div class="tab-pane" id="editother-main{{$value['id']}}" role="tabpanel">
                                        <div class="row g-3">
                                            @if(!empty($mainLanguages))
                                                <div class="col-md-12">
                                                    <label for="input-category" class="form-label">@lang('admin.main_languages')</label>
                                                    <select class="form-control" name="parent_id" id="input-category">
                                                        <option value="">@lang('admin.choose')</option>
                                                        @foreach($mainLanguages as $mainLang)
                                                            <option value="{{$mainLang->id}}" @if(!empty($value['parent_id']) && $value['parent_id'] == $mainLang['id']) selected @endif>{{ !empty(json_decode($mainLang, true)['name'][$currentLang])? json_decode($mainLang, true)['name'][$currentLang]: null }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            @endif
                                            @if(!empty($teachers))
                                                <div class="col-md-12">
                                                    <label for="input-category" class="form-label">@lang('admin.teachers')</label>
                                                    <select class="form-control" name="teacher_id" id="input-category">
                                                        <option value="">@lang('admin.choose')</option>
                                                        @foreach($teachers as $teacher)
                                                            <option value="{{$teacher->id}}" @if(!empty($value['teacher_id']) && $value['teacher_id'] == $teacher['id']) selected @endif>{{ !empty(json_decode($teacher, true)['name'][$currentLang])? json_decode($teacher, true)['name'][$currentLang]: null }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            @endif
                                            <div class="col-sm-12">
                                                <label class="form-label">@lang('admin.status')</label>
                                                <select class="form-control" name="status">
                                                    <option value="1" @if($value['status'] ==1) selected @endif>Aktiv</option>
                                                    <option value="0" @if($value['status'] ==0) selected @endif>Deactiv</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">@lang('admin.close')</button>
                                <button type="submit" class="btn btn-sm btn-primary">@lang('admin.save')</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- edit task modal -->
            <div class="modal fade" id="deleteMain{{$value['id']}}" tabindex="-1" aria-labelledby="deleteMain{{$value['id']}}Label" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2 class="modal-title" id="deleteMain{{$value['id']}}Label">@lang('admin.delete')</h2>
                            <button type="button" class="btn btn-sm btn-icon btn-outline-primary" data-bs-dismiss="modal" aria-label="Close">
                                <i class="fa-light fa-times"></i>
                            </button>
                        </div>
                        <form action="{{ route('admin.languages.destroy',$value['id']) }}" method="POST">
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
            @if(!empty($value['parentLanguages'][0]) && isset($value['parentLanguages'][0]))
                <!-- edit task modal -->
                <div class="modal fade" id="eyeMain{{$value['id']}}" tabindex="-1" aria-labelledby="eyeMain{{$value['id']}}Label" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content">
                            <table class="table table-dashed table-hover digi-dataTable task-table table-striped"
                                   id="taskTable">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>@lang('admin.title')</th>
                                    <th>@lang('admin.settings')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($value['parentLanguages'] as $parentLanguages)
                                    <tr>
                                        <td>{{ $parentLanguages['id'] }}</td>
                                        <td>
                                            <div class="table-category-card">
                                                <div class="part-txt">
                                                    <span class="category-name">{{ !empty($parentLanguages['name'][$currentLang])? $parentLanguages['name'][$currentLang]: null }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="btn-box">
                                                @can('languages-edit')
                                                <button class="btn btn-sm btn-icon btn-primary" data-bs-toggle="modal"
                                                        data-bs-target="#editParent{{$parentLanguages['id']}}"><i
                                                        class="fa-light fa-edit"></i>
                                                </button>
                                                @endcan
                                                @can('languages-delete')
                                                <button class="btn btn-sm btn-icon btn-danger" data-bs-toggle="modal"
                                                        data-bs-target="#deleteParent{{$parentLanguages['id']}}"><i
                                                        class="fa-light fa-trash-can"></i></button>
                                                @endcan
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- edit task modal -->
                @foreach($value['parentLanguages'] as $parentLanguages)
                    <div class="modal fade" id="editParent{{$parentLanguages['id']}}" tabindex="-1" aria-labelledby="editParent{{$parentLanguages['id']}}Label" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <form action="{{ route('admin.languages.update',$parentLanguages['id']) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <ul class="nav nav-pills nav-justified" role="tablist">
                                            @if(!empty($locales))
                                                @foreach($locales as $key => $lang)
                                                    <li class="nav-item waves-effect waves-light">
                                                        <a class="nav-link @if(++$key ==1) active @endif" data-bs-toggle="tab" href="#edit-parent{{$parentLanguages['id']}}{{$lang->code}}" role="tab">
                                                            <span class="d-none d-sm-block">{{$lang->code}}</span>
                                                        </a>
                                                    </li>
                                                @endforeach
                                            @endif
                                            <li class="nav-item waves-effect waves-light">
                                                <a class="nav-link" data-bs-toggle="tab"
                                                   href="#editother-parent{{$parentLanguages['id']}}" role="tab">
                                                    <span class="d-none d-sm-block">@lang('admin.other')</span>
                                                </a>
                                            </li>
                                        </ul>
                                        <div class="tab-content p-3 text-muted">
                                            @if(!empty($locales))
                                                @foreach($locales as $key => $lang)
                                                    <div class="tab-pane @if(++$key ==1) active @endif"
                                                         id="edit-parent{{$parentLanguages['id']}}{{$lang['code']}}" role="tabpanel">
                                                        <div class="row g-3">
                                                            <div class="col-12">
                                                                <label class="form-label">@lang('admin.title')
                                                                    - {{$lang['code']}}</label>
                                                                <input type="text" class="form-control"
                                                                       name="name[{{$lang['code']}}]"
                                                                       value="{{ !empty($parentLanguages['name'][$lang['code']])? $parentLanguages['name'][$lang['code']]: NULL }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                            <div class="tab-pane" id="editother-parent{{$parentLanguages['id']}}" role="tabpanel">
                                                <div class="row g-3">
                                                    @if(!empty($parentLanguages['parent_id']))
                                                        <div class="col-md-12">
                                                            <label for="input-category" class="form-label">@lang('admin.main_category')</label>
                                                            <select class="form-control" name="parent_id" id="input-category">
                                                                <option value="">@lang('admin.choose')</option>
                                                                @foreach($mainLanguages as $mainLang)
                                                                    <option value="{{$mainLang->id}}" @if(!empty($parentLanguages['parent_id']) && $parentLanguages['parent_id'] == $mainLang['id']) selected @endif>{{ !empty(json_decode($mainLang, true)['name'][$currentLang])? json_decode($mainLang, true)['name'][$currentLang]: null }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    @endif
                                                    @if(!empty($teachers))
                                                        <div class="col-md-12">
                                                            <label for="input-category" class="form-label">@lang('admin.teachers')</label>
                                                            <select class="form-control" name="teacher_id" id="input-category">
                                                                <option value="">@lang('admin.choose')</option>
                                                                @foreach($teachers as $teacher)
                                                                    <option value="{{$teacher->id}}" @if(!empty($parentLanguages['teacher_id']) && $parentLanguages['teacher_id'] == $teacher['id']) selected @endif>{{ !empty(json_decode($teacher, true)['name'][$currentLang])? json_decode($teacher, true)['name'][$currentLang]: null }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    @endif
                                                    <div class="col-sm-12">
                                                        <label class="form-label">@lang('admin.status')</label>
                                                        <select class="form-control" name="status">
                                                            <option value="1" @if($parentLanguages['status'] ==1) selected @endif>Aktiv</option>
                                                            <option value="0" @if($parentLanguages['status'] ==0) selected @endif>Deactiv</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">@lang('admin.close')</button>
                                        <button type="submit" class="btn btn-sm btn-primary">@lang('admin.save')</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- edit task modal -->
                    <div class="modal fade" id="deleteParent{{$parentLanguages['id']}}" tabindex="-1" aria-labelledby="deleteParent{{$parentLanguages['id']}}Label" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h2 class="modal-title" id="deletecategory{{$parentLanguages['id']}}Label">@lang('admin.delete')</h2>
                                    <button type="button" class="btn btn-sm btn-icon btn-outline-primary" data-bs-dismiss="modal" aria-label="Close">
                                        <i class="fa-light fa-times"></i>
                                    </button>
                                </div>
                                <form action="{{ route('admin.languages.destroy',$parentLanguages['id']) }}" method="POST">
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
            @endif
        @endforeach
    @endif
@endsection
@section('admin.js')
    <script src="{{ asset('admin/assets/vendor/js/jquery.uploader.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/category.js') }}"></script>
@endsection
