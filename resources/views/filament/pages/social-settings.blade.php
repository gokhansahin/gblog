<x-filament-panels::page>
    <form wire:submit="save">
        {{ $this->form }}

        <div class="mt-6 flex justify-end">
            <button type="submit" class="fi-btn fi-btn-color-primary fi-btn-size-md fi-btn-lg:fi-btn-size-lg inline-flex items-center justify-center gap-x-2 rounded-lg border border-transparent px-3 py-2 text-sm font-semibold shadow-sm ring-1 transition duration-75 fi-color-primary bg-primary-600 text-white ring-primary-600 hover:bg-primary-700 dark:bg-primary-500 dark:text-white dark:ring-primary-500 dark:hover:bg-primary-400">
                Kaydet
            </button>
        </div>
    </form>
</x-filament-panels::page>


