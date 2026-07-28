<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\CourseCategoryHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CourseCategoryRequest;
use App\Models\CourseCategory;
use App\Models\Translation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class CourseCategoriesController extends Controller
{
    protected $currentLang;

    public function __construct()
    {
        $this->middleware('permission:language-courses-view')->only('index');
        $this->middleware('permission:language-courses-create')->only(['store']);
        $this->middleware('permission:language-courses-edit')->only(['update']);
        $this->middleware('permission:language-courses-delete')->only('destroy');

        $locales = Translation::where('status', 1)->pluck('code')->toArray();
        $this->currentLang = LaravelLocalization::getCurrentLocale();
        if (!in_array($this->currentLang, $locales)) {
            return self::notFound();
        }
    }

    public function notFound()
    {
        $currentLang = $this->currentLang;
        return view('site.not_found', compact('currentLang'));
    }

    public function index()
    {
        $categories = CourseCategory::orderBy('order_by', 'asc')->orderByDesc('id')->get();
        $locales = Translation::where('status', 1)->get();
        $currentLang = $this->currentLang;
        return view('admin.course-category.index', compact('categories', 'locales', 'currentLang'));
    }

    public function create()
    {
        return redirect()->route('admin.course-categories.index');
    }

    public function show($id)
    {
        return redirect()->route('admin.course-categories.index');
    }

    public function edit($id)
    {
        return redirect()->route('admin.course-categories.index');
    }

    public function store(CourseCategoryRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = CourseCategoryHelper::data($request);
            $category = CourseCategory::create($data);
            $messages = $category ? Lang::get('admin.add_success') : Lang::get('admin.add_error');
            saveLog([
                'subj_id' => $category->id ?? null,
                'subj_table' => 'course_categories',
                'description' => $messages,
            ]);
            DB::commit();
            return redirect()->back()->with('success', $messages);
        } catch (\Exception $exception) {
            DB::rollBack();
            saveLog([
                'subj_id' => null,
                'subj_table' => 'course_categories',
                'description' => $exception->getMessage(),
            ]);
            return redirect()->back()->with('errors', 'errors ' . Lang::get('admin.error'));
        }
    }

    public function update(CourseCategoryRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $data = CourseCategoryHelper::data($request);
            $category = CourseCategory::whereId($id)->update($data);
            $messages = $category ? Lang::get('admin.up_success') : Lang::get('admin.up_error');
            saveLog([
                'subj_id' => $id,
                'subj_table' => 'course_categories',
                'description' => $messages,
            ]);
            DB::commit();
            return redirect()->back()->with('success', $messages);
        } catch (\Exception $exception) {
            DB::rollBack();
            saveLog([
                'subj_id' => $id,
                'subj_table' => 'course_categories',
                'description' => $exception->getMessage(),
            ]);
            return redirect()->back()->with('errors', 'errors ' . Lang::get('admin.error'));
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $category = CourseCategory::whereId($id)->first();
            if ($category && $category->delete()) {
                saveLog([
                    'subj_id' => $id,
                    'subj_table' => 'course_categories',
                    'description' => Lang::get('admin.delete_success'),
                ]);
                return redirect()->back()->with('success', Lang::get('admin.delete_success'));
            }
        } catch (\Exception $exception) {
            saveLog([
                'subj_id' => $id,
                'subj_table' => 'course_categories',
                'description' => $exception->getMessage(),
            ]);
            return redirect()->back()->with('errors', 'errors ' . Lang::get('admin.error'));
        }
    }
}
