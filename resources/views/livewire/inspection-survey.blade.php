<div x-data="{
    hasFlutterChannel: false,
    uploadImages(recordId) {
        const message = { record_id: recordId, action: 'upload' };
        if (window.FlutterChannel && FlutterChannel.postMessage) {
            FlutterChannel.postMessage(JSON.stringify(message));
        }
    }
}" x-init="hasFlutterChannel = !!(window.FlutterChannel && FlutterChannel.postMessage)">
    <div id="message">Original Text</div>
    @foreach ($images as $image)
        <div> <img src="data:image/jpeg;base64,{{ $image }}" style="max-width: 200px; margin: 5px;" /></div>
    @endforeach
    <button x-show="hasFlutterChannel" x-cloak @click.stop="uploadImages(5)">
        Upload Photo
    </button>
</div>
<script>
    document.addEventListener('livewire:init', () => {
        window.onFlutterMessage = function(data) {
            alert(JSON.stringify(data));
            if (data.action === 'upload_completed') {
                Livewire.dispatchTo('inspection-survey', 'image-uploaded', data)
            }
        }
    })
</script>
