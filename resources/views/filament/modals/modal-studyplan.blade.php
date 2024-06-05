<script src="//unpkg.com/alpinejs" defer></script>

<x-filament::modal>
    <x-slot name="trigger">
        <div style="display: flex; justify-content: center; width: 100%;">
            <div style="display: flex; gap: 10px;">
                <x-filament::button @click="showContent = 'checklist'">
                    Review Student Checklist
                </x-filament::button>

                <x-filament::button @click="showContent = 'studyplan'">
                    Review StudyPlan
                </x-filament::button>
            </div>
        </div>
    </x-slot>

    <!-- Modal content -->

    <div x-show="showContent === 'checklist'">
        <!-- Content for Student Checklist -->
        <p>This is the Student Checklist content.</p>
    </div>

    <div x-show="showContent === 'studyplan'">
        <!-- Content for Study Plan -->
        <p>This is the Study Plan content.</p>
    </div>
</x-filament::modal>

