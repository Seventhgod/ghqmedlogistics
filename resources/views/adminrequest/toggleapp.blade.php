<script type="application/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css"  />
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script type="application/javascript" src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
@foreach($data as $adminrequest)
    <input data-id="{{$adminrequest->id}}" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Approved" data-off="Pending" {{ $adminrequest->status ? 'unchecked' : '' }}>
@endforeach
<script type="application/javascript">
    $(function() {
        $('.toggle-class').change(function() {
            var status = $(this).prop('checked') === true ? 'Approved' : 'Pending';
            var id = $(this).data('id');

            $.ajax({
                type: "GET",
                dataType: "json",
                url: '/changestatus',
                data: {'status': status, 'id': id},
                success: function(data){
                    console.log(data.success)
                }
            });

        })
    })
</script>
