@foreach($replies as $reply)
<reply :attributes="{{ $reply }}" inline-template v-cloak>

</reply>
<br>
@endforeach

{{ $replies->links() }}