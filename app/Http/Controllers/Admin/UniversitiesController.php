<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\UniversitiesHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UniversitiesRequest;
use App\Models\Country;
use App\Models\Translation;
use App\Models\University;
use App\Repositories\UniversitiesRepositoryImpl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class UniversitiesController extends Controller
{
    protected $universitiesRepository;
    protected $currentLang;

    public function __construct(UniversitiesRepositoryImpl $universitiesRepository)
    {
        $this->middleware('permission:universities-view')->only('index');
        $this->middleware('permission:universities-create')->only(['create', 'store']);
        $this->middleware('permission:universities-edit')->only(['edit', 'update']);
        $this->middleware('permission:universities-delete')->only('destroy');

        $this->universitiesRepository = $universitiesRepository;
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
        $universities = $this->universitiesRepository->getAll();
        $locales = Translation::where('status',1)->get();
        $currentLang = $this->currentLang;
        return view('admin.universities.index', compact('universities','locales','currentLang'));
    }

    public function orderBy(Request $request)
    {
        $sortedIDs = $request->sortedIDs;

        foreach ($sortedIDs as $order => $id) {
            University::where('id', $id)->update(['order_by' => $order + 1]);
        }

        return response()->json(['status' => 'success']);
    }

    public function create()
    {
        $locales = Translation::where('status',1)->get();
        $currentLang = $this->currentLang;
        $countries = Country::where('status',1)->get();
        return view('admin.universities.create', compact('locales','currentLang', 'countries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UniversitiesRequest $universitiesRequest)
    {
        try {
            $data = UniversitiesHelper::data($universitiesRequest);
            $dataSave = $this->universitiesRepository->create($data);
            if ($dataSave) {
                $messages = Lang::get('admin.add_success');
            }else{
                $messages = Lang::get('admin.add_error');
            }
            $logData = [
                'subj_id' => $dataSave->id,
                'subj_table' => 'universities',
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
                'subj_table' => 'universities',
                'description' => $exception->getMessage(),
            ];
            saveLog($logData);
            return redirect()->back()->with('errors','errors '. $messages);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(University $university)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $university = $this->universitiesRepository->edit($id);
        $locales = Translation::where('status',1)->get();
        $currentLang = $this->currentLang;
        $countries = Country::where('status',1)->get();
        return view('admin.universities.edit', compact('locales','currentLang', 'countries','university'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UniversitiesRequest $universitiesRequest, $id)
    {
        try {
            $university = $this->universitiesRepository->edit($id);
            $data = UniversitiesHelper::data($universitiesRequest,$university);
            $dataUp = $this->universitiesRepository->update($id,$data);
            if ($dataUp) {
                $messages = Lang::get('admin.up_success');
            }else{
                $messages = Lang::get('admin.up_error');
            }
            $logData = [
                'subj_id' => $id,
                'subj_table' => 'universities',
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
                'subj_table' => 'universities',
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
            $university = $this->universitiesRepository->edit($id);
            if ($this->universitiesRepository->delete($university['id'])) {
                $messages = Lang::get('admin.delete_success');
                $logData = [
                    'subj_id' => $id,
                    'subj_table' => 'universities',
                    'description' => $messages,
                ];
                saveLog($logData);
                return redirect()->back()->with('success',$messages);
            }
        } catch (\Exception $exception) {
            $messages = Lang::get('admin.error');
            $logData = [
                'subj_id' => $id,
                'subj_table' => 'universities',
                'description' => $messages,
            ];
            saveLog($logData);
            return redirect()->back()->with('errors','errors '. $messages);
        }
    }

    public function getUniversityByCountryId(Request $request) {
        $countryId = $request->country_id;
        $universities = University::where(['status'=> 1,'country_id' => $countryId])->get();
        return response()->json(['success' => true,'universities' => $universities]);
    }
}
