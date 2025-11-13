<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FormController extends Controller
{
    public function showForm()
    {
        return view('pages.form');
    }

    public function submitForm(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        $fileName = 'form_data_' . time() . '_' . Str::random(10) . '.json';
        Storage::disk('local')->put($fileName, json_encode($validatedData));
        return redirect()->route('form.show')->with('success', 'Данные успешно отправлены!');
    }
    public function showData()
    {
        $files = Storage::disk('local')->files();
        $formData = [];

        foreach ($files as $file) {
            if (Str::startsWith($file, 'form_data_')) {
                $formData[] = json_decode(Storage::disk('local')->get($file), true);
            }
        }

        return view('pages.data', ['formData' => $formData]);
    }
}
