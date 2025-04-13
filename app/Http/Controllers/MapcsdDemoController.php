<?php


// Example in your Controller (e.g., YourController.php)
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class MapcsdDemoController extends Controller
{
    public function showForm(): View
    {
        $formData = [
            [
                'element' => 'HOLISTIC (HOLISTIK)',
                'attributes' => [
                    ['id' => 'hk_kerja_kumpulan', 'attribute' => 'Kerja Kumpulan', 'teras' => 'Kepimpinan; Sukan (*)'],
                    ['id' => 'hk_kepimpinan', 'attribute' => 'Kepimpinan', 'teras' => 'Kepimpinan (Cth: Jawatan yang disandang dalam Pertubuhan Pelajar, Anugerah)'],
                    ['id' => 'hk_pembelajaran', 'attribute' => 'Pembelajaran Sepanjang Hayat', 'teras' => 'Kesukarelawanan; Khidmat Masyarakat; Reka Cipta & Inovasi (*)'],
                ]
            ],
            [
                'element' => 'ENTREPRENEURIAL (KEUSAHAWANAN)',
                'attributes' => [
                    ['id' => 'en_minda', 'attribute' => 'Minda Keusahawanan', 'teras' => 'Keusahawanan; Reka Cipta & Inovasi (Cth: Projek Menerbitkan Majalah, Produk, Sistem, Fotografi, Videograf Secara Atas Talian Atau Fizikal) (*)'],
                    ['id' => 'en_kemahiran', 'attribute' => 'Kemahiran Keusahawanan', 'teras' => 'Keusahawanan (Cth: Subjek WUS101, Inkubator Usahawan Pelajar, Jualan Hari Konvokesyen, Persembahan Berbayar, Aktiviti yang melibatkan kursus berkredit tidak layak MyCSD)'],
                ]
            ],
            [
                'element' => 'BALANCED (SEIMBANG)',
                'attributes' => [
                    ['id' => 'bl_nilai', 'attribute' => 'Nilai, Sikap & Kemanusiaan', 'teras' => 'Kesukarelawanan; Khidmat Masyarakat; Kepimpinan (Cth: Perkembangan Diri) (*)'],
                    ['id' => 'bl_etika', 'attribute' => 'Etika & Profesionalisme', 'teras' => 'Kepimpinan; Pengucapan Awam; Sukan (*)'],
                    ['id' => 'ar_pemikiran_saintifik', 'attribute' => 'Pemikiran Saintifik', 'teras' => 'Reka Cipta & Inovasi'],
                    ['id' => 'ar_apresiasi_seni', 'attribute' => 'Apresiasi Seni', 'teras' => 'Kebudayaan'],
                ]
            ],
             [
                'element' => 'ARTICULATE (ARTIKULASI)',
                'attributes' => [
                    ['id' => 'ar_komunikasi', 'attribute' => 'Komunikasi', 'teras' => 'Kepimpinan; Pengucapan Awam (*)'],
                    ['id' => 'ar_keyakinan', 'attribute' => 'Keyakinan', 'teras' => 'Pengucapan Awam; Kebudayaan; Sukan (*)'],
                ]
            ],
             [
                'element' => 'THINKING (BERFIKIR)',
                'attributes' => [
                    ['id' => 'th_pemikiran_kritis', 'attribute' => 'Pemikiran Kritis', 'teras' => 'Reka Cipta & Inovasi; Keusahawanan (*)'],
                    ['id' => 'th_pemikiran_kreatif', 'attribute' => 'Pemikiran Kreatif & Inovatif', 'teras' => 'Reka Cipta & Inovasi; Kebudayaan (*)'],
                    ['id' => 'th_penyelesaian_masalah', 'attribute' => 'Penyelesaian Masalah', 'teras' => 'Reka Cipta & Inovasi; Kesukarelawanan; Khidmat Masyarakat; Keusahawanan (*)'],
                    ['id' => 'th_minda_global', 'attribute' => 'Minda Global', 'teras' => 'Program Antarabangsa (Cth: Internship, Student Exchange, Pertandingan, Persembahan); Sukan (*)'],
                ]
            ],
            // ... Add other elements and their attributes similarly
        ];

        // Pass old input back in case of validation errors
        $selectedAttributes = old('selected_attributes', []);

        return view('your-form-view', compact('formData', 'selectedAttributes')); // Pass data to the Blade view
    }

    public function submitForm(Request $request)
    {
        // Validation (optional but recommended)
        // $validated = $request->validate([
        //     'selected_attributes' => 'nullable|array',
        //     'selected_attributes.*' => 'string|distinct' // Ensure submitted values are strings and unique
        // ]);

        // Process the submitted data
        $selected = $request->input('selected_attributes', []); // Get the array of selected checkbox values

        // dd($selected); // Dump and die to see the selected values

        // ... Save to database or perform other actions ...

        return redirect()->back()->with('success', 'Form submitted successfully!');
    }
}