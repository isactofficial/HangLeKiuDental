<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LayananController extends Controller
{
    /**
     * Public layanan/perawatan pages.
     */
    public function show(string $slug)
    {
        $services = [
            'bleaching' => [
                'title' => 'Bleaching',
                'description' => 'Perawatan pemutihan gigi untuk membantu mengurangi noda dan membuat warna gigi tampak lebih cerah secara aman.',
            ],
            'gigi-tiruan' => [
                'title' => 'Gigi Tiruan',
                'description' => 'Solusi penggantian gigi yang hilang untuk membantu fungsi mengunyah, bicara, dan estetika senyum kembali optimal.',
            ],
            'implan-gigi' => [
                'title' => 'Implan Gigi',
                'description' => 'Penggantian gigi permanen dengan penanaman implant sebagai akar gigi buatan untuk hasil yang stabil dan natural.',
            ],
            'orthodontics' => [
                'title' => 'Orthodontics',
                'description' => 'Perawatan perapihan gigi untuk memperbaiki susunan gigi dan gigitan agar lebih sehat, nyaman, dan rapi.',
            ],
            'pencabutan-gigi' => [
                'title' => 'Pencabutan Gigi',
                'description' => 'Tindakan pencabutan gigi yang sudah tidak dapat dipertahankan, dilakukan dengan prosedur yang aman dan nyaman.',
            ],
            'perawatan-gigi-anak' => [
                'title' => 'Perawatan Gigi Anak',
                'description' => 'Perawatan gigi khusus anak dengan pendekatan ramah untuk menjaga kesehatan gigi sejak dini dan mencegah masalah berulang.',
            ],
            'perawatan-saluran-akar' => [
                'title' => 'Perawatan Saluran Akar',
                'description' => 'Perawatan untuk mengatasi infeksi atau kerusakan saraf gigi (pulpa) agar gigi tetap bisa dipertahankan.',
            ],
            'scaling' => [
                'title' => 'Scaling',
                'description' => 'Pembersihan karang gigi dan plak untuk membantu mencegah radang gusi, bau mulut, dan menjaga kesehatan mulut.',
            ],
            'tambal-gigi' => [
                'title' => 'Tambal Gigi',
                'description' => 'Perawatan penambalan untuk memperbaiki gigi berlubang atau retak sehingga fungsi dan bentuk gigi kembali baik.',
            ],
            'veneer' => [
                'title' => 'Veneer',
                'description' => 'Perawatan estetika berupa lapisan tipis pada permukaan gigi untuk memperbaiki bentuk, warna, dan tampilan senyum.',
            ],
        ];

        abort_unless(array_key_exists($slug, $services), 404);

        return view('layanan.perawatan.show', [
            'slug' => $slug,
            'title' => $services[$slug]['title'],
            'description' => $services[$slug]['description'],
        ]);
    }
}
