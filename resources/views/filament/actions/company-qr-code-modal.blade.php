@php
    use Illuminate\Support\Str;

    $filename = Str::slug($record->full_name) . '-qr-code.png';
@endphp
<div class="flex flex-col items-center space-y-4">
    <h2 class="text-lg font-bold">{{ $record->name }}</h2>
    <img src="{{ $qr }}" alt="QR Code" id="qr-image">
    <a href="{{ $qr }} " download="{{ $filename }}" target="_blank">
        <button type="button"
            class="inline-flex items-center px-4 py-2 bg-primary-600 text-white rounded hover:bg-primary-700 transition">
            Download QR
        </button></a>
</div>
