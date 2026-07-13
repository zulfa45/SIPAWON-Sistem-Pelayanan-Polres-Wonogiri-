<x-app-layout>
    <!-- CSS Khusus untuk ckeditor-content agar styling bawaan admin/editor dapat ditampilkan di front-end dengan baik -->
    <style>
        .ckeditor-content h2 { font-size: 1.5rem; font-weight: bold; margin-top: 1.5rem; margin-bottom: 1rem; color: #1f2937; }
        .ckeditor-content h3 { font-size: 1.25rem; font-weight: bold; margin-top: 1.25rem; margin-bottom: 0.75rem; color: #374151; }
        .ckeditor-content p { margin-bottom: 1rem; line-height: 1.8; color: #4b5563; }
        .ckeditor-content ul { list-style-type: disc; margin-left: 1.5rem; margin-bottom: 1rem; color: #4b5563; }
        .ckeditor-content ol { list-style-type: decimal; margin-left: 1.5rem; margin-bottom: 1rem; color: #4b5563; }
        .ckeditor-content blockquote { border-left: 4px solid #e5e7eb; padding-left: 1rem; font-style: italic; color: #6b7280; margin: 1.5rem 0; }
        .ckeditor-content img { max-width: 100%; height: auto; border-radius: 0.5rem; margin: 1.5rem 0; }
        .ckeditor-content a { color: #2563eb; text-decoration: underline; }
    </style>

    <div class="py-12 bg-background min-h-screen font-inter">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row gap-8">
                
                <!-- Main Content -->
                <article class="lg:w-2/3 bg-white rounded-3xl p-6 sm:p-10 shadow-sm border border-gray-100">
                    <div class="mb-6">
                        <span class="inline-block bg-primary/10 text-primary text-xs font-bold px-3 py-1 rounded-full mb-4">
                            {{ $berita->kategori->nama ?? 'Tanpa Kategori' }}
                        </span>
                        <h1 class="text-3xl sm:text-4xl font-extrabold text-gray-900 leading-tight mb-4">{{ $berita->judul }}</h1>
                        <div class="flex items-center text-sm text-gray-500 gap-4">
                            <span class="flex items-center"><i class="fa-solid fa-user-pen mr-2 text-primary"></i> {{ $berita->user->name ?? 'Admin' }}</span>
                            <span class="flex items-center"><i class="fa-regular fa-calendar mr-2 text-primary"></i> {{ $berita->created_at->translatedFormat('d F Y') }}</span>
                        </div>
                    </div>

                    @if($berita->thumbnail)
                        <div class="mb-8 rounded-2xl overflow-hidden bg-gray-100 shadow-inner">
                            <img src="{{ asset('storage/' . $berita->thumbnail) }}" alt="{{ $berita->judul }}" class="w-full h-auto max-h-[500px] object-cover hover:scale-105 transition duration-700">
                        </div>
                    @endif

                    <!-- Isi Berita HTML dari CKEditor -->
                    <div class="ckeditor-content text-lg">
                        {!! $berita->isi !!}
                    </div>

                    <div class="mt-12 pt-6 border-t border-gray-100 flex justify-between items-center">
                        <div class="flex items-center gap-3">
                            <span class="text-sm font-bold text-gray-700">Bagikan:</span>
                            <a href="#" class="w-10 h-10 rounded-full bg-blue-600 text-white flex items-center justify-center hover:-translate-y-1 transition shadow-lg hover:shadow-blue-600/30"><i class="fa-brands fa-facebook-f"></i></a>
                            <a href="#" class="w-10 h-10 rounded-full bg-green-500 text-white flex items-center justify-center hover:-translate-y-1 transition shadow-lg hover:shadow-green-500/30"><i class="fa-brands fa-whatsapp"></i></a>
                            <a href="#" class="w-10 h-10 rounded-full bg-gray-800 text-white flex items-center justify-center hover:-translate-y-1 transition shadow-lg hover:shadow-gray-800/30"><i class="fa-brands fa-x-twitter"></i></a>
                        </div>
                        <a href="{{ route('home') }}" class="text-primary hover:text-secondary font-bold text-sm transition flex items-center"><i class="fa-solid fa-arrow-left mr-2"></i> Kembali</a>
                    </div>
                </article>

                <!-- Sidebar Sidebar -->
                <aside class="lg:w-1/3">
                    <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-sm border border-gray-100 sticky top-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center border-b border-gray-100 pb-4">
                            <i class="fa-solid fa-fire text-secondary mr-2"></i> Berita Terbaru
                        </h3>
                        <div class="space-y-6">
                            @forelse($latest_news as $news)
                                <a href="{{ route('berita.show', $news->slug) }}" class="group flex gap-4 items-center">
                                    <div class="w-24 h-24 rounded-xl overflow-hidden flex-shrink-0 bg-gray-100">
                                        @if($news->thumbnail)
                                            <img src="{{ asset('storage/' . $news->thumbnail) }}" alt="{{ $news->judul }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center text-gray-400"><i class="fa-solid fa-image text-2xl"></i></div>
                                        @endif
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-gray-800 group-hover:text-primary transition line-clamp-2 text-sm">{{ $news->judul }}</h4>
                                        <span class="text-xs text-gray-500 mt-2 block"><i class="fa-regular fa-clock mr-1"></i> {{ $news->created_at->diffForHumans() }}</span>
                                    </div>
                                </a>
                            @empty
                                <p class="text-gray-500 text-sm">Belum ada berita lainnya.</p>
                            @endforelse
                        </div>
                    </div>
                </aside>

            </div>
        </div>
    </div>
</x-app-layout>
