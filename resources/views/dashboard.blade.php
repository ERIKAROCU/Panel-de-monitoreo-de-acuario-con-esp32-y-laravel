<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Acuario Inteligente') }}
        </h2>
    </x-slot> --}}

    {{-- 
      Aquí llamamos a nuestro ÚNICO componente padre.
      Asegúrate de que el nombre coincide con el que renombraste.
      (app/Livewire/AcuarioDashboard.php -> <livewire:acuario-dashboard />)
    --}}
    <livewire:acuario-dashboard />

</x-app-layout>
