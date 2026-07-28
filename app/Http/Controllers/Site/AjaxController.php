<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\CareerContact;
use App\Models\Contact;
use App\Models\StudyAbroad;
use App\Models\Service;
use App\Models\ServiceContact;
use App\Models\Setting;
use App\Notifications\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class AjaxController extends Controller
{
    protected $currentLang;
    protected $setting;

    public function __construct()
    {
        $this->currentLang = LaravelLocalization::getCurrentLocale();
        if (!in_array($this->currentLang,['az','en','ru'])){
            return self::notFound();
        }
        $this->setting = Setting::first();
    }

    public function notFound()
    {
        $currentLang = $this->currentLang;
        return view('site.not_found',compact('currentLang'));
    }

    public function sendContact(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'surname' => 'nullable|string|max:255',
                'phone' => 'required|string|max:20|regex:/^\+994[0-9]{9}$/',
                'email' => 'required|email',
                'message' => 'required',
            ], [
                'name.required' => Lang::get('site.name_required'),
                'phone.required' => Lang::get('site.number_required'),
                'phone.regex' => Lang::get('site.number_regex'),
                'email.required' => Lang::get('site.email_required'),
                'message.required' => Lang::get('site.message_required'),
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 422,
                    'success' => false,
                    'message' => $validator->errors()->first(),
                ]);
            }

            /*$captcha = self::verifyCaptcha($request->captcha);
            if (!$captcha)
            {
                return response()->json([
                    'success' => false,
                    'message' => 'Qeyd etdiyiniz simvolar doğru deyildir.',
                ]);
            }*/

            /*Contact::create([
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
                'message' => $request->message,
            ]);;*/

            $mail_data = [
                'name' => $request->name,
                'surname' => $request->surname,
                'phone' => $request->phone,
                'email' => $request->email,
                'note' => $request->message,
                'type' => 'contact'
            ];

            Notification::route('mail', 'topnotchaz2025@gmail.com')->notify(new Mail($mail_data));

            return response()->json([
                'success' => true,
                'message' => Lang::get('site.contact_request_success'),
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function sendStudyAbroadContact(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'study_abroad_id' => 'required|integer|exists:study_abroads,id',
                'name' => 'required|string|max:255',
                'surname' => 'required|string|max:255',
                'phone' => 'required|string|max:20|regex:/^\+994[0-9]{9}$/',
                'email' => 'required|email',
                'note' => 'nullable|string|max:5000',
            ], [
                'study_abroad_id.required' => Lang::get('site.message_required'),
                'study_abroad_id.exists' => Lang::get('site.message_required'),
                'name.required' => Lang::get('site.name_required'),
                'surname.required' => Lang::get('site.surname_required'),
                'phone.required' => Lang::get('site.number_required'),
                'phone.regex' => Lang::get('site.number_regex'),
                'email.required' => Lang::get('site.email_required'),
                'note.max' => Lang::get('site.message_required'),
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validator->errors()->first(),
                    'errors' => $validator->errors(),
                ], 422);
            }

            $studyAbroad = StudyAbroad::with(['country', 'university', 'degree'])
                ->where('status', 1)
                ->findOrFail($request->study_abroad_id);

            $title = data_get($studyAbroad, "name.{$this->currentLang}") ?? data_get($studyAbroad, 'name.az');
            $country = data_get($studyAbroad, "country.name.{$this->currentLang}") ?? data_get($studyAbroad, 'country.name.az');
            $university = data_get($studyAbroad, "university.name.{$this->currentLang}") ?? data_get($studyAbroad, 'university.name.az');
            $degree = data_get($studyAbroad, "degree.name.{$this->currentLang}") ?? data_get($studyAbroad, 'degree.name.az');
            $url = url()->previous();

            $noteParts = [];
            $noteParts[] = 'Study abroad: ' . $title;
            if ($country) {
                $noteParts[] = 'Country: ' . $country;
            }
            if ($university) {
                $noteParts[] = 'University: ' . $university;
            }
            if ($degree) {
                $noteParts[] = 'Degree: ' . $degree;
            }
            if (!empty($request->note)) {
                $noteParts[] = 'User note: ' . $request->note;
            }

            Contact::create([
                'name' => $request->name,
                'surname' => $request->surname,
                'phone' => $request->phone,
                'email' => $request->email,
                'note' => implode("\n", $noteParts) . "\nURL: " . $url,
                'datetime' => Carbon::now(),
                'is_deleted' => 0,
            ]);

            $mailData = [
                'name' => trim($request->surname . ' ' . $request->name),
                'surname' => $request->surname,
                'phone' => $request->phone,
                'email' => $request->email,
                'note' => implode("\n", $noteParts),
                'type' => 'study_abroad',
                'study_title' => $title,
                'study_country' => $country,
                'study_university' => $university,
                'study_degree' => $degree,
                'study_url' => $url,
            ];

            Notification::route('mail', 'topnotchaz2025@gmail.com')->notify(new Mail($mailData));

            return response()->json([
                'success' => true,
                'message' => Lang::get('site.study_abroad_request_success'),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public static function verifyCaptcha($captcha)
    {
        // Session'daki doğru CAPTCHA kodu
        $storedCaptcha = Session::get('captcha');
        if (!empty($captcha) && $captcha === $storedCaptcha) {
            Session::remove('captcha');
            return true;
        } else {
            return false;
        }
    }
}
