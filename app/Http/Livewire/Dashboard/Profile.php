<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\File;

class Profile extends Component
{
    use WithFileUploads;

    public $name;
    public $email;
    public $telepon;
    public $photo;

    public $auth;
    public $user;

    protected $rules = [
        'name' => 'required',
        'email' => 'required|email',
        'telepon' => 'required|numeric',
    ];

    protected $listeners = [
        'single_file_uploaded' => 'SingleFileUpload'
    ];

    public function mount()
    {
        $this->auth = Auth::user();
        $this->user = User::where('email', $this->auth->email)->firstOrFail();
        $this->name = $this->user->name;
        $this->email = $this->user->email;
        $this->telepon = $this->user->telp;

        if(str_contains($this->user->profile_photo_path, 'storage')) {
            $this->photo = asset($this->user->profile_photo_path);
        } else {
            $this->photo = $this->user->profile_photo_path;
        }
    }

    public function SingleFileUpload($file)
    {
        $this->emit('alert_remove');
        try {
            if($this->getFileInfo($file)["file_type"] == "image") {
                $newFile = $this->storeImage($file);

                // Update image url
                $user = $this->user;
                $user->update([ 'profile_photo_path' => $newFile ]);
                $user->save();

                $this->photo = asset($newFile);
            } else {
                session()->flash('error', "Hanya dapat mengupload file gambar");
            }
        } catch (\Exception $ex){
            session()->flash('error', $ex);
        }
    }

    public function getFileInfo($file) {
        $info = [
            "decoded_file" => NULL,
            "file_meta" => NULL,
            "file_mime_type" => NULL,
            "file_type" => NULL,
            "file_extension" => NULL,
        ];
        try{
            $info['decoded_file'] = base64_decode(substr($file, strpos($file, ',') + 1));
            $info['file_meta'] = explode(';', $file)[0];
            $info['file_mime_type'] = explode(':', $info['file_meta'])[1];
            $info['file_type'] = explode('/', $info['file_mime_type'])[0];
            $info['file_extension'] = explode('/', $info['file_mime_type'])[1];
        }catch(\Exception $ex){
            session()->flash('error', $ex);
        }

        return $info;
    }

    public function getFileExt($file) {
        return explode('/', explode(':', substr($file, 0, strpos($file, ';')))[1])[1];
    }

    /**
     * Store the image to Storage folder
     *
     * @param $file
     * @return string
     */
    public function storeImage($file): string
    {
        $extension = $this->getFileExt($file);
        $replace = substr($file, 0, strpos($file, ',')+1);
        $image = str_replace($replace, '', $file);
        $image = str_replace(' ', '+', $image);

        //$imageName = strtolower(str_replace(' ', '_', $this->name) . '_' . $this->email);
        $fileName = Str::random(10) . '.' . $extension;
        Storage::disk('public')->put('avatar/' . $fileName, base64_decode($image));

        // Delete the old file
        $remove = str_replace('storage/', '', $this->user->profile_photo_path);
        if($remove == 'avatar.png') return 'storage/avatar/' . $fileName;

        File::delete(public_path('storage/' . $remove));
        return 'storage/avatar/' . $fileName;
    }

    public function EditProfile()
    {
        $this->validate();
        $this->emit('alert_remove');

        if(isset($this->user))
        {
            $user = $this->user;

            if($user->email == $this->email)
            {
                $user->update([
                    'name' => $this->name,
                    'telp' => $this->telepon
                ]);

                $user->save();
            }
            else
            {
                $user->forceFill([
                    'name' => $this->name,
                    'telp' => $this->telepon,
                    'email' => $this->email,
                    'email_verified_at' => NULL
                ]);
                $user->save();
                return redirect()->route('verification.notice');
            }
            session()->flash('success', 'Berhasil ubah Data');
            return redirect()->route('user.home', 'profile');
        }
        else
        {
            session()->flash('error', 'Gagal mengubah data');
        }
    }

    public function render()
    {
        return view('livewire.dashboard.profile');
    }
}
