<x-filament-panels::page>
<div class="p-6 rounded-md shadow-sm">
        <form wire:submit.prevent="submitForm" method="post">
            {{ $this->form }}
            <div class="p-3 rounded-md shadow-sm">
                <button type="submit" class="inline-flex items-center px-4 py-2 mt-1 text-sm font-medium text-white border border-transparent rounded-md shadow-sm hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500" style="background-color: gold;">
                    Submit
                </button>
            </div>
        </form>
    </div>

    @if($submitted)
        <div class="mt-6">
            <!-- You can customize this section with a new form or any other content to display after the form is submitted -->
            <h2>Form Submitted Successfully</h2>
            <p>Here you can render a new form or display a success message.</p>
        </div>
    @endif
</x-filament-panels::page>
