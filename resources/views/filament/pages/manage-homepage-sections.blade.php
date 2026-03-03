<x-filament-panels::page>
    <div class="space-y-6">

        <x-filament::section heading="Haqqımızda (About)">
            <form wire:submit.prevent="save('about')">
                {{ $this->aboutForm }}
                <div class="mt-4">
                    <x-filament::button type="submit">Yadda saxla</x-filament::button>
                </div>
            </form>
        </x-filament::section>

        <x-filament::section heading="Slogan 1">
            <form wire:submit.prevent="save('slogan1')">
                {{ $this->slogan1Form }}
                <div class="mt-4">
                    <x-filament::button type="submit">Yadda saxla</x-filament::button>
                </div>
            </form>
        </x-filament::section>

        <x-filament::section heading="Slogan 2">
            <form wire:submit.prevent="save('slogan2')">
                {{ $this->slogan2Form }}
                <div class="mt-4">
                    <x-filament::button type="submit">Yadda saxla</x-filament::button>
                </div>
            </form>
        </x-filament::section>

        <x-filament::section heading="Sertifikat Mətni (Cert Text)">
            <form wire:submit.prevent="save('cert_text')">
                {{ $this->certTextForm }}
                <div class="mt-4">
                    <x-filament::button type="submit">Yadda saxla</x-filament::button>
                </div>
            </form>
        </x-filament::section>

        <x-filament::section heading="Gələcək Xidmətlər">
            <form wire:submit.prevent="save('future_services')">
                {{ $this->futureServicesForm }}
                <div class="mt-4">
                    <x-filament::button type="submit">Yadda saxla</x-filament::button>
                </div>
            </form>
        </x-filament::section>

    </div>
</x-filament-panels::page>
