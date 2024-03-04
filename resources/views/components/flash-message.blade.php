@if (session()->has('message'))
    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show"
        class="fixed top-0 left-1/2 transform -translate-x-1/2 bg-green-500 text-white px-6 py-3 rounded-lg mt-2">
        {{ session('message') }}
    </div>
@endif
