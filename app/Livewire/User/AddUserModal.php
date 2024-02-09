<?php

namespace App\Livewire\User;

use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use App\Helpers\ImageHelper;
use Cache;
use File;
use Illuminate\Support\Facades\Redis;

class AddUserModal extends Component
{

    use WithFileUploads;

    public $user_id;
    public $name;
    public $email;
    public $role;
    public $avatar;
    public $saved_avatar;
    public $username;
    public $password;
    public $password_confirmation;
    public $fname;
    public $lname;
    public $user_type;
    public $edit_mode = false;
    protected $rules = [
        // 'name' => 'required|string',
        'email' => 'required|email',
        'fname' => 'required|string',
        'lname' => 'required|string',
        'username' => 'required',
        // 'password' => 'required|password',
        // 'password_confirmation' => 'required|string',
        'avatar' => 'nullable|sometimes|image|max:1024',
        'password' => 'required|min:8|max:100|confirmed',
    ];

    protected $listeners = [
        'delete_user' => 'deleteUser',
        'update_user' => 'updateUser',
    ];
    public function render()
    {
        $roles = Role::all();

        $roles_description = [
            'administrator' => 'Best for business owners and company administrators',
            'developer' => 'Best for developers or people primarily using the API',
            'analyst' => 'Best for people who need full access to analytics data, but don\'t need to update business settings',
            'support' => 'Best for employees who regularly refund payments and respond to disputes',
            'trial' => 'Best for people who need to preview content data, but don\'t need to make any updates',
        ];

        foreach ($roles as $i => $role) {
            $roles[$i]->description = $roles_description[$role->name] ?? '';
        }

        return view('livewire.user.add-user-modal', compact('roles'));
    }

    public function submit()
    {
        // Validate the form input data
        $this->validate();
        DB::transaction(function () {
            // Prepare the data for creating a new user
            // $data = [
            //     'name' => $this->name,
            // ];
            $imgArray=[];

            if ($this->avatar) {
                $data['profile_photo_path'] = $this->avatar->store('avatars', 'public');
            } else {
                $data['profile_photo_path'] = null;
            }


            if (!$this->edit_mode) {
                $data['password'] = Hash::make($this->password);
            }

            if($this->fname || $this->lname){
                $data['name'] = $this->fname .' '.$this->fname;
            }
            if($this->user_type || $this->user_type){
                $data['user_type_id'] = $this->user_type ;
            }
                // $data['user_type_id'] = $this->user_type;
                $data['username'] = $this->username;
            // Update or Create a new user record in the database
            $data['email'] = $this->email;
            if(Redis::keys('Temp*')){  Redis::del(Redis::keys('Temp*')); }
            $user = User::find($this->user_id) ?? User::create($data);
            // $imgArray["imgId"] = $user->id;
            // $imgArray["fileName"] = $this->avatar;
            if ($this->edit_mode) {
                foreach ($data as $k => $v) {
                    $user->$k = $v;
                }
                $user->save();
            }
      
            // $user->profile_photo_path = ImageHelper::s3UploadImage($imgArray,"User",$this->avatar);
            // $user->save();
            if ($this->edit_mode) {
                // Assign selected role for user
                $user->syncRoles($this->role);

                // Emit a success event with a message
                $this->dispatch('success', __('User updated'));
            } else {
                // Assign selected role for user
                $user->assignRole($this->role);

                // Send a password reset link to the user's email

                // temporary remove 
                // Password::sendResetLink($user->only('email'));

                // Emit a success event with a message
                $this->dispatch('success', __('New user created'));
            }
        });

        // Reset the form fields after successful submission
        $this->reset();
    }
    public function updateAvatar($imgArray,)
    {
        if (!empty($inputs['profile_photo_path'])) {
            //unlink old file
            // if (!empty($user->profile_photo_path)) {
            //     File::Delete(public_path() . ImageHelper::getUserUploadFolder($user->id) . $user->avatar);
            // }
            $user->profile_photo_path = ImageHelper::s3UploadImage("user", $imgArray);
            // $user->save();
        } 
        // else if ($inputs['remove'] == 'remove') {
        //     $user->profile_photo_path = '';
        //     $user->save();
        // } 
        else {
            $user->save();
        }
    }
    public function deleteUser($id)
    {
        if(Redis::keys('Temp*')){  Redis::del(Redis::keys('Temp*')); }
        // Prevent deletion of current user
        if ($id == Auth::id()) {
            $this->dispatch('error', 'User cannot be deleted');
            return;
        }

        // Delete the user record with the specified ID
        User::destroy($id);

        // Emit a success event with a message
        $this->dispatch('success', 'User successfully deleted');
    }

    public function updateUser($id)
    {

        $this->edit_mode = true;

        $user = User::find($id);

        $this->user_id = $user->id;
        $this->saved_avatar = $user->profile_photo_url;
        $this->fname = explode(" ", $user->name)[0];
        $this->lname = explode(" ", $user->name)[1];
        $this->email = $user->email;
        $this->role = $user->roles?->first()->name ?? '';
        $this->username = $user->username;
    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }
}
