<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profil Pengguna SIPRES') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="bg-white shadow sm:rounded-lg p-6">
                <div class="flex items-center space-x-6">

                    <div class="w-24 h-24 rounded-full bg-blue-500 text-white flex items-center justify-center text-3xl font-bold">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>

                    <div>
                        <h3 class="text-2xl font-bold text-gray-800">
                            {{ Auth::user()->name }}
                        </h3>

                        <p class="text-gray-600">
                            {{ Auth::user()->email }}
                        </p>

                        <span class="inline-block mt-2 px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-sm">
                            Pengguna SIPRES
                        </span>
                    </div>

                </div>
            </div>

         
            <div class="bg-white shadow sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">
                    Informasi Akun
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    <div>
                        <p class="text-sm text-gray-500">Nama Lengkap</p>
                        <p class="font-medium">{{ Auth::user()->name }}</p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">Email</p>
                        <p class="font-medium">{{ Auth::user()->email }}</p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">Tanggal Bergabung</p>
                        <p class="font-medium">
                            {{ Auth::user()->created_at->format('d F Y') }}
                        </p>
                    </div>

                    @if(isset(Auth::user()->role))
                    <div>
                        <p class="text-sm text-gray-500">Role</p>
                        <p class="font-medium capitalize">
                            {{ Auth::user()->role }}
                        </p>
                    </div>
                    @endif

                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

          
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

        </div>
    </div>
</x-app-layout>