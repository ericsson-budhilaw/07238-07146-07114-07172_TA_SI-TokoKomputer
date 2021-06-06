<div>
    <div style="text-align: center">
        <input type="text" wire:model.defer="message">
        <button wire:click="search">Search</button>
        <h1>{{ $message }}</h1>
    </div>
</div>
