<div class="p-6">
    <div class="max-w-7xl mx-auto">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
            <h2 class="text-2xl font-bold mb-4">Generador de Newsletter PRO360</h2>
            
            <div class="mb-6">
                <form wire:submit.prevent="updatedExcelFile">
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="excel">
                            Archivo Excel
                        </label>
                        <input type="file" 
                               wire:model="excelFile" 
                               id="excel"
                               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                               accept=".xlsx,.xls">
                        @error('excelFile') 
                            <span class="text-red-500 text-xs italic">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="flex items-center justify-between">
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" 
                                type="submit"
                                wire:loading.attr="disabled">
                            <span wire:loading.remove wire:target="updatedExcelFile">Generar Newsletter</span>
                            <span wire:loading wire:target="updatedExcelFile">Procesando...</span>
                        </button>
                        
                        @if($generatedHtml)
                            <button wire:click="downloadNewsletter" 
                                    type="button"
                                    class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Descargar HTML
                            </button>
                        @endif
                    </div>
                </form>
            </div>
            
            @if($generatedHtml)
                <div class="mt-6">
                    <h3 class="text-lg font-semibold mb-2">Vista previa:</h3>
                    <div class="border p-4 rounded-lg bg-gray-50">
                        <iframe srcdoc="{{ $generatedHtml }}" 
                                class="w-full h-[600px] border-0"
                                sandbox="allow-same-origin">
                        </iframe>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
