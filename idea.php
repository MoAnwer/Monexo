// Using Laravel's HTTP client
$response = Http::post('/ai-assistant/chat/qwen', [
    'message' => 'Your message here'
]);

// Using JavaScript/jQuery
$.ajax({
    url: '/ai-assistant/chat/qwen',
    method: 'POST',
    data: {
        message: 'Your message here'
    },
    success: function(response) {
        // Handle the response
    }
});

// Using fetch API
fetch('/ai-assistant/chat/qwen', {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
    },
    body: JSON.stringify({
        message: 'Your message here'
    })
})
.then(response => response.json())
.then(data => {
    // Handle the response
});