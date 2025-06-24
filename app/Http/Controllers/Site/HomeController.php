<?php
namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Accreditation;
use App\Models\Career;
use App\Models\Category;
use App\Models\Charter;
use App\Models\City;
use App\Models\Complaint;
use App\Models\Country;
use App\Models\EducationalDegree;
use App\Models\Enlightenment;
use App\Models\Faq;
use App\Models\HealthyEating;
use App\Models\InstituteCategory;
use App\Models\Laboratory;
use App\Models\LaboratoryCategory;
use App\Models\Language;
use App\Models\LanguageCourse;
use App\Models\LeaderShip;
use App\Models\News;
use App\Models\Page;
use App\Models\PageContent;
use App\Models\Position;
use App\Models\School;
use App\Models\SchoolCategory;
use App\Models\Service;
use App\Models\Setting;
use App\Models\Slider;
use App\Models\Structure;
use App\Models\StudyAbroad;
use App\Models\TariffCategory;
use App\Models\Teacher;
use App\Models\Training;
use App\Models\University;
use App\Models\Useful;
use App\Models\UsefulCategory;
use App\Models\UsefulLink;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $currentLang;

    public function __construct()
    {
        $this->currentLang = LaravelLocalization::getCurrentLocale();
        if (!in_array($this->currentLang,['az','en','ru'])){
            return self::notFound();
        }
    }

    public function index()
    {
        $currentLang = $this->currentLang;
        $slider = Slider::where('status',1)->orderBy('id','DESC')->first();
        $categories = Category::where(['status' => 1])->orderBy('id','DESC')->get();
        $studyAbroads = StudyAbroad::where(['status' => 1, 'is_main' => 1])->orderBy('id','DESC')->paginate(3);
        $languageCourses = LanguageCourse::where(['status' => 1, 'is_main' => 1])->orderBy('id','DESC')->paginate(3);
        $universities = University::whereNotNull('image')->where(['status' => 1])->orderBy('id','DESC')->get();
        $services = Service::where(['status' => 1])->orderBy('id','DESC')->get();
        return view('site.home',compact('currentLang','slider','categories','studyAbroads','languageCourses','universities','services'));
    }

    public function studyAbroad($country = null, $university = null)
    {
        $currentLang = $this->currentLang;
        if ($country != null && $university != null) {
            $country = Country::where(['slug->'.$currentLang => $country, 'status' => 1])->first();
            $university = University::where(['slug->'.$currentLang => $university, 'status' => 1])->first();
            $studyAbroads = StudyAbroad::where(['country_id' => $country->id, 'university_id' => $university->id, 'status' => 1])->orderBy('id','DESC')->get();
        }elseif ($country != null && $university == null) {
            $country = Country::where(['slug->'.$currentLang => $country, 'status' => 1])->first();
            $studyAbroads = StudyAbroad::where(['country_id' => $country->id, 'status' => 1])->orderBy('id','DESC')->get();
        }else {
            $studyAbroads = StudyAbroad::where(['status' => 1])->orderBy('id','DESC')->get();
        }
        return view('site.study-abroad',compact('currentLang','country','university','studyAbroads'));
    }

    public function degreeStudyAbroad($degree = null)
    {
        $currentLang = $this->currentLang;
        $degree = EducationalDegree::where(['slug->'.$currentLang => $degree, 'status' => 1])->first();
        $studyAbroads = StudyAbroad::where(['degree_id' => $degree->id, 'status' => 1])->orderBy('id','DESC')->get();
        return view('site.degree-study-abroad',compact('currentLang','degree','studyAbroads'));
    }

    public function studyAbroadDetails($country = null, $university = null, $slug)
    {
        $currentLang = $this->currentLang;
        if ($country != null && $university != null) {
        }

        $country = Country::where(['slug->'.$currentLang => $country, 'status' => 1])->first();
        $university = University::where(['slug->'.$currentLang => $university, 'status' => 1])->first();
        $studyAbroad = StudyAbroad::where(['country_id' => $country->id, 'university_id' => $university->id, 'slug->'.$currentLang =>$slug, 'status' => 1])->orderBy('id','DESC')->first();
        return view('site.study-abroad-details',compact('currentLang','country','university','studyAbroad'));
    }

    public function languageCourses($language = null, $leve = null)
    {
        $currentLang = $this->currentLang;
        if ($language != null && $leve != null) {
            $language = Language::whereNull('parent_id')->where(['slug->'.$currentLang => $language, 'status' => 1])->first();
            $leve = Language::whereNotNull('parent_id')->where(['parent_id'=> $language['id'], 'slug->'.$currentLang => $leve, 'status' => 1])->first();
            $languageCourse = LanguageCourse::where(['language_id' => $language->id, 'parent_language_id' => $leve->id, 'status' => 1])->orderBy('id','DESC')->get();
        }elseif ($language != null && $leve == null) {
            $language = Language::whereNull('parent_id')->where(['slug->'.$currentLang => $language, 'status' => 1])->first();
            $languageCourse = LanguageCourse::where(['language_id' => $language->id, 'status' => 1])->orderBy('id','DESC')->get();
        }else {
            $languageCourse = LanguageCourse::where(['status' => 1])->orderBy('id','DESC')->get();
        }
        return view('site.language-courses',compact('currentLang','language','languageCourse','leve'));
    }


    public function languageCoursesDetails($language = null, $leve = null, $slug)
    {
        $currentLang = $this->currentLang;
        if ($language == null && $leve == null) {
        }
        $language = Language::whereNull('parent_id')->where(['slug->'.$currentLang => $language, 'status' => 1])->first();
        $leve = Language::whereNotNull('parent_id')->where(['parent_id'=> $language['id'], 'slug->'.$currentLang => $leve, 'status' => 1])->first();
        $languageCourse = LanguageCourse::where(['language_id' => $language->id, 'parent_language_id' => $leve->id, 'status' => 1])->orderBy('id','DESC')->first();
        return view('site.language-courses-details',compact('currentLang','language','languageCourse','leve'));
    }

    public function signup()
    {
        return redirect(route('site.contact'));
        $currentLang = $this->currentLang;
        return view('site.signup',compact('currentLang'));
    }

    public function projectDetail($slug)
    {
        $currentLang = $this->currentLang;
        return view('site.project-detail',compact('currentLang'));
    }

    public function serviceDetail($slug)
    {
        $currentLang = $this->currentLang;
        return view('site.service-detail',compact('currentLang'));
    }

    public function blogs($category = null)
    {
        $currentLang = $this->currentLang;
        if ($category != null) {
            $category = Category::where(['slug->'.$currentLang => $category, 'status' => 1])->first();
            $blogs = News::where(['category_id'=>$category->id,'status' => 1])->orderBy('id','DESC')->get();
        }else{
            $blogs = News::where(['status' => 1])->orderBy('id','DESC')->get();
        }
        return view('site.blogs',compact('currentLang','category','blogs'));
    }


    public function blogDetail($category = null,$slug)
    {
        $currentLang = $this->currentLang;
        $category = Category::where(['slug->'.$currentLang => $category, 'status' => 1])->first();
        $blog = News::where(['category_id'=>$category->id,'slug->'.$currentLang => $slug,'status' => 1])->orderBy('id','DESC')->first();
        return view('site.blog-detail',compact('currentLang','category','blog'));
    }
    public function schools($schoolCategory = null)
    {
        $currentLang = $this->currentLang;
        if ($schoolCategory != null) {
            $schoolCategory = SchoolCategory::where(['slug->'.$currentLang => $schoolCategory, 'status' => 1])->first();
            $schools = School::with(['category', 'language', 'parentLanguage','teacher','country'])->where(['category_id'=>$schoolCategory->id,'status' => 1])->orderBy('id','DESC')->get();
        }else{
            $schools = School::with(['category', 'language', 'parentLanguage','teacher','country'])->where(['status' => 1])->orderBy('id','DESC')->get();
        }
        return view('site.schools',compact('currentLang','schoolCategory','schools'));
    }


    public function schoolDetails($schoolCategory = null,$slug)
    {
        $currentLang = $this->currentLang;
        $schoolCategory = SchoolCategory::where(['slug->'.$currentLang => $schoolCategory, 'status' => 1])->first();
        $school = School::with(['category', 'language', 'parentLanguage','teacher','country'])->where(['category_id'=>$schoolCategory->id,'slug->'.$currentLang => $slug,'status' => 1])->orderBy('id','DESC')->first();
        return view('site.school-detail',compact('currentLang','schoolCategory','school'));
    }


    public function contact() {
        $currentLang = $this->currentLang;
        $setting = Setting::first();
        return view('site.contact',compact('currentLang','setting'));
    }

    public function about () {
        $currentLang = $this->currentLang;
        $teachers = Teacher::where(['status' => 1])->orderBy('id','DESC')->get();
        return view('site.about ',compact('currentLang','teachers'));
    }
    public function faqs() {
        $currentLang = $this->currentLang;
        $faqs = Faq::orderBy('id','DESC')->get();
        return view('site.faqs',compact('currentLang','faqs'));
    }
    public function conditions() {
        $currentLang = $this->currentLang;
        return view('site.conditions',compact('currentLang'));
    }
    public function rules() {
        $currentLang = $this->currentLang;
        return view('site.rules',compact('currentLang'));
    }
    public function notPage()
    {
        $currentLang = $this->currentLang;
        return view('errors.404',compact('currentLang'));
    }

    public function notFound()
    {
        $currentLang = $this->currentLang;
        return view('site.not_found',compact('currentLang'));
    }
}
