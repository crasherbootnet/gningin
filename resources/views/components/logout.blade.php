<a href="{{ url($space.'/logout') }}" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">
    Log out
</a> 
<form id="frm-logout" action="{{ url($space.'/logout') }}" method="POST" style="display: none;">
    {{ csrf_field() }}
</form> 