<footer class="bg-gray-900 text-gray-300 mt-20">
    <div class="max-w-7xl mx-auto px-6 py-14 grid md:grid-cols-4 gap-10">

        {{-- BRAND --}}
        <div>
            <h2
    class="text-2xl font-bold text-white cursor-pointer hover:text-indigo-400 transition"
    wire:navigate
    href="/">
    {{ $webSetting?->site_title ?? 'Nama Website' }}
</h2>


            <p class="mt-4 text-gray-400">
                {{ $webSetting?->site_description ?? 'Deskripsi website belum tersedia.' }}
            </p>
        </div>

        {{-- NAVIGASI --}}
        <div>
            <h4 class="font-semibold text-white mb-3">Navigasi</h4>
            <ul class="space-y-2">
                <li><a href="#" class="hover:text-indigo-400">Beranda</a></li>
                <li><a href="#kamar" class="hover:text-indigo-400">Kamar</a></li>
                <li><a href="#fasilitas" class="hover:text-indigo-400">Fasilitas</a></li>
                <li><a href="#kontak" class="hover:text-indigo-400">Kontak</a></li>
            </ul>
        </div>

        {{-- CONTACT --}}
        <div>
            <h4 class="font-semibold text-white mb-3">Kontak</h4>

            @if ($contact)
                <ul class="space-y-2 text-sm">

                    @if ($contact->phone)
                        <li>📞 {{ $contact->phone }}</li>
                    @endif

                    @if ($contact->email)
                        <li>✉️ {{ $contact->email }}</li>
                    @endif

                    @if ($contact->address)
                        <li>
                            📍 {{ $contact->address }}
                            @if ($contact->address_note)
                                <span class="text-gray-400 text-xs block">
                                    {{ $contact->address_note }}
                                </span>
                            @endif
                        </li>
                    @endif

                </ul>
            @else
                <p class="text-gray-400 text-sm">
                    Informasi kontak belum tersedia.
                </p>
            @endif
        </div>

        {{-- SOCIAL MEDIA --}}
        <div>
            <h4 class="font-semibold text-white mb-3">Ikuti Kami</h4>

            @if ($webSetting?->social_media)
                <div class="flex space-x-4 text-xl">

                    @foreach ($webSetting->social_media as $platform => $url)
                        <a
                            href="{{ $url }}"
                            target="_blank"
                            class="hover:text-indigo-400 capitalize"
                            title="{{ ucfirst($platform) }}">
                            @switch($platform)
                                @case('instagram') 📸 @break
                                @case('facebook') 📘 @break
                                @case('whatsapp') 💬 @break
                                @case('email') ✉️ @break
                                @default 🌐
                            @endswitch
                        </a>
                    @endforeach

                </div>
            @else
                <p class="text-gray-400 text-sm">
                    Media sosial belum tersedia.
                </p>
            @endif
        </div>

    </div>

    {{-- COPYRIGHT --}}
    <div class="border-t border-gray-700 py-5 text-center text-gray-500 text-sm">
        {{ $webSetting?->copyright ?? '© ' . date('Y') . ' All rights reserved.' }}
    </div>
</footer>
