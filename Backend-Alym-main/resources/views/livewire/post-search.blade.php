<div x-data="{ post: null }">
    <x-filament::input.wrapper class="mb-4" suffix-icon="heroicon-m-magnifying-glass">
        <x-filament::input
            type="text"
            wire:model="search"
            wire:keydown.enter="searchPosts"
            placeholder="Search..."
        />
    </x-filament::input.wrapper>

    <div class="flex items-center justify-center h-full w-full">
        <x-filament::loading-indicator class="h-10 w-10" wire:loading wire:target="search" />
    </div>

    @foreach($results as $result)
        <div class="shadow p-4 relative mb-4 cursor-pointer rounded-lg">
            <x-filament::badge class="absolute border border-primary-500 w-32" style="right: 10px; top: 10px; text-transform: uppercase;">
                Manga
            </x-filament::badge>

            <div class="flex flex-col gap-4 mb-4">
                <div class="flex flex-col gap-4 mb-4">
                    <h1 class="text-2xl max-w-2xl break-words">
                        {{ $result["title"] }}
                    </h1>
                    <a href="{{ $result["apiUrl"] }}">
                        <p class="text-lg truncate" style="max-width: 300px">
                            {{ $result["apiUrl"] }}
                        </p>
                    </a>
                </div>

                <div class="flex justify-end px-2">
                    <x-filament::icon-button
                        icon="heroicon-o-bookmark"
                        tag="button"
                        label="Save"
                        x-on:exists.window="(e) => !e.detail[0] ? $dispatch('open-modal', { id: 'save-post' }) : ''"
                        x-on:click="$wire.postExists('{{ $result['title'] }}'); post = {{ json_encode($result) }};"
                    />

                </div>
            </div>
        </div>
    @endforeach

    <x-filament::modal
        id="save-post"
        width="5xl"
        :close-by-clicking-away="false"
        :close-by-escaping="false"
        :close-button="false"
    >
        <x-slot name="heading">
            Create new post
        </x-slot>

        <x-slot name="description">
            This action will add a new manga to your website.
        </x-slot>

        <x-filament::input.wrapper label="adjkasl" suffix-icon="heroicon-m-link">
            <x-filament::input
                type="url"
                wire:model="url"
                placeholder="example.com"
            />
        </x-filament::input.wrapper>
        @error('url')
            <small class="text-danger-600">{{ $message }}</small>
        @enderror

        <x-slot name="footerActions">
            <x-filament::button
                x-on:click="$wire.savePost(post)"
                wire:loading.attr="disabled"
                wire:target="savePost"
                x-on:finished.window="$dispatch('close-modal', { id: 'save-post' })"
            >
                <span wire:loading.inline>Loading...</span>
                <span wire:loading.remove>Add post</span>
            </x-filament::button>
            <x-filament::button
                color="danger"
                x-on:click="$dispatch('close-modal', { id: 'save-post' })"
            >
                Cancel
            </x-filament::button>
        </x-slot>
    </x-filament::modal>


</div>
