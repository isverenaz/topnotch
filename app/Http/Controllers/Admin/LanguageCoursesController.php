<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\LanguageCoursesHelper;
use App\Helpers\StudyAbroadsHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LanguageCoursesRequest;
use App\Http\Requests\Admin\StudyAbroadsRequest;
use App\Models\EducationalDegree;
use App\Models\Language;
use App\Models\LanguageCourse;
use App\Models\Teacher;
use App\Models\Translation;
use App\Repositories\LanguageCoursesRepositoryImpl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class LanguageCoursesController extends Controller
{
    protected $languageCourseRepository;
    protected $currentLang;

    public function __construct(LanguageCoursesRepositoryImpl $languageCourseRepository)
    {
        $this->middleware('permission:language-courses-view')->only('index');
        $this->middleware('permission:language-courses-create')->only(['create', 'store']);
        $this->middleware('permission:language-courses-edit')->only(['edit', 'update']);
        $this->middleware('permission:language-courses-delete')->only('destroy');

        $this->languageCourseRepository = $languageCourseRepository;
        $locales = Translation::where('status',1)->pluck('code')->toArray();
        $this->currentLang = LaravelLocalization::getCurrentLocale();
        if (!in_array($this->currentLang,$locales)){
            return self::notFound();
        }
    }

    public function notFound()
    {
        $currentLang = $this->currentLang;
        return view('site.not_found',compact('currentLang'));
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $languageCourses = $this->languageCourseRepository->getAll();
        $locales = Translation::where('status',1)->get();
        $currentLang = $this->currentLang;
        return view('admin.language-courses.index', compact('languageCourses','locales','currentLang'));
    }

    public function orderBy(Request $request)
    {
        $sortedIDs = $request->sortedIDs;

        foreach ($sortedIDs as $order => $id) {
            LanguageCourse::where('id', $id)->update(['order_by' => $order + 1]);
        }

        return response()->json(['status' => 'success']);
    }

    public function create()
    {
        $locales = Translation::where('status',1)->get();
        $currentLang = $this->currentLang;
        $mainLanguages = Language::whereNull('parent_id')->where('status',1)->get();
        $teachers = Teacher::where('status',1)->get();
        return view('admin.language-courses.create', compact('locales','currentLang','mainLanguages', 'teachers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LanguageCoursesRequest $languageCoursesRequest)
    {
        try {
            $data = LanguageCoursesHelper::data($languageCoursesRequest);
            $dataSave = $this->languageCourseRepository->create($data);
            if ($dataSave) {
                $messages = Lang::get('admin.add_success');
            }else{
                $messages = Lang::get('admin.add_error');
            }
            $logData = [
                'subj_id' => $dataSave->id,
                'subj_table' => 'language_courses',
                'description' => $messages,
            ];
            saveLog($logData);
            DB::commit();
            return redirect()->back()->with('success', $messages);
        } catch (\Exception $exception) {
            DB::rollBack();
            $messages = Lang::get('admin.error');
            $logData = [
                'subj_id' => null,
                'subj_table' => 'language_courses',
                'description' => $exception->getMessage(),
            ];
            saveLog($logData);
            return redirect()->back()->with('errors','errors '. $exception->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(StudyAbroad $studyAbroad)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $languageCourse = $this->languageCourseRepository->edit($id);
        $locales = Translation::where('status',1)->get();
        $currentLang = $this->currentLang;
        $mainLanguages = Language::whereNull('parent_id')->where('status',1)->get();
        $teachers = Teacher::where('status',1)->get();
        return view('admin.language-courses.edit', compact('locales','languageCourse','currentLang','mainLanguages','teachers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LanguageCoursesRequest $languageCoursesRequest, $id)
    {
        try {
            $languageCourse = $this->languageCourseRepository->edit($id);
            $data = LanguageCoursesHelper::data($languageCoursesRequest,$languageCourse);
            $dataUp = $this->languageCourseRepository->update($id,$data);
            if ($dataUp) {
                $messages = Lang::get('admin.up_success');
            }else{
                $messages = Lang::get('admin.up_error');
            }
            $logData = [
                'subj_id' => $id,
                'subj_table' => 'language_courses',
                'description' => $messages,
            ];
            saveLog($logData);
            DB::commit();
            return redirect()->back()->with('success', $messages);
        } catch (\Exception $exception) {
            DB::rollBack();
            $messages = Lang::get('admin.error');
            $logData = [
                'subj_id' => $id,
                'subj_table' => 'language_courses',
                'description' => $exception->getMessage(),
            ];
            saveLog($logData);
            return redirect()->back()->with('errors','errors '. $messages);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $languageCourse = $this->languageCourseRepository->edit($id);
            if ($this->languageCourseRepository->delete($languageCourse['id'])) {
                $messages = Lang::get('admin.delete_success');
                $logData = [
                    'subj_id' => $id,
                    'subj_table' => 'language_courses',
                    'description' => $messages,
                ];
                saveLog($logData);
                return redirect()->back()->with('success',$messages);
            }
        } catch (\Exception $exception) {
            $messages = Lang::get('admin.error');
            $logData = [
                'subj_id' => $id,
                'subj_table' => 'language_courses',
                'description' => $messages,
            ];
            saveLog($logData);
            return redirect()->back()->with('errors','errors '. $messages);
        }
    }
}
