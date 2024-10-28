@if(session('success'))
<div id="custom-alert" class="fixed top-0 left-0 w-full p-4 bg-green-500 text-white shadow-md z-50">
    <div class="container mx-auto flex justify-between items-center">
        <div>
            <strong>Success!</strong> {{ session('success') }}<br>
            <p>Returned by: {{ session('user')->name }}</p>
            <p>Book title: {{ session('book')->book_title }}</p>
        </div>
        <button id="close-alert" class="bg-green-700 text-white px-4 py-2 rounded">OK</button>
    </div>
</div>

<script>
    document.getElementById('close-alert').addEventListener('click', function() {
            document.getElementById('custom-alert').style.display = 'none';
        });
        setTimeout(function() {
            document.getElementById('custom-alert').style.display = 'none';
        }, 5000);
</script>
@endif

@if(session('req_max'))
<div id="custom-alert2" class="fixed top-0 left-0 w-full p-4 bg-red-500 text-black shadow-md z-50">
    <div class="container mx-auto flex justify-between items-center">
        <div>
            <strong>Fail!</strong> {{ session('req_max') }}<br>
        </div>
        <button id="close-alert2" class="bg-red-800 text-white px-4 py-2 rounded">OK</button>
    </div>
</div>

<script>
    document.getElementById('close-alert2').addEventListener('click', function() {
            document.getElementById('custom-alert2').style.display = 'none';
        });
        setTimeout(function() {
            document.getElementById('custom-alert2').style.display = 'none';
        }, 5000);
</script>
@endif

@if(session('no_req'))
<div id="custom-alert3" class="fixed top-0 left-0 w-full p-4 bg-red-500 text-black shadow-md z-50">
    <div class="container mx-auto flex justify-between items-center">
        <div>
            <strong>Fail!</strong> {{ session('no_req') }}<br>
        </div>
        <button id="close-alert3" class="bg-red-800 text-white px-4 py-2 rounded">OK</button>
    </div>
</div>

<script>
    document.getElementById('close-alert3').addEventListener('click', function() {
            document.getElementById('custom-alert3').style.display = 'none';
        });
        setTimeout(function() {
            document.getElementById('custom-alert3').style.display = 'none';
        }, 5000);
</script>
@endif

@if(session('success_req'))
<div id="custom-alert4" class="fixed top-0 left-0 w-full p-4 bg-green-500 text-black shadow-md z-50">
    <div class="container mx-auto flex justify-between items-center">
        <div>
            <strong>Success.</strong> {{ session('success_req') }}<br>
        </div>
        <button id="close-alert4" class="bg-green-800 text-white px-4 py-2 rounded">OK</button>
    </div>
</div>

<script>
    document.getElementById('close-alert4').addEventListener('click', function() {
            document.getElementById('custom-alert4').style.display = 'none';
        });
        setTimeout(function() {
            document.getElementById('custom-alert4').style.display = 'none';
        }, 5000);
</script>
@endif

@if(session('success_remove'))
<div id="custom-alert5" class="fixed top-0 left-0 w-full p-4 bg-green-500 text-black shadow-md z-50">
    <div class="container mx-auto flex justify-between items-center">
        <div>
            <strong>Success.</strong> {{ session('success_remove') }}<br>
        </div>
        <button id="close-alert5" class="bg-green-800 text-white px-4 py-2 rounded">OK</button>
    </div>
</div>

<script>
    document.getElementById('close-alert5').addEventListener('click', function() {
            document.getElementById('custom-alert5').style.display = 'none';
        });
        setTimeout(function() {
            document.getElementById('custom-alert5').style.display = 'none';
        }, 5000);
</script>
@endif