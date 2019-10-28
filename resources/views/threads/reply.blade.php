<reply :attributes="{{ $reply }}" inline-template v-cloak>
	<div id="reply-{{ $reply->id }}">
	    <div class="card-header mt-4">
	    	<div class="level">
	    		<h5 class="flex">
			        <a href="{{ route('profile', $reply->owner->name) }}" class="flex">{{ $reply->owner->name }} 
			        </a> said {{ $reply->created_at->diffForHumans() }}
			    </h5>
			    <div>
			    	<form method="POST" action="/replies/{{ $reply->id}}/favorites">
			    		@csrf
			    		<button type="submit" class="btn btn-primary" {{ $reply->isFavorited() ? 'disabled':'' }}>
			    			{{ $reply->favorites_count }} {{ Str::plural('Favorite', $reply->favorites_count) }}
			    		</button>
			    	</form>
			   	</div>
			</div>
	    </div>
	    
	    <div class="card">
	        <div class="card-body">
	        	<div v-if="editing">
	        		<div class="form-group">
	        			<textarea class="form-control" v-model="body"></textarea>
	        		</div>
		       		<button class="btn btn-primary btn-sm" @click="update">Update</button>
		       		<button class="btn btn-link btn-sm" @click="editing = false">Cancel</button>
	        	</div>
	  	        <div v-else v-text="body"> </div>
	        </div>
	        @can ('update', $reply)
		        <div class="card-footer level">
		       		<button class="btn btn-primary btn-sm mr-1" @click="editing = true">Edit</button>
		            <form method="POST" action="/replies/{{ $reply->id }} ">
		             	@csrf
		             	{{ method_field('DELETE') }}
		            	<button type="submit" class="btn btn-sm btn-danger">Delete</button>
		        	</form>
		        </div>
	        @endcan
	    </div>
	</div>
</reply>