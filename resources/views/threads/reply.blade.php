<div class="">
    <div class="card-header mt-4">
        <a href="#" >{{ $reply->owner->name }} 
        </a> said {{ $reply->created_at->diffForHumans() }}
    </div>
    
    <div class="card">
        <div class="card-body">
            {{ $reply->body }}
        </div>
    </div>
</div>