<?php

namespace App\Http\Livewire\Auth;

use App\Models\Item;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;

class EditProduct extends Component
{
    public $thumbnail;
    public $title;
    public $description;
    public $price;
    public $stok;

    public $item;

    protected $listeners = [
        'thumbnail_uploaded' => 'uploadThumbnail'
    ];

    protected $rules = [
        'title' => 'required',
        'price' => 'required|numeric',
        'stok' => 'required|numeric',
        'description' => 'required'
    ];

    public function mount($id)
    {
        $user = Auth::user();
        if(!$user->isAdmin) return redirect()->route('home');

        $product = Item::where('id', $id)->firstOrFail();
        $this->item = $product;

        if(str_contains($product->thumbnail, 'storage')) {
            $this->thumbnail = asset($product->thumbnail);
        }
        else
        {
            $this->thumbnail = $product->thumbnail;
        }

        $this->title = $product->name;
        $this->description = $product->description;
        $this->price = $product->price;
        $this->stok = $product->stok;
    }

    public function uploadThumbnail($file)
    {
        $this->emit('alert_remove');

        try {
            if($this->getFileInfo($file)["file_type"] == "image") {
                $newFile = $this->storeImage($file);

                // Update image url
                $item = $this->item;
                $item->update([ 'thumbnail' => $newFile ]);
                $item->save();

                $this->thumbnail = asset($newFile);
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

    public function storeImage($file): string
    {
        $extension = $this->getFileExt($file);
        $replace = substr($file, 0, strpos($file, ',')+1);
        $image = str_replace($replace, '', $file);
        $image = str_replace(' ', '+', $image);

        //$imageName = strtolower(str_replace(' ', '_', $this->name) . '_' . $this->email);
        $fileName = Str::random(10) . '.' . $extension;
        Storage::disk('public')->put($fileName, base64_decode($image));

        // Delete the old file
        $remove = str_replace('storage/', '', $this->thumbnail);
        File::delete(public_path('storage/' . $remove));

        return 'storage/' . $fileName;
    }

    public function updateProduct()
    {
        $this->validate();
        if(is_null($this->thumbnail)) return session()->flash('error', 'Harus mengupload foto produk');

        $product = Item::where('id', $this->item->id)->firstOrFail();
        $product->name = $this->title;
        $product->slug = Str::slug($this->title);
        $product->description = $this->description;
        $product->price = $this->price;
        $product->stok = $this->stok;
        $product->save();
        session()->flash('success', 'Produk berhasil di update');
        return redirect()->route('user.home', 'product');
    }

    public function render()
    {
        return view('livewire.auth.edit-product')->layout('components.layout', [
            'divCSS' => 'flex justify-center content-center items-center',
            'mainCSS' => 'min-h-screen container mx-auto py-28'
        ]);
    }
}
