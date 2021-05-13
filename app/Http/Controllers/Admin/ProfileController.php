<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\User;

class ProfileController extends Controller {

    public function edit(Request $request) {

        $user = \Auth::user();

        return view('admin.profile.edit', [
            'user' => $user,
        ]);
    }

    public function update(Request $request) {

        $user = \Auth::user();

        $formData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:255'],
            'photo' => ['nullable', 'file', 'image'],
        ]);

        $user->fill($formData);

        $user->save();

        $this->handlePhotoUpload($request, $user);

        session()->flash('system_message', __('Your profile has been updated!'));

        return redirect()->route('admin.profile.edit');
    }

    public function deletePhoto(Request $request) {

        $user = \Auth::user();

        $user->deletePhoto();

        //reset kolone photo1 ili photo2 na null
        //da izbrisemo podatak u bazi o povezanoj fotografiji
        $user->photo = null;
        $user->save();

        return response()->json([
                    'system_message' => __('Photo has been deleted'),
                    'photo_url' => $user->getPhotoUrl(),
        ]);
    }

    public function changePassword(Request $request) {

        return view('admin.profile.change_password');
    }

    public function changePasswordConfirm(Request $request) {

        $user = \Auth::user();

        $formData = $request->validate([
            'old_password' => [
                'required',
                function ($attribute, $value, $fail) use($user) { //koristi spoljnu varijablu $request u anonimnoj funkciji
                    if (!\Hash::check($value, $user->password)) {
                        $fail(__('Your old password is not correct'));
                    }
                },
            ],
            'new_password' => ['required', 'string', 'min:8'],
            'new_password_confirm' => ['required', 'same:new_password']
        ]);

        $user->password = \Hash::make($formData['new_password']);
        $user->save();

        session()->flash('system_message', __('Your password has been changed'));
        return redirect()->route('admin.profile.edit');
    }

    protected function handlePhotoUpload(Request $request, User $user) {
        if ($request->hasFile('photo')) {


            $user->deletePhoto();

            $photoFile = $request->file('photo');

            $newPhotoFileName = $user->id . '_' . $photoFile->getClientOriginalName();

            $photoFile->move(
                    public_path('/storage/users/'), $newPhotoFileName
            );

            $user->photo = $newPhotoFileName;

            $user->save();

            //originalna slika
            \Image::make(public_path('/storage/users/' . $user->photo))
                    ->fit(300, 300)
                    ->save();
        }
    }

}
