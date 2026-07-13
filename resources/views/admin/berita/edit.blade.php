<x-admin-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edit Berita') }}
            </h2>
            <a href="{{ route('admin.berita.index') }}" class="text-gray-500 hover:text-primary transition font-semibold text-sm">
                <i class="fa-solid fa-arrow-left mr-1"></i> Kembali
            </a>
        </div>
    </x-slot>

    <!-- Load CKEditor 5 from CDN -->
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    <style>
        .ck-editor__editable_inline {
            min-height: 400px;
            font-family: 'Inter', sans-serif;
        }
    </style>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            ClassicEditor
                .create( document.querySelector( '#isi' ) )
                .catch( error => {
                    console.error( error );
                } );
        });
    </script>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('admin.berita.update', $berita->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <!-- Judul -->
                    <div class="mb-6">
                        <label for="judul" class="block text-sm font-bold text-gray-700 mb-2">Judul Berita <span class="text-danger">*</span></label>
                        <input type="text" name="judul" id="judul" value="{{ old('judul', $berita->judul) }}" required
                            class="w-full rounded-lg border-gray-300 focus:border-primary focus:ring focus:ring-primary/20 shadow-sm transition">
                        @error('judul') <p class="text-danger text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <!-- Kategori -->
                        <div>
                            <label for="kategori_berita_id" class="block text-sm font-bold text-gray-700 mb-2">Kategori <span class="text-danger">*</span></label>
                            <select name="kategori_berita_id" id="kategori_berita_id" required
                                class="w-full rounded-lg border-gray-300 focus:border-primary focus:ring focus:ring-primary/20 shadow-sm transition">
                                <option value="">-- Pilih Kategori --</option>
                                @foreach($kategori as $cat)
                                    <option value="{{ $cat->id }}" {{ old('kategori_berita_id', $berita->kategori_berita_id) == $cat->id ? 'selected' : '' }}>{{ $cat->nama }}</option>
                                @endforeach
                            </select>
                            @error('kategori_berita_id') <p class="text-danger text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <!-- Status -->
                        <div>
                            <label for="status" class="block text-sm font-bold text-gray-700 mb-2">Status <span class="text-danger">*</span></label>
                            <select name="status" id="status" required
                                class="w-full rounded-lg border-gray-300 focus:border-primary focus:ring focus:ring-primary/20 shadow-sm transition">
                                <option value="draft" {{ old('status', $berita->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                                <option value="published" {{ old('status', $berita->status) == 'published' ? 'selected' : '' }}>Published</option>
                            </select>
                            @error('status') <p class="text-danger text-sm mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <!-- Thumbnail -->
                    <div class="mb-6">
                        <label for="thumbnail" class="block text-sm font-bold text-gray-700 mb-2">Thumbnail (Gambar Utama)</label>
                        @if($berita->thumbnail)
                            <div class="mb-3">
                                <img src="{{ asset('storage/' . $berita->thumbnail) }}" alt="Thumbnail saat ini" class="h-32 object-cover rounded-lg shadow-sm">
                                <p class="text-xs text-gray-500 mt-1">Thumbnail saat ini</p>
                            </div>
                        @endif
                        <input type="file" name="thumbnail" id="thumbnail" accept="image/*"
                            class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary/10 file:text-primary hover:file:bg-primary/20 transition">
                        <p class="text-gray-400 text-xs mt-1">Biarkan kosong jika tidak ingin mengubah thumbnail. Maksimal 2MB, format JPG/PNG.</p>
                        @error('thumbnail') <p class="text-danger text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Isi Berita (CKEditor) -->
                    <div class="mb-6">
                        <label for="isi" class="block text-sm font-bold text-gray-700 mb-2">Isi Berita <span class="text-danger">*</span></label>
                        <textarea name="isi" id="isi">{{ old('isi', $berita->isi) }}</textarea>
                        @error('isi') <p class="text-danger text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="bg-primary text-white font-bold py-3 px-8 rounded-xl shadow-lg hover:bg-secondary hover:shadow-xl transition hover:-translate-y-1">
                            Perbarui Berita
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>
