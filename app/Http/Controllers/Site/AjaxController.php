<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\CareerContact;
use App\Models\Contact;
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
                'phone' => $request->phone,
                'email' => $request->email,
                'note' => $request->message,
                'type' => 'contact'
            ];

            Notification::route('mail', 'topnotch2525@gmai.com')->notify(new Mail($mail_data));

            return response()->json([
                'success' => true,
                'message' => 'Müraciət uğurla göndərildi!',
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => null,
            ]);
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
