<?php
namespace App\Http\Controllers\Admin;

use App\Helpers\CountriesHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CountriesRequest;
use App\Models\Country;
use App\Models\Translation;
use App\Repositories\CountriesRepositoryImpl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class CountriesController extends Controller
{
    protected $countriesRepository;
    protected $currentLang;

    public function __construct(CountriesRepositoryImpl $countriesRepository)
    {
        $this->middleware('permission:countries-view')->only('index');
        $this->middleware('permission:countries-create')->only(['create', 'store']);
        $this->middleware('permission:countries-edit')->only(['edit', 'update']);
        $this->middleware('permission:countries-delete')->only('destroy');

        $this->countriesRepository = $countriesRepository;
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
        $countries = $this->countriesRepository->getAll();
        $locales = Translation::where('status',1)->get();
        $currentLang = $this->currentLang;
        return view('admin.countries.index', compact('countries','locales','currentLang'));
    }

    public function orderBy(Request $request)
    {
        $sortedIDs = $request->sortedIDs;

        foreach ($sortedIDs as $order => $id) {
            Country::where('id', $id)->update(['order_by' => $order + 1]);
        }

        return response()->json(['status' => 'success']);
    }

    public function create()
    {
        $locales = Translation::where('status',1)->get();
        $currentLang = $this->currentLang;
        return view('admin.countries.create', compact('locales','currentLang'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CountriesRequest $countriesRequest)
    {
        try {
            $data = CountriesHelper::data($countriesRequest);
            $dataSave = $this->countriesRepository->create($data);
            if ($dataSave) {
                $messages = Lang::get('admin.add_success');
            }else{
                $messages = Lang::get('admin.add_error');
            }
            $logData = [
                'subj_id' => $dataSave->id,
                'subj_table' => 'countries',
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
                'subj_table' => 'countries',
                'description' => $exception->getMessage(),
            ];
            saveLog($logData);
            return redirect()->back()->with('errors','errors '. $messages);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Country $country)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $country = $this->countriesRepository->edit($id);
        $locales = Translation::where('status',1)->get();
        $currentLang = $this->currentLang;
        return view('admin.countries.edit', compact('locales','country','currentLang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CountriesRequest $countriesRequest, $id)
    {
        try {
            $country = $this->countriesRepository->edit($id);
            $data = CountriesHelper::data($countriesRequest,$country);
            $dataUp = $this->countriesRepository->update($id,$data);
            if ($dataUp) {
                $messages = Lang::get('admin.up_success');
            }else{
                $messages = Lang::get('admin.up_error');
            }
            $logData = [
                'subj_id' => $id,
                'subj_table' => 'countries',
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
                'subj_table' => 'countries',
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
            $country = $this->countriesRepository->edit($id);
            if ($this->countriesRepository->delete($country['id'])) {
                $messages = Lang::get('admin.delete_success');
                $logData = [
                    'subj_id' => $id,
                    'subj_table' => 'countries',
                    'description' => $messages,
                ];
                saveLog($logData);
                return redirect()->back()->with('success',$messages);
            }
        } catch (\Exception $exception) {
            $messages = $exception->getMessage();//Lang::get('admin.error');
            $logData = [
                'subj_id' => $id,
                'subj_table' => 'countries',
                'description' => $messages,
            ];
            saveLog($logData);
            return redirect()->back()->with('errors','errors '. $messages);
        }
    }
}
