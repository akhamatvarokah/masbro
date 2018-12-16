<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\Province;
use App\Models\Regency;
use App\Models\District;
use App\Models\EducationUser;
use App\Models\Experience;
use Illuminate\Support\Facades\File;
use App\Models\UserDocument;
use Session;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
	/*
	|--------------------------------------------------------------------------
	| Register Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles the registration of new users as well as their
	| validation and creation. By default this controller uses a trait to
	| provide this functionality without requiring any additional code.
	|
	*/

	protected function profile()
	{
		$user = Auth::user();
		$education = EducationUser::where('user_id', $user->id)->get();
		$experiences = Experience::where('user_id', $user->id)->get();
		$userDocuments = UserDocument::where('user_id', $user->id)->get();
		$month = ['', 'January', 'February', 'Maret', 'April', 'Mei', 'Juni', 'July', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
		return view('user/profile')
		->with('user', $user )
		->with('educations', $education )
		->with('userDocuments', $userDocuments )
		->with('month', $month )
		->with('menu', 'profile')
		->with('experiences', $experiences );
	}

	public function profile_edit()
	{
		$user = Auth::user();
		$province = Province::get();
		$regency = Regency::where('province_id', $user->province_id)->get();
		$district = District::where('regency_id', $user->regency_id)->get();		
		return view('user/edit_profile')
			->with('user', $user)
			->with('provinces', $province)
			->with('regencys', $regency)
			->with('menu', 'profile')
			->with('districts', $district);
	}

	public function save_edit(Request $request)
	{
		$user = Auth::user();
		$user->first_name = $request->first_name;
		$user->last_name = $request->last_name;
		$user->user_id = $request->user_id;
		$user->profession = $request->profession;
		$user->bio = $request->bio;
		$user->province_id = $request->province_id;
		$user->phone = $request->phone;
		$user->regency_id = $request->regency_id;
		$user->district_id = $request->district_id;
		$user->addreess = $request->addreess;
		$user->longitude = $request->long;
		$user->latitude = $request->lat;
		$user->save();

		if ($request->hasFile('profile_image'))
        {
            $image_name = time()."-".str_replace(" ", "", $request->file('profile_image')->getClientOriginalName());
            $request->profile_image->move(public_path('/images/profile-picture-user'), $image_name);
            $user->profile_image = $image_name;
            $user->save();
        }

        Session::flash('message-succes', 'Succes Save Data'); 
        return redirect('profile/user/edit');
	}

	public function set_new_password()
	{
		return view('user/set_new_password');		
	}

	public function save_new_password(Request $request)
	{
		$user = Auth::user();
		$user->password = $request->password;
		$user->save();
		return redirect('home');
	}
}