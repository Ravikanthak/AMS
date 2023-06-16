<form role="form" method="POST" action="{{ route('upload') }}" enctype="multipart/form-data">
@csrf
<input type="file" name="profile_pic" class="form-control" id="profile_pic" value="">
<button type="submit">Submit</button>
</form>