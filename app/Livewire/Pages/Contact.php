<?php

namespace App\Livewire\Pages;

use App\Models\Contact as ModelsContact;
use Livewire\Component;
use Illuminate\Support\Facades\Request;
use App\Models\Setting;

class Contact extends Component
{
    public $name;
    public $email;
    public $phone;
    public $message;
    public $successMessage;

    protected $rules = [
        'name' => 'required',
        'email' => 'required|email',
        'phone' => 'required',
        'message' => 'required|min:5',
    ];

    public function submit()
    {
        $this->validate();

        ModelsContact::create([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'message' => $this->message,
            'ip_address' => Request::ip(),
        ]);

        $this->reset(['name', 'email', 'phone', 'message']);

        $this->successMessage = trans('contact.form_success');
    }

    public function mount()
    {
        \App::setLocale(session('locale', config('app.locale')));

    }
    public function render()
    {
        $addressSetting = Setting::with('translations')->where('key', 'address')->first();
        $phoneSetting = Setting::with('translations')->where('key', 'phone')->first();
        $emailSetting = Setting::with('translations')->where('key', 'email')->first();

        return view('livewire.pages.contact', [
            'addressSetting' => $addressSetting,
            'phoneSetting' => $phoneSetting,
            'emailSetting' => $emailSetting,
        ])->layout('layouts.app');
    }
} 