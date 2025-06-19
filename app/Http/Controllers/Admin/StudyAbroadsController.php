<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\StudyAbroadsHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StudyAbroadsRequest;
use App\Models\Country;
use App\Models\EducationalDegree;
use App\Models\StudyAbroad;
use App\Models\Translation;
use App\Repositories\StudyAbroadsRepositoryImpl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class StudyAbroadsController extends Controller
{
    protected $studyAbroadsRepository;
    protected $currentLang;

    public function __construct(StudyAbroadsRepositoryImpl $studyAbroadsRepository)
    {
        $this->middleware('permission:study-abroad-view')->only('index');
        $this->middleware('permission:study-abroad-create')->only(['create', 'store']);
        $this->middleware('permission:study-abroad-edit')->only(['edit', 'update']);
        $this->middleware('permission:study-abroad-delete')->only('destroy');

        $this->studyAbroadsRepository = $studyAbroadsRepository;
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
        $studyAbroads = $this->studyAbroadsRepository->getAll();
        $locales = Translation::where('status',1)->get();
        $currentLang = $this->currentLang;
        return view('admin.study-abroads.index', compact('studyAbroads','locales','currentLang'));
    }

    public function orderBy(Request $request)
    {
        $sortedIDs = $request->sortedIDs;

        foreach ($sortedIDs as $order => $id) {
            StudyAbroad::where('id', $id)->update(['order_by' => $order + 1]);
        }

        return response()->json(['status' => 'success']);
    }

    public function create()
    {
        $locales = Translation::where('status',1)->get();
        $currentLang = $this->currentLang;
        $countries = Country::where('status',1)->get();
        $educationalDegree = EducationalDegree::where('status',1)->get();
        return view('admin.study-abroads.create', compact('locales','currentLang','countries', 'educationalDegree'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StudyAbroadsRequest $studyAbroadsRequest)
    {
        try {
            $data = StudyAbroadsHelper::data($studyAbroadsRequest);
            $dataSave = $this->studyAbroadsRepository->create($data);
            if ($dataSave) {
                $messages = Lang::get('admin.add_success');
            }else{
                $messages = Lang::get('admin.add_error');
            }
            $logData = [
                'subj_id' => $dataSave->id,
                'subj_table' => 'study_abroads',
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
                'subj_table' => 'study_abroads',
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
        $studyAbroad = $this->studyAbroadsRepository->edit($id);
        $locales = Translation::where('status',1)->get();
        $currentLang = $this->currentLang;
        $countries = Country::where('status',1)->get();
        $educationalDegree = EducationalDegree::where('status',1)->get();
        return view('admin.study-abroads.edit', compact('locales','studyAbroad','currentLang','countries','educationalDegree'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StudyAbroadsRequest $studyAbroadsRequest, $id)
    {
        try {
            $studyAbroad = $this->studyAbroadsRepository->edit($id);
            $data = StudyAbroadsHelper::data($studyAbroadsRequest,$studyAbroad);
            $dataUp = $this->studyAbroadsRepository->update($id,$data);
            if ($dataUp) {
                $messages = Lang::get('admin.up_success');
            }else{
                $messages = Lang::get('admin.up_error');
            }
            $logData = [
                'subj_id' => $id,
                'subj_table' => 'study_abroads',
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
                'subj_table' => 'study_abroads',
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
            $studyAbroad = $this->studyAbroadsRepository->edit($id);
            if ($this->studyAbroadsRepository->delete($studyAbroad['id'])) {
                $messages = Lang::get('admin.delete_success');
                $logData = [
                    'subj_id' => $id,
                    'subj_table' => 'study_abroads',
                    'description' => $messages,
                ];
                saveLog($logData);
                return redirect()->back()->with('success',$messages);
            }
        } catch (\Exception $exception) {
            $messages = Lang::get('admin.error');
            $logData = [
                'subj_id' => $id,
                'subj_table' => 'study_abroads',
                'description' => $messages,
            ];
            saveLog($logData);
            return redirect()->back()->with('errors','errors '. $messages);
        }
    }
}
