<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\SchoolHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SchoolRequest;
use App\Models\Category;
use App\Models\Country;
use App\Models\Language;
use App\Models\School;
use App\Models\SchoolCategory;
use App\Models\Teacher;
use App\Models\Translation;
use App\Repositories\SchoolRepositoryImpl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class SchoolController extends Controller
{
    protected $languagesRepository;
    protected $currentLang;

    public function __construct(SchoolRepositoryImpl $languagesRepository)
    {
        $this->middleware('permission:languages-view')->only('index');
        $this->middleware('permission:languages-create')->only(['create', 'store']);
        $this->middleware('permission:languages-edit')->only(['edit', 'update']);
        $this->middleware('permission:languages-delete')->only('destroy');

        $this->languagesRepository = $languagesRepository;
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
        $schools = $this->languagesRepository->getAll();
        $locales = Translation::where('status',1)->get();
        $currentLang = $this->currentLang;
        return view('admin.schools.index', compact('schools','locales','currentLang'));
    }

    public function orderBy(Request $request)
    {
        $sortedIDs = $request->sortedIDs;

        foreach ($sortedIDs as $order => $id) {
            School::where('id', $id)->update(['order_by' => $order + 1]);
        }

        return response()->json(['status' => 'success']);
    }

    public function create()
    {
        $locales = Translation::where('status',1)->get();
        $currentLang = $this->currentLang;
        $categories = SchoolCategory::where('status',1)->get();
        $countries = Country::where('status',1)->get();
        $mainLanguages = Language::whereNull('parent_id')->where('status',1)->get();
        $teachers = Teacher::where('status',1)->get();
        return view('admin.schools.create', compact('countries','categories','locales','currentLang', 'mainLanguages', 'teachers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SchoolRequest $schoolRequest)
    {
        try {
            $data = SchoolHelper::data($schoolRequest);
            $dataSave = $this->languagesRepository->create($data);
            if ($dataSave) {
                $messages = Lang::get('admin.add_success');
            }else{
                $messages = Lang::get('admin.add_error');
            }
            $logData = [
                'subj_id' => $dataSave->id,
                'subj_table' => 'schools',
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
                'subj_table' => 'schools',
                'description' => $exception->getMessage(),
            ];
            saveLog($logData);
            return redirect()->back()->with('errors','errors '. $messages);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(School $school)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $school = $this->languagesRepository->edit($id);
        $locales = Translation::where('status',1)->get();
        $currentLang = $this->currentLang;
        $categories = SchoolCategory::where('status',1)->get();
        $countries = Country::where('status',1)->get();
        $mainLanguages = Language::whereNull('parent_id')->where('status',1)->get();
        $teachers = Teacher::where('status',1)->get();
        return view('admin.schools.edit', compact('school','countries','categories','locales','currentLang', 'mainLanguages', 'teachers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SchoolRequest $schoolRequest, $id)
    {
        try {
            $language = $this->languagesRepository->edit($id);
            $data = SchoolHelper::data($schoolRequest,$language);
            $dataUp = $this->languagesRepository->update($id,$data);
            if ($dataUp) {
                $messages = Lang::get('admin.up_success');
            }else{
                $messages = Lang::get('admin.up_error');
            }
            $logData = [
                'subj_id' => $id,
                'subj_table' => 'schools',
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
                'subj_table' => 'schools',
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
            $language = $this->languagesRepository->edit($id);
            if ($this->languagesRepository->delete($language['id'])) {
                $messages = Lang::get('admin.delete_success');
                $logData = [
                    'subj_id' => $id,
                    'subj_table' => 'schools',
                    'description' => $messages,
                ];
                saveLog($logData);
                return redirect()->back()->with('success',$messages);
            }
        } catch (\Exception $exception) {
            $messages = Lang::get('admin.error');
            $logData = [
                'subj_id' => $id,
                'subj_table' => 'schools',
                'description' => $messages,
            ];
            saveLog($logData);
            return redirect()->back()->with('errors','errors '. $messages);
        }
    }
    public function getParentLanguagesByLanguageId(Request $request) {
        $languageId = $request->language_id;
        $languages = Language::whereNotNull('parent_id')->where(['status'=> 1,'parent_id' => $languageId])->get();
        return response()->json(['success' => true,'languages' => $languages]);
    }
}
