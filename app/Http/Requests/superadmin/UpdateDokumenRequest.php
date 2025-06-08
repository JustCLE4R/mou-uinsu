<?php
namespace App\Http\Requests\superadmin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDokumenRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'kategori' => 'required|numeric|between:1,12',
            'sub_kategori' => 'max:255',
            'catatan' => 'max:255',
            'file' => 'nullable|mimes:pdf,png,jpg,jpeg|max:102400|prohibits:url',
            'url' => 'nullable|url|max:255|prohibits:file',
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute wajib diisi!',
            'mimes' => ':attribute harus berupa PDF atau gambar',
            'max' => ':attribute maksimal :max karakter',
            'numeric' => ':attribute harus berupa angka',
            'between' => ':attribute harus diantara 1 sampai 9',
            'prohibits' => 'Hanya isi salah satu (File/URL)',
            'url' => ':attribute harus berupa URL yang valid',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Nama',
            'kategori' => 'Kategori',
            'sub_kategori' => 'Sub Kategori',
            'catatan' => 'Catatan',
            'file' => 'File',
            'url' => 'URL',
        ];
    }
}
