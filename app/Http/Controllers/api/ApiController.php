<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use App\Models\BirthRegistration;
use App\Models\Complaint;
use App\Models\ContactPsychlogist;
use App\Models\DeathRegistration;
use App\Models\Feedback;
use App\Models\Feverclinic;
use App\Models\Food;
use App\Models\IsolationSuidelines;
use App\Models\MayorExpress;
use App\Models\MultiLevelParking;
use App\Models\MyCityMyWall;
use App\Models\Otp;
use App\Models\OutdoorMediaManagement;
use App\Models\PostcovidDiet;
use App\Models\PublicBikeSharing;
use App\Models\ServiceModel;
use App\Models\SmartQrScanner;
use App\Models\TeleConsultationModel;
use App\Models\User;
use App\Models\VacinationCenter;
use App\Models\VoteForYourCity;
use App\Models\YogaGuideModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Session\Session as SessionSession;

use function PHPSTORM_META\type;

class ApiController extends Controller
{
    public function registration(Request $request)
    {
        request()->validate([


            'mobile' => 'required | numeric | digits:10 | starts_with: 6,7,8,9'

        ], [

            'mobile.required' => 'mobile is required',

            'mobile.digits' => 'Mobile must be at least 10 characters.',

            'mobile.starts_with' => 'Mobile should not be started 6,7,8,9',

        ]);

        $checkdata = User::where('mobile', $request->mobile)->first();

        if (empty($checkdata)) {

            $registration = new User();
            $registration->mobile = $request->mobile;
            $registration->type = 'user';
            $registration->save();

            $optdefault = new Otp();
            $optdefault->user_id = $registration->id;
            $optdefault->status = 'n';
            $optdefault->otp = '1234';
            $optdefault->save();

            return response()->json([
                'result' => true,
                'message' => ('Fill Profile Information.'),
                'data' => [
                    'user_id' => $registration->id,
                    '_token' => $registration->createToken('tokens')->plainTextToken,
                    'mobile' => $registration->mobile
                ]
            ], 201);
        } else {
            return response()->json([
                'message' => ('This Number is alredy Registed.')
            ]);
        }
    }
    public function Login(Request $request)
    {
        // if user is logged in
        if (Auth::user() != null) {
            return response()->json([
                'result' => true,
                'message' => 'User is logged in',
                'data' => []
            ]);
        }
        // Validate Request
        request()->validate([
            'mobile' => 'required | numeric | digits:10 | starts_with: 6,7,8,9',
            // 'otp' => 'required | numeric | digits:4'

        ], [

            'mobile.required' => 'mobile is required',

            'mobile.digits' => 'Mobile must be at least 10 characters.',

            // 'mobile.starts_with' => 'Mobile should not be started 6,7,8,9',

        ]);

        // Check if user is present
        $user = User::where([['mobile', $request->mobile], ['type', 'user']])->first();
        if (empty($user)) {
            return response()->json([
                'result' => false,
                'message' => 'Profile Not Found',
                'data' => []
            ]);
        }

        Auth::login($user,  $remember = true);

        return response()->json([
            'result' => true,
            'message' => 'Login Successfull',
            'data' => [
                "user_id" => $user->id,
                "otp" => null,
                "mobile" => $user->mobile,
                "_token" => $user->createToken('tokens')->plainTextToken
            ]
        ]);
    }

    public function signOut()
    {
        Session::flush();
        Auth::logout();
        return response()->json([
            'message' => ('logout.')
        ]);
    }
    public function otpverify(Request $request)
    {

        $otp = Otp::where([['user_id', $request->id], ['otp', $request->otp], ['status', 'n']])->first();
   
        if (empty($otp)) {
            return response()->json([
                'error' => ('OTP is not match.')
            ]);
        }

        if (Auth::loginUsingId(1)) {
            $otp->status = "y";
            $otp->save();

            $token = $user->createToken('auth_token')->plainTextToken;
            return response()->json([
                'result' => true,
                'message' => 'Login Successfull',
                'data' => [
                    'user_id' => $user->id,
                    'otp' => null,
                    'mobile' => $user
                ]
            ]);
        } else {
            return response()->json([
                'message' => ('Login details are not valid.')
            ]);
        }
        // 60 sec otp in valid
        $user = User::where('mobile', $request->mobile)->first();

        if ($user == null) {

            return response()->json([
                'result' => false,
                'message' => 'Number is not match. Please try again',
                'data' => []
            ]);
        } else {

            $otp = Otp::where([['status', 'n'], ['user_id', $user->id]])->whereDate('created_at', Carbon::today())->get();
            if ($otp) {
                foreach ($otp as $data) {
                    $emitted = Carbon::parse($data->created_at);
                    $diff = Carbon::now()->diffInSeconds($emitted);


                    if ($diff < 60) {

                        return response()->json([
                            'result' => true,
                            'message' => 'otp Fatch successful',
                            'data' => [
                                'user_id' => $user->id,
                                'otp' => $data->otp,
                                'mobile' => $user->mobile
                            ]
                        ]);
                    } else {

                        return response()->json([
                            'result' => true,
                            'message' => 'otp expire. please try again',
                            'data' => []
                        ]);
                    }
                }
            } else {

                return response()->json([
                    'result' => true,
                    'message' => 'otp expire. please try again',
                    'data' => []
                ]);
            }
        }
        return response()->json([
            'result' => true,
            'message' => 'otp expire. please try again',
            'data' => []
        ]);
    }

    public function editProfile(Request $request)
    {
        // Id, Name, Email ,Address  ,Date of Birth
        request()->validate([
            'id' => 'required | numeric',
            'name' => 'required',
            'email' => 'required',
            'address' => 'required',
            'dob' => 'required'
        ], [

            'id.required' => 'id is required',
            'name.required' => 'Name is required',
            'email.required' => 'Email is required',
            'address.required' => 'Address is required',
            'dob.required' => 'Dob is required',
        ]);
        $user = User::where('id', $request->id)->update(['name' => $request->name, 'email' => $request->email, 'address' => $request->address, 'dob' => date("Y-m-d", strtotime($request->dob))]);
        if ($user == 1) {
            $user = User::where('id', $request->id)->first();
            return response()->json([
                'result' => true,
                'message' => 'Profile Updated Successfully',
                'data' => [
                    "user_id" => $user->id,
                    "name" => $user->name,
                    "email" => $user->email,
                    "address" => $user->address,
                    "dob" => date("d-m-Y", strtotime($user->dob)),
                ]
            ]);
        } else {
            return response()->json([
                'result' => false,
                'message' => 'Profile was not updated. Please try again',
                'data' => []
            ]);
        }
    }
    public function addprofile(Request $request)
    {
        // Id, Name, Email ,Address  ,Date of Birth
        request()->validate([
            'id' => 'required | numeric',
            'name' => 'required',
            'email' => 'required',
            'address' => 'required',
            'dob' => 'required'
        ], [

            'id.required' => 'id is required',
            'name.required' => 'Name is required',
            'email.required' => 'Email is required',
            'address.required' => 'Address is required',
            'dob.required' => 'Dob is required',
        ]);
        $user = User::where('id', $request->id)->update(['name' => $request->name, 'email' => $request->email, 'address' => $request->address, 'dob' => date("Y-m-d", strtotime($request->dob))]);
        if ($user == 1) {
            $user = User::where('id', $request->id)->first();
            return response()->json([
                'result' => true,
                'message' => 'Profile Updated Successfully',
                'data' => [
                    "user_id" => $user->id,
                    "name" => $user->name,
                    "email" => $user->email,
                    "address" => $user->address,
                    "dob" => date("d-m-Y", strtotime($user->dob)),
                ]
            ]);
        } else {
            return response()->json([
                'result' => false,
                'message' => 'Profile was not updated. Please try again',
                'data' => []
            ]);
        }
    }

    public function showProfile(Request $request)
    {
        if (empty($request->id)) {
            return response()->json([
                'result' => false,
                'message' => 'Id not found',
                'data' => []
            ]);
        }

        $user = User::where('id', $request->id)->first();
        if ($user == null) {
            return response()->json([
                'result' => false,
                'message' => 'User not found',
                'data' => []
            ]);
        }
        return response()->json([
            'result' => true,
            'message' => 'Profile Updated Successfully',
            'data' => [
                "user_id" => $user->id,
                "name" => $user->name,
                "email" => $user->email,
                "address" => $user->address,
                "dob" => date("d-m-Y", strtotime($user->dob)),
            ]
        ]);
    }


    public function aboutus()
    {
        $about = AboutUs::where('status', 1)->get();
        return response()->json([
            'data' => $about,
        ]);
    }
    public function service()
    {

        $service = ServiceModel::where('status', 1)->get();
        return response()->json([
            'data' => $service,
        ]);
    }
    public function complaint(Request $request)
    {
        request()->validate([


            'image' => 'required',
            'user_message' => 'required'

        ], [

            'image.required' => 'Please Upload complaint Image.',
            'user_message.required' => 'Please fill this field.'

        ]);
        $complaint = new Complaint();
        if ($request->file('image')) {
            $imagefilename = time() . '.' . request()->image->getClientOriginalExtension();
            request()->image->move(public_path('backend/complaint/image'), $imagefilename);
            $complaint->image = $imagefilename;
        }
        if ($request->file('video')) {
            $videofilename = time() . '.' . request()->video->getClientOriginalExtension();
            request()->video->move(public_path('backend/complaint/video'), $videofilename);
            $complaint->video = $videofilename;
        }
        $complaint->user_id = auth()->user()->id;
        $complaint->user_message = $request->user_message;
        $complaint->status = 0;
        $datasave = $complaint->save();

        if ($datasave) {
            return response()->json([
                'Message' => 'Complaint sent successfully. please wait for reply.',
            ]);
        } else {
            return response()->json([
                'Message' => 'something wrong please fill again',
            ]);
        }
    }
    public function allcomplaint()
    {
        $user_id = auth()->user()->id;
        $replycom = Complaint::where('user_id', $user_id)->get();

        if ($replycom) {
            return response()->json([
                'data' => $replycom,
            ]);
        } else {
            return response()->json([
                'Message' => 'something wrong.',
            ]);
        }
    }
    public function onecomplaint($id)
    {
        $user_id = auth()->user()->id;
        $replycom = Complaint::where([['id', $id], ['user_id', $user_id]])->first();

        if ($replycom) {
            return response()->json([
                'data' => $replycom,
            ]);
        } else {
            return response()->json([
                'Message' => 'something wrong.',
            ]);
        }
    }
    public function feedback(Request $request)
    {
        $user_id = auth()->user()->id;
        $feedback = Feedback::where('user_id', $user_id)->get();
        if ($feedback) {
            return response()->json([
                'data' => $feedback,
            ]);
        } else {
            return response()->json([
                'Message' => 'Not Found.',
            ]);
        }
    }
    public function feedbackcreate(Request $request)
    {
        request()->validate([
            'feedback' => 'required',
            'star' => 'required'

        ], [

            'star.required' => 'please give a reading.',
            'feedback.required' => 'Please fill this field.'

        ]);
        $feedback = new Feedback();
        $feedback->user_id = auth()->user()->id;
        $feedback->star = $request->star;
        $feedback->feedback = $request->feedback;
        $feedback->status = 0;
        $datasave = $feedback->save();

        if ($datasave) {
            return response()->json([
                'Message' => 'Complaint sent successfully. please wait for reply.',
            ]);
        } else {
            return response()->json([
                'Message' => 'something wrong please fill again',
            ]);
        }
    }
    public function updatefeedback(Request $request)
    {
        request()->validate([
            'feedback' => 'required',
            'star' => 'required'

        ], [

            'star.required' => 'please give a reading.',
            'feedback.required' => 'Please fill this field.'

        ]);
        if ($request->id) {

            $feedback = Feedback::where('id', $request->id)->first();
            $feedback->user_id = auth()->user()->id;
            $feedback->star = $request->star;
            $feedback->feedback = $request->feedback;
            $feedback->status = $request->status;
            $feedback->update_at = date('Y-m-d H:i:s');
            $datasave = $feedback->save();

            if ($datasave) {
                return response()->json([
                    'Message' => 'Complaint sent successfully. please wait for reply.',
                ]);
            } else {
                return response()->json([
                    'Message' => 'something wrong please fill again',
                ]);
            }
        }
        return response()->json([
            'Message' => 'feedback id not found.',
        ]);
    }
    public function yogaguide()
    {

        $yoga = YogaGuideModel::get();
        if ($yoga) {
            return response()->json([
                'data' => $yoga,
            ]);
        } else {
            return response()->json([
                'Message' => 'Not Found.',
            ]);
        }
    }
    public function teleconsultation()
    {

        $tele = TeleConsultationModel::where('status', 1)->get();
        if ($tele) {
            return response()->json([
                'data' => $tele,
            ]);
        } else {
            return response()->json([
                'Message' => 'Not Found.',
            ]);
        }
    }
    public function contactpsychlogist()
    {

        $ctp = ContactPsychlogist::where('status', 1)->get();
        if ($ctp) {
            return response()->json([
                'data' => $ctp,
            ]);
        } else {
            return response()->json([
                'Message' => 'Not Found.',
            ]);
        }
    }
    public function isolationsuidelines()
    {

        $data = IsolationSuidelines::where('status', 1)->get();
        if ($data) {
            return response()->json([
                'data' => $data,
            ]);
        } else {
            return response()->json([
                'Message' => 'Not Found.',
            ]);
        }
    }
    public function vacinationcenter()
    {

        $data = VacinationCenter::where('status', 1)->get();
        if ($data) {
            return response()->json([
                'data' => $data,
            ]);
        } else {
            return response()->json([
                'Message' => 'Not Found.',
            ]);
        }
    }
    public function feverclinic()
    {

        $data = Feverclinic::where('status', 1)->get();
        if ($data) {
            return response()->json([
                'data' => $data,
            ]);
        } else {
            return response()->json([
                'Message' => 'Not Found.',
            ]);
        }
    }
    public function food()
    {

        $data = Food::where('status', 1)->get();
        if ($data) {
            return response()->json([
                'data' => $data,
            ]);
        } else {
            return response()->json([
                'Message' => 'Not Found.',
            ]);
        }
    }
    public function mayorexpress()
    {

        $data = MayorExpress::where('status', 1)->get();
        if ($data) {
            return response()->json([
                'data' => $data,
            ]);
        } else {
            return response()->json([
                'Message' => 'Not Found.',
            ]);
        }
    }
    public function postcoviddiet()
    {

        $data = PostcovidDiet::where('status', 1)->get();
        if ($data) {
            return response()->json([
                'data' => $data,
            ]);
        } else {
            return response()->json([
                'Message' => 'Not Found.',
            ]);
        }
    }
    public function publicbikesharing()
    {

        $data = PublicBikeSharing::where('status', 1)->get();
        if ($data) {
            return response()->json([
                'data' => $data,
            ]);
        } else {
            return response()->json([
                'Message' => 'Not Found.',
            ]);
        }
    }
    public function birthregistration()
    {

        $data = BirthRegistration::where('status', 1)->get();
        if ($data) {
            return response()->json([
                'data' => $data,
            ]);
        } else {
            return response()->json([
                'Message' => 'Not Found.',
            ]);
        }
    }
    public function deathregistration()
    {

        $data = DeathRegistration::where('status', 1)->get();
        if ($data) {
            return response()->json([
                'data' => $data,
            ]);
        } else {
            return response()->json([
                'Message' => 'Not Found.',
            ]);
        }
    }
    public function voteforyourcity()
    {

        $data = VoteForYourCity::where('status', 1)->get();
        if ($data) {
            return response()->json([
                'data' => $data,
            ]);
        } else {
            return response()->json([
                'Message' => 'Not Found.',
            ]);
        }
    }
    public function multilevelparking()
    {

        $data = MultiLevelParking::where('status', 1)->get();
        if ($data) {
            return response()->json([
                'data' => $data,
            ]);
        } else {
            return response()->json([
                'Message' => 'Not Found.',
            ]);
        }
    }
    public function mycitymywall()
    {

        $data = MyCityMyWall::where('status', 1)->get();
        if ($data) {
            return response()->json([
                'data' => $data,
            ]);
        } else {
            return response()->json([
                'Message' => 'Not Found.',
            ]);
        }
    }
    public function smartqrscanner()
    {

        $data = SmartQrScanner::where('status', 1)->get();
        if ($data) {
            return response()->json([
                'data' => $data,
            ]);
        } else {
            return response()->json([
                'Message' => 'Not Found.',
            ]);
        }
    }
    public function outdoormediamanagement()
    {

        $data = OutdoorMediaManagement::where('status', 1)->get();
        if ($data) {
            return response()->json([
                'data' => $data,
            ]);
        } else {
            return response()->json([
                'Message' => 'Not Found.',
            ]);
        }
    }
}
