@foreach($data as $adminrequest)
    @if($adminrequest->status == "Pending")
        <label class="label label-danger">Pending</label>
    @elseif($adminrequest->status == "Approved")
        <label class="label label-success">Approved</label>
    @endif
@endforeach
