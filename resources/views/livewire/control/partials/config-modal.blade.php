{{-- resources/views/livewire/control/partials/config-modal.blade.php --}}

<div 
    x-data="{ show: $wire.entangle('showConfigModal') }"
    x-show="show"
    x-on:keydown.escape.window="show = false"
    x-transition:enter="ease-out duration-300"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="ease-in duration-200"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="fixed inset-0 z-50 flex items-center justify-center p-4"
    style="display: none;" 
>
    {{-- Fondo oscuro --}}
    <div 
        x-show="show" 
        x-transition:enter="ease-out duration-300" 
        x-transition:enter-start="opacity-0" 
        x-transition:enter-end="opacity-100" 
        x-transition:leave="ease-in duration-200" 
        x-transition:leave-start="opacity-100" 
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 bg-gray-900 bg-opacity-75 transition-opacity" 
        @click="show = false"
    ></div>

    {{-- Contenido del Modal --}}
    <div 
        x-show="show" 
        x-transition:enter="ease-out duration-300" 
        x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
        x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" 
        x-transition:leave="ease-in duration-200" 
        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" 
        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        class="relative bg-white dark:bg-gray-800 rounded-lg shadow-xl w-full max-w-lg transition-all"
        @click.outside="show = false"
        x-trap.inert.noscroll="show"
    >
        
        <div class="p-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-indigo-500">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.343 3.94c.09-.542.56-.94 1.11-.94h1.093c.55 0 1.02.398 1.11.94l.149.894c.07.424.384.764.78.93.398.164.855.142 1.205-.108l.737-.527a1.125 1.125 0 011.45.12l.773.774c.39.389.44 1.002.12 1.45l-.527.737c-.25.35-.272.806-.107 1.204.165.397.505.71.93.78l.893.15c.543.09.94.56.94 1.109v1.094c0 .55-.397 1.02-.94 1.11l-.894.149c-.424.07-.764.383-.929.78-.165.398-.143.854.107 1.204l.527.738c.32.447.269 1.06-.12 1.45l-.774.773a1.125 1.125 0 01-1.449.12l-.738-.527c-.35-.25-.806-.272-1.203-.107-.397.165-.71.505-.781.929l-.149.894c-.09.542-.56.94-1.11.94h-1.094c-.55 0-1.019-.398-1.11-.94l-.148-.894c-.071-.424-.384-.764-.781-.93-.398-.164-.854-.142-1.204.108l-.738.527c-.447.32-1.06.269-1.45-.12l-.773-.774a1.125 1.125 0 01-.12-1.45l.527-.737c.25-.35.273-.806.108-1.204-.165-.397-.505-.71-.93-.78l-.894-.15c-.542-.09-.94-.56-.94-1.109v-1.094c0-.55.398-1.02.94-1.11l.894-.149c.424-.07.765-.383.93-.78.165-.398.143-.854-.107-1.204l-.527-.738a1.125 1.125 0 01.12-1.45l.773-.773a1.125 1.125 0 011.45-.12l.737.527c.35.25.807.272 1.204.107.397-.165.71-.505.78-.929l.15-.894z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                Calibrar Motor
            </h3>
            
            <div class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                Ajusta los ángulos de apertura y cierre. El cambio se aplicará en la próxima alimentación.
            </div>

            <div class="mt-6 space-y-6">
                
                {{-- Slider Ángulo Abierto --}}
                <div>
                    <div class="flex justify-between mb-2 items-center">
                        <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Posición Abierto</label>
                        <span class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-indigo-100 bg-indigo-600 rounded">
                            {{ $angleOpen }}°
                        </span>
                    </div>
                    <input type="range" wire:model.live="angleOpen" min="20" max="180" class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700 accent-indigo-600">
                    <div class="flex justify-between text-xs text-gray-400 mt-1">
                        <span>20°</span>
                        <span>180°</span>
                    </div>
                    @error('angleOpen') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>

                {{-- Slider Ángulo Cerrado --}}
                <div>
                    <div class="flex justify-between mb-2 items-center">
                        <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Posición Cerrado</label>
                        <span class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-gray-100 bg-gray-600 rounded">
                            {{ $angleClose }}°
                        </span>
                    </div>
                    <input type="range" wire:model.live="angleClose" min="0" max="100" class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700 accent-gray-500">
                    <div class="flex justify-between text-xs text-gray-400 mt-1">
                        <span>0°</span>
                        <span>100°</span>
                    </div>
                    @error('angleClose') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>

            </div>
        </div>

        <div class="bg-gray-50 dark:bg-gray-700 px-6 py-4 flex justify-end space-x-3 rounded-b-lg">
            <button type="button" 
                    @click="show = false"
                    class="px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm text-sm font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Cancelar
            </button>
            <button type="button" 
                    wire:click="saveSettings"
                    wire:loading.attr="disabled"
                    class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 border border-transparent rounded-md shadow-sm text-sm font-medium text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 disabled:opacity-50 transition-colors">
                Guardar Configuración
            </button>
        </div>

    </div>
</div>