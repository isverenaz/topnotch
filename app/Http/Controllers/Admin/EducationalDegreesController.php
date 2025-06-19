<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\EducationalDegreesHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\EducationalDegreesRequest;
use App\Models\EducationalDegree;
use App\Models\Translation;
use App\Repositories\EducationalDegreesRepositoryImpl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class EducationalDegreesController extends Controller
{
    protected $educationalDegreesRepository;
    protected $currentLang;

    public function __construct(EducationalDegreesRepositoryImpl $educationalDegreesRepository)
    {
        $this->middleware('permission:educational-degrees-view')->only('index');
        $this->middleware('permission:educational-degrees-create')->only(['create', 'store']);
        $this->middleware('permission:educational-degrees-edit')->only(['edit', 'update']);
        $this->middleware('permission:educational-degrees-delete')->only('destroy');

        $this->educationalDegreesRepository = $educationalDegreesRepository;
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
        $educationalDegrees = $this->educationalDegreesRepository->getAll();
        $locales = Translation::where('status',1)->get();
        $currentLang = $this->currentLang;
        return view('admin.educational-degrees.index', compact('educationalDegrees','locales','currentLang'));
    }

    public function orderBy(Request $request)
    {
        $sortedIDs = $request->sortedIDs;

        foreach ($sortedIDs as $order => $id) {
            EducationalDegree::where('id', $id)->update(['order_by' => $order + 1]);
        }

        return response()->json(['status' => 'success']);
    }

    public function create()
    {
        $locales = Translation::where('status',1)->get();
        $currentLang = $this->currentLang;
        return view('admin.educational-degrees.create', compact('locales','currentLang'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EducationalDegreesRequest $educationalDegreesRequest)
    {
        try {
            $data = EducationalDegreesHelper::data($educationalDegreesRequest);
            $dataSave = $this->educationalDegreesRepository->create($data);
            if ($dataSave) {
                $messages = Lang::get('admin.add_success');
            }else{
                $messages = Lang::get('admin.add_error');
            }
            $logData = [
                'subj_id' => $dataSave->id,
                'subj_table' => 'educational_degrees',
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
                'subj_table' => 'educational_degrees',
                'description' => $exception->getMessage(),
            ];
            saveLog($logData);
            return redirect()->back()->with('errors','errors '. $messages);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(EducationalDegree $educationalDegree)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $educationalDegree = $this->educationalDegreesRepository->edit($id);
        $locales = Translation::where('status',1)->get();
        $currentLang = $this->currentLang;
        return view('admin.educational-degrees.edit', compact('locales','educationalDegree','currentLang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EducationalDegreesRequest $educationalDegreesRequest, $id)
    {
        try {
            $educationalDegree = $this->educationalDegreesRepository->edit($id);
            $data = EducationalDegreesHelper::data($educationalDegreesRequest,$educationalDegree);
            $dataUp = $this->educationalDegreesRepository->update($id,$data);
            if ($dataUp) {
                $messages = Lang::get('admin.up_success');
            }else{
                $messages = Lang::get('admin.up_error');
            }
            $logData = [
                'subj_id' => $id,
                'subj_table' => 'educational_degrees',
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
                'subj_table' => 'educational_degrees',
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
            $educationalDegree = $this->educationalDegreesRepository->edit($id);
            if ($this->educationalDegreesRepository->delete($educationalDegree['id'])) {
                $messages = Lang::get('admin.delete_success');
                $logData = [
                    'subj_id' => $id,
                    'subj_table' => 'educational_degrees',
                    'description' => $messages,
                ];
                saveLog($logData);
                return redirect()->back()->with('success',$messages);
            }
        } catch (\Exception $exception) {
            $messages = Lang::get('admin.error');
            $logData = [
                'subj_id' => $id,
                'subj_table' => 'educational_degrees',
                'description' => $messages,
            ];
            saveLog($logData);
            return redirect()->back()->with('errors','errors '. $messages);
        }
    }
}
