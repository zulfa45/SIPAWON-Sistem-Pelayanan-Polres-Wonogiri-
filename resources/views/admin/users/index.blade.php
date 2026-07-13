<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kelola Pengguna') }}
        </h2>
    </x-slot>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-gray-100">
        <div class="p-6">
            @if(session('success'))
                <div class="bg-green-100 text-green-700 p-4 rounded-xl mb-4 text-sm font-bold">
                    <i class="fa-solid fa-check-circle mr-2"></i> {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="bg-red-100 text-red-700 p-4 rounded-xl mb-4 text-sm font-bold">
                    <i class="fa-solid fa-triangle-exclamation mr-2"></i> {{ session('error') }}
                </div>
            @endif

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-100">
                            <th class="p-4 font-bold text-gray-600 text-sm">Pengguna</th>
                            <th class="p-4 font-bold text-gray-600 text-sm">Kontak & Alamat</th>
                            <th class="p-4 font-bold text-gray-600 text-sm">Role</th>
                            <th class="p-4 font-bold text-gray-600 text-sm">Terdaftar</th>
                            <th class="p-4 font-bold text-gray-600 text-sm">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($users as $user)
                        <tr class="hover:bg-gray-50/50 transition">
                            <td class="p-4">
                                <div class="flex items-center gap-3">
                                    @if($user->avatar)
                                        <img src="{{ asset('storage/' . $user->avatar) }}" alt="Avatar" class="w-10 h-10 rounded-full object-cover">
                                    @else
                                        <div class="w-10 h-10 rounded-full bg-secondary text-white flex items-center justify-center font-bold text-sm shadow-sm">
                                            {{ substr($user->name, 0, 1) }}
                                        </div>
                                    @endif
                                    <div>
                                        <p class="font-bold text-gray-800">{{ $user->name }}</p>
                                        <p class="text-xs text-gray-500">{{ $user->nik ?? 'NIK Kosong' }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="p-4">
                                <p class="text-sm text-gray-700"><i class="fa-regular fa-envelope text-gray-400 mr-1"></i> {{ $user->email }}</p>
                                <p class="text-sm text-gray-700 mt-1"><i class="fa-solid fa-phone text-gray-400 mr-1"></i> {{ $user->no_hp ?? '-' }}</p>
                                <p class="text-xs text-gray-500 mt-1 max-w-xs truncate" title="{{ $user->alamat }}"><i class="fa-solid fa-location-dot text-gray-400 mr-1"></i> {{ $user->alamat ?? '-' }}</p>
                            </td>
                            <td class="p-4">
                                <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="flex gap-2">
                                    @csrf
                                    @method('PATCH')
                                    <select name="role" class="text-sm rounded-lg border-gray-300 py-1 pl-3 pr-8 focus:ring-primary focus:border-primary" onchange="this.form.submit()">
                                        <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>Warga</option>
                                        <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                    </select>
                                </form>
                            </td>
                            <td class="p-4 text-sm text-gray-600">
                                {{ $user->created_at->format('d M Y') }}
                            </td>
                            <td class="p-4">
                                @if($user->id !== auth()->id())
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-danger hover:text-red-700 p-2 bg-red-50 rounded-lg hover:bg-red-100 transition" title="Hapus Pengguna">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-admin-layout>
