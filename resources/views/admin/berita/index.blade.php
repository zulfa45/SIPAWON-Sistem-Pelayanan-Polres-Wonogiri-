<x-admin-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Kelola Berita') }}
            </h2>
            <a href="{{ route('admin.berita.create') }}" class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-secondary transition shadow-sm font-semibold text-sm">
                <i class="fa-solid fa-plus mr-1"></i> Tambah Berita
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Flash Message -->
            @if (session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50 border-b">
                                <th class="p-4 font-bold text-gray-700">Thumbnail</th>
                                <th class="p-4 font-bold text-gray-700">Judul</th>
                                <th class="p-4 font-bold text-gray-700">Status</th>
                                <th class="p-4 font-bold text-gray-700">Tanggal</th>
                                <th class="p-4 font-bold text-gray-700 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($berita as $item)
                            <tr class="border-b hover:bg-gray-50 transition">
                                <td class="p-4">
                                    @if($item->thumbnail)
                                        <img src="{{ asset('storage/' . $item->thumbnail) }}" alt="Thumbnail" class="w-16 h-16 object-cover rounded-lg shadow-sm">
                                    @else
                                        <div class="w-16 h-16 bg-gray-200 rounded-lg flex items-center justify-center text-gray-400"><i class="fa-regular fa-image"></i></div>
                                    @endif
                                </td>
                                <td class="p-4">
                                    <h4 class="font-bold text-primary">{{ $item->judul }}</h4>
                                    <p class="text-sm text-gray-500">{{ $item->kategori->nama ?? 'Umum' }}</p>
                                </td>
                                <td class="p-4">
                                    <span class="px-3 py-1 rounded-full text-xs font-bold {{ $item->status == 'published' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-700' }}">
                                        {{ ucfirst($item->status) }}
                                    </span>
                                </td>
                                <td class="p-4 text-sm text-gray-600">{{ $item->created_at->format('d M Y') }}</td>
                                <td class="p-4 text-right flex justify-end gap-2">
                                    <a href="{{ route('admin.berita.edit', $item->id) }}" class="text-blue-500 hover:text-blue-700 p-2"><i class="fa-solid fa-pen"></i></a>
                                    <form action="{{ route('admin.berita.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus berita ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-danger hover:text-red-700 p-2"><i class="fa-solid fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="p-8 text-center text-gray-500">Belum ada berita.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="mt-4">
                    {{ $berita->links() }}
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
