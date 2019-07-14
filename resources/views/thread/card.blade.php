<div class="card">
    <div class="card-header">
        <a href="#">
            {{ $thread->creator->name }}
        </a>
        write {{ $thread->title }}
    </div>
    <div class="card-body">
        {{ $slot }}
    </div>


</div>