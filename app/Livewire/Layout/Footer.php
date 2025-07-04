<?php

namespace App\Livewire\Layout;

use App\Models\Contact;
use App\Models\Setting;
use Illuminate\Support\Facades\Request;
use Livewire\Component;

class Footer extends Component
{
    public $email_subscribe;
    public $successMessage;

    protected $rules = [
        'email_subscribe' => 'required|email|unique:contacts,email',
    ];

    protected $messages = [
        'email_subscribe.required' => 'Vui lòng nhập địa chỉ email.',
        'email_subscribe.email' => 'Địa chỉ email không hợp lệ.',
        'email_subscribe.unique' => 'Địa chỉ email này đã được đăng ký.',
    ];

    public function subscribe()
    {
        $this->validate();

        Contact::create([
            'name' => 'Subscriber',
            'email' => $this->email_subscribe,
            'phone' => null,
            'message' => 'Đăng ký nhận tin',
            'ip_address' => Request::ip(),
        ]);

        $this->reset('email_subscribe');
        $this->successMessage = 'Đăng ký nhận tin thành công!';
    }

    public function render()
    {
        $logo = Setting::with('translations')->where('key', 'logo')->first();
        $copyright = Setting::with('translations')->where('key', 'copyright')->first();
        $phone = Setting::with('translations')->where('key', 'phone')->first();
        $address = Setting::with('translations')->where('key', 'address')->first();
        $email = Setting::with('translations')->where('key', 'email')->first();
        $facebook = Setting::with('translations')->where('key', 'facebook')->first();
        $youtube = Setting::with('translations')->where('key', 'youtube')->first();
        
        return view('livewire.layout.footer', compact('logo', 'copyright', 'phone', 'address', 'email', 'facebook', 'youtube'));
    }
} 