<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\SchoolCategoryHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SchoolCategoryRequest;
use App\Models\SchoolCategory;
use App\Models\Translation;
use App\Repositories\SchoolCategoryRepositoryImpl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class SchoolCategoriesController extends Controller
{
    protected $categoryRepository;
    protected $currentLang;

    public function __construct(SchoolCategoryRepositoryImpl $categoryRepository)
    {
        $this->middleware('permission:category-view')->only('index');
        $this->middleware('permission:category-create')->only(['create', 'store']);
        $this->middleware('permission:category-edit')->only(['edit', 'update']);
        $this->middleware('permission:category-delete')->only('destroy');

        $this->categoryRepository = $categoryRepository;
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
    public function index()
    {
        $categories = $this->categoryRepository->getAll();
        $locales = Translation::where('status',1)->get();
        $currentLang = $this->currentLang;
        return view('admin.school-category.index', compact('categories','locales','currentLang'));
    }

    public function create()
    {
        //
    }

    public function store(SchoolCategoryRequest $categoryRequest)
    {
        try {
            $data = SchoolCategoryHelper::data($categoryRequest);
            $category = $this->categoryRepository->create($data);
            if ($category) {
                $messages = Lang::get('admin.add_success');
            }else{
                $messages = Lang::get('admin.add_error');
            }
            $logData = [
                'subj_id' => $category->id,
                'subj_table' => 'school_categories',
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
                'subj_table' => 'school_categories',
                'description' => $exception->getMessage(),
            ];
            saveLog($logData);
            return redirect()->back()->with('errors','errors '. $messages);
        }
    }

    public function show(SchoolCategory $category)
    {
        //
    }

    public function edit(SchoolCategory $category)
    {
        //
    }

    public function update(SchoolCategoryRequest $categoryRequest, $id)
    {
        try {
            $data = SchoolCategoryHelper::data($categoryRequest);
            $category = $this->categoryRepository->update($id,$data);
            if ($category) {
                $messages = Lang::get('admin.up_success');
            }else{
                $messages = Lang::get('admin.up_error');
            }
            $logData = [
                'subj_id' => $id,
                'subj_table' => 'school_categories',
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
                'subj_table' => 'school_categories',
                'description' => $exception->getMessage(),
            ];
            saveLog($logData);
            return redirect()->back()->with('errors','errors '. $messages);
        }
    }

    public function destroy($id)
    {
        try {
            $category = $this->categoryRepository->edit($id);

            //News::where('category_id',$id)->delete();
            if ($this->categoryRepository->delete($category['id'])) {
                $messages = Lang::get('admin.delete_success');
                $logData = [
                    'subj_id' => $id,
                    'subj_table' => 'school_categories',
                    'description' => $messages,
                ];
                saveLog($logData);
                return redirect()->back()->with('success', $messages);
            }
        } catch (\Exception $exception) {
            $messages = Lang::get('admin.error');
            $logData = [
                'subj_id' => $id,
                'subj_table' => 'school_categories',
                'description' => $messages,
            ];
            saveLog($logData);
            return redirect()->back()->with('errors', 'errors ' . $messages);
        }
    }

}
