{{-- resources/views/dashboard/penjahit.blade.php --}}
<x-app-layout>
    <div class="flex h-screen bg-gray-100 text-gray-800">
        {{-- Sidebar --}}
        <aside class="w-64 bg-white border-r shadow-lg hidden md:flex flex-col">
            <div class="p-6 text-2xl font-bold text-teal-600 tracking-tight border-b">
              🪡 Penjahit Panel
            </div>
            <nav class="flex-1 px-4 py-6 space-y-2">
              {{-- Dashboard --}}
              @php $active = request()->routeIs('penjahit.dashboard'); @endphp
              <a href="{{ route('penjahit.dashboard') }}"
                 class="flex items-center gap-3 py-2 px-3 rounded-lg transition
                    {{ $active 
                       ? 'bg-teal-200 text-teal-800' 
                       : 'text-gray-700 hover:bg-teal-100 hover:text-teal-700' }}">
                <!-- Home icon -->
                <svg xmlns="http://www.w3.org/2000/svg"
                     class="w-5 h-5 text-teal-500"
                     fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path d="M3 12l2-2m0 0l7-7 7 7M13 5v6h6"/>
                </svg>
                Dashboard
              </a>
          
              {{-- Daftar Proyek --}}
              @php $active = request()->routeIs('penjahit.projects.*'); @endphp
              <a href="{{ route('penjahit.projects.index') }}"
                 class="flex items-center gap-3 py-2 px-3 rounded-lg transition
                    {{ $active 
                       ? 'bg-teal-200 text-teal-800' 
                       : 'text-gray-700 hover:bg-teal-100 hover:text-teal-700' }}">
                <!-- Folder icon -->
                <svg xmlns="http://www.w3.org/2000/svg"
                     class="w-5 h-5 text-teal-500"
                     fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path d="M3 7h18M3 12h18M3 17h18"/>
                </svg>
                Daftar Proyek
              </a>
          
              {{-- Tugas Saya --}}
              @php $active = request()->routeIs('penjahit.tasks.*'); @endphp
              <a href="{{ route('penjahit.tasks.index') }}"
                 class="flex items-center gap-3 py-2 px-3 rounded-lg transition
                    {{ $active 
                       ? 'bg-teal-200 text-teal-800' 
                       : 'text-gray-700 hover:bg-teal-100 hover:text-teal-700' }}">
                <!-- Clipboard/List icon -->
                <svg xmlns="http://www.w3.org/2000/svg"
                     class="w-5 h-5 text-teal-500"
                     fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path d="M9 12h6m-6 4h6m-6-8h6"/>
                </svg>
                Tugas Saya
              </a>
          
              {{-- Profil --}}
              @php $active = request()->routeIs('penjahit.profile*'); @endphp
              <a href="{{ route('penjahit.profile') }}"
                 class="flex items-center gap-3 py-2 px-3 rounded-lg transition
                    {{ $active 
                       ? 'bg-teal-200 text-teal-800' 
                       : 'text-gray-700 hover:bg-teal-100 hover:text-teal-700' }}">
                <!-- User icon -->
                <svg xmlns="http://www.w3.org/2000/svg"
                     class="w-5 h-5 text-teal-500"
                     fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path d="M5.121 17.804A11.955 11.955 0 0112 15c2.485 0 4.78.758 6.879 2.046M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                Profil
              </a>
          
              {{-- Logout --}}
              <form method="POST" action="{{ route('logout') }}" class="pt-4">
                @csrf
                <button type="submit"
                        class="flex items-center gap-3 w-full text-left py-2 px-3 rounded-lg text-red-600 hover:bg-red-100 transition">
                  <!-- Logout icon -->
                  <svg xmlns="http://www.w3.org/2000/svg"
                       class="w-5 h-5"
                       fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 002 2h3a2 2 0 002-2V7
                             a2 2 0 00-2-2h-3a2 2 0 00-2 2v1"/>
                  </svg>
                  Logout
                </button>
              </form>
            </nav>
          </aside>

        {{-- Main Content --}}
        <main class="flex-1 overflow-y-auto p-6">
            <div class="mb-8">
                <h1 class="text-3xl font-semibold text-teal-700">Penjahit Dashboard</h1>
                <p class="text-gray-500">Halo, {{ Auth::user()->name }}!</p>
            </div>

            {{-- Tabel Data Penjahit --}}
            @if(isset($penjahits) && $penjahits->count())
                <div class="bg-white shadow rounded-lg overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">#</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Alamat</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">HP</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($penjahits as $k => $p)
                                <tr>
                                    <td class="px-6 py-4 text-sm text-gray-600">{{ $k+1 }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-800">{{ $p->name }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-600">{{ $p->address }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-600">{{ $p->phone }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-600">{{ ucfirst($p->status) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-gray-500">Belum ada data penjahit. Silakan klik “Buat Data” untuk menambahkan.</p>
            @endif
        </main>
    </div>
</x-app-layout>
