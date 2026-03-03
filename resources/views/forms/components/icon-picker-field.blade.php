<x-dynamic-component :component="$getFieldWrapperView()" :field="$field">
    @php
        $icons = json_encode(\App\Forms\Components\IconPickerField::allIcons());
        $statePath = $getStatePath();
    @endphp

    <div
        x-data="{
            open: false,
            search: '',
            value: $wire.entangle('{{ $statePath }}'),
            icons: {{ $icons }},
            get filtered() {
                if (!this.search) return this.icons;
                return this.icons.filter(i => i.includes(this.search.toLowerCase()));
            },
            select(icon) {
                this.value = icon;
                this.open = false;
                this.search = '';
            }
        }"
        class="icon-picker-wrap"
    >
        {{-- Selected preview + input --}}
        <div style="display:flex;align-items:center;gap:10px;margin-bottom:6px">
            <div style="width:46px;height:46px;border:1px solid #d1d5db;border-radius:8px;display:flex;align-items:center;justify-content:center;background:#f9fafb;flex-shrink:0">
                <template x-if="value">
                    <i :class="value" style="font-size:1.6rem;color:#f59e0b"></i>
                </template>
                <template x-if="!value">
                    <span style="color:#9ca3af;font-size:11px">Yoxdur</span>
                </template>
            </div>

            <input
                type="text"
                x-model="value"
                placeholder="İkon class adı..."
                style="flex:1;border:1px solid #d1d5db;border-radius:8px;padding:9px 12px;font-size:14px;outline:none"
                @focus="open = false"
            >

            <button
                type="button"
                @click="open = !open"
                style="padding:9px 16px;background:#f59e0b;color:white;border:none;border-radius:8px;cursor:pointer;font-size:13px;font-weight:600;white-space:nowrap;display:flex;align-items:center;gap:6px"
            >
                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
                İkon seç
            </button>
        </div>

        {{-- Icon picker panel --}}
        <div
            x-show="open"
            x-transition:enter="transition ease-out duration-150"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-100"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            style="border:1px solid #e5e7eb;border-radius:10px;padding:14px;background:white;box-shadow:0 4px 16px rgba(0,0,0,0.1);position:relative;z-index:50"
            @click.outside="open = false"
        >
            {{-- Search --}}
            <div style="display:flex;align-items:center;gap:8px;margin-bottom:12px">
                <div style="position:relative;flex:1">
                    <svg style="position:absolute;left:10px;top:50%;transform:translateY(-50%);color:#9ca3af" xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
                    <input
                        type="text"
                        x-model="search"
                        placeholder="İkon axtar..."
                        style="width:100%;border:1px solid #d1d5db;border-radius:7px;padding:8px 12px 8px 32px;font-size:13px;outline:none"
                    >
                </div>
                <button type="button" @click="open = false" style="padding:7px 10px;border:1px solid #e5e7eb;border-radius:7px;background:white;cursor:pointer;color:#6b7280">✕</button>
            </div>

            {{-- Count --}}
            <p style="font-size:12px;color:#9ca3af;margin:0 0 10px">
                <span x-text="filtered.length"></span> ikon
            </p>

            {{-- Icon grid --}}
            <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(76px,1fr));gap:6px;max-height:320px;overflow-y:auto;padding-right:4px">
                <template x-for="icon in filtered" :key="icon">
                    <button
                        type="button"
                        @click="select(icon)"
                        :title="icon"
                        :style="value === icon
                            ? 'border:2px solid #f59e0b;background:#fffbeb;outline:none'
                            : 'border:1px solid #e5e7eb;background:white'"
                        style="display:flex;flex-direction:column;align-items:center;justify-content:center;gap:5px;padding:10px 4px 8px;border-radius:8px;cursor:pointer;transition:all .15s"
                        @mouseenter="$el.style.borderColor='#f59e0b';$el.style.background='#fffbeb'"
                        @mouseleave="$el.style.borderColor = value === icon ? '#f59e0b' : '#e5e7eb'; $el.style.background = value === icon ? '#fffbeb' : 'white'"
                    >
                        <i :class="icon" style="font-size:1.5rem;color:#374151;pointer-events:none"></i>
                        <span
                            x-text="icon.replace('flaticon-','').replace('icon-','')"
                            style="font-size:10px;color:#6b7280;word-break:break-word;text-align:center;line-height:1.3;max-width:70px;pointer-events:none"
                        ></span>
                    </button>
                </template>

                <template x-if="filtered.length === 0">
                    <div style="grid-column:1/-1;text-align:center;padding:30px;color:#9ca3af;font-size:13px">
                        Heç bir ikon tapılmadı
                    </div>
                </template>
            </div>
        </div>
    </div>
</x-dynamic-component>
