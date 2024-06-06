<x-filament-panels::page>
    <div class="text-center">
    </div>

    {{-- Flex container for form and button --}}
    <div class="flex justify-center items-center h-full">
        {{-- Form --}}
        <div>
            {{ $this->form }}
        </div>
        {{-- Submit Button --}}
        <div>
            <button type="button" wire:click="submitForm" class="px-4 py-2 text-sm font-medium text-white border border-transparent rounded-md shadow-sm hover:bg-yellow-600 focus:ring-yellow-500" style="background-color: gold; margin-top: 30px">
                Submit
            </button>
        </div>
    </div>

    {{-- Display assessment details --}}
    @if ($showDetails)
       
            <div class="container mx-auto">
                <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                    <div class="px-4 py-5 sm:px-6">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">
                           Assessment Details
                        </h3>
                        <p class="mt-1 max-w-2xl text-sm text-gray-500">
                            Description & Amount
                        </p>
                    </div>
                    <div class="border-t border-gray-200">
                        <dl>
                            @foreach ([
                                'Tuition Fee' => '16822',
                                'Total' => '6739.00',
                                'Laboratory Fee' => '1000.00',
                                'Development Fund' => '146.00',
                                'Ang Pamantasan Fee' => '50.00',
                                'Supreme Student Council' => '50.00',
                                'Previous Payment' => '0.00',
                                'Total Assessment Fee' => '10426.00',
                            ] as $label => $field)
                                <div class="{{ $loop->iteration % 2 === 0 ? 'bg-white' : 'bg-gray-50' }} px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500">
                                        {{ $label }}
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                        {{ $field }}
                                    </dd>
                                </div>
                            @endforeach
                        </dl>
                    </div>
                </div>
            </div>
        @else
            <div class="mt-8">
                <p>No assessment found for the provided student number and academic year/semester.</p>
            </div>
       
    @endif
</x-filament-panels::page>
