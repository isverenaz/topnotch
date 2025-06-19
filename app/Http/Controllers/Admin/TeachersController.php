<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\TeachersHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TeachersRequest;
use App\Models\Position;
use App\Models\Teacher;
use App\Models\Translation;
use App\Repositories\TeachersRepositoryImpl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class TeachersController extends Controller
{
    protected $teachersRepository;
    protected $currentLang;

    public function __construct(TeachersRepositoryImpl $teachersRepository)
    {
        $this->middleware('permission:teachers-view')->only('index');
        $this->middleware('permission:teachers-create')->only(['create', 'store']);
        $this->middleware('permission:teachers-edit')->only(['edit', 'update']);
        $this->middleware('permission:teachers-delete')->only('destroy');

        $this->teachersRepository = $teachersRepository;
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
        $teachers = $this->teachersRepository->getAll();
//        dd($teachers);
        $locales = Translation::where('status',1)->get();
        $currentLang = $this->currentLang;
        return view('admin.teachers.index', compact('teachers','locales','currentLang'));
    }

    public function orderBy(Request $request)
    {
        $sortedIDs = $request->sortedIDs;

        foreach ($sortedIDs as $order => $id) {
            Teacher::where('id', $id)->update(['order_by' => $order + 1]);
        }

        return response()->json(['status' => 'success']);
    }

    public function create()
    {
        $locales = Translation::where('status',1)->get();
        $currentLang = $this->currentLang;
        $positions = Position::where('status',1)->get();
        return view('admin.teachers.create', compact('locales','currentLang', 'positions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TeachersRequest $teachersRequest)
    {
        try {
            $data = TeachersHelper::data($teachersRequest);
            $dataSave = $this->teachersRepository->create($data);
            if ($dataSave) {
                $messages = Lang::get('admin.add_success');
            }else{
                $messages = Lang::get('admin.add_error');
            }
            $logData = [
                'subj_id' => $dataSave->id,
                'subj_table' => 'teachers',
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
                'subj_table' => 'teachers',
                'description' => $exception->getMessage(),
            ];
            saveLog($logData);
            return redirect()->back()->with('errors','errors '. $messages);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Teacher $teacher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $teacher = $this->teachersRepository->edit($id);
        $locales = Translation::where('status',1)->get();
        $currentLang = $this->currentLang;
        $positions = Position::where('status',1)->get();
        return view('admin.teachers.edit', compact('locales','teacher','currentLang', 'positions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TeachersRequest $teachersRequest, $id)
    {
        try {
            $teacher = $this->teachersRepository->edit($id);
            $data = TeachersHelper::data($teachersRequest,$teacher);
            $dataUp = $this->teachersRepository->update($id,$data);
            if ($dataUp) {
                $messages = Lang::get('admin.up_success');
            }else{
                $messages = Lang::get('admin.up_error');
            }
            $logData = [
                'subj_id' => $id,
                'subj_table' => 'teachers',
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
                'subj_table' => 'teachers',
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
            $teacher = $this->teachersRepository->edit($id);
            if ($this->teachersRepository->delete($teacher['id'])) {
                $messages = Lang::get('admin.delete_success');
                $logData = [
                    'subj_id' => $id,
                    'subj_table' => 'teachers',
                    'description' => $messages,
                ];
                saveLog($logData);
                return redirect()->back()->with('success',$messages);
            }
        } catch (\Exception $exception) {
            $messages = Lang::get('admin.error');
            $logData = [
                'subj_id' => $id,
                'subj_table' => 'teachers',
                'description' => $messages,
            ];
            saveLog($logData);
            return redirect()->back()->with('errors','errors '. $messages);
        }
    }
}
