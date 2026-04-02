public function detailSejarah($tahun) {
    // Ini contoh data simulasi, nanti bisa ambil dari Database
    $dataSejarah = [
        '1985' => [
            'judul' => 'Pendirian Pondok',
            'gambar' => 'images/1985.png',
            'deskripsi' => [
                'Paragraf pertama sejarah...',
                'Paragraf kedua sejarah...',
            ]
        ],
        // tahun lainnya...
    ];

    $sejarah = $dataSejarah[$tahun];

    return view('pages.public.profile.detail-sejarah', compact('sejarah', 'tahun'));
}