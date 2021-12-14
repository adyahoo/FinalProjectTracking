<!-- General JS Scripts -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="{{ asset('templates/stisla/assets/js/stisla.js') }}"></script>

<!-- JS Libraies -->
<script src="{{ asset('templates/stisla/node_modules/simpleweather/jquery.simpleWeather.min.js') }}"></script>
<script src="{{ asset('templates/stisla/node_modules/chart.js/dist/Chart.min.js') }}"></script>
<script src="{{ asset('templates/stisla/node_modules/jqvmap/dist/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('templates/stisla/node_modules/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
<script src="{{ asset('templates/stisla/node_modules/summernote/dist/summernote-bs4.js') }}"></script>
<script src="{{ asset('templates/stisla/node_modules/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>
<script src="{{ asset('templates/stisla/node_modules/sweetalert/dist/sweetalert.min.js') }}"></script>

<!-- Template JS File -->
<script src="{{ asset('templates/stisla/assets/js/scripts.js') }}"></script>
<script src="{{ asset('templates/stisla/assets/js/custom.js') }}"></script>

<!-- Page Specific JS File -->
<script src="{{ asset('templates/stisla/assets/js/page/index-0.js') }}"></script>

<!-- Modal Custom Script -->
@if (Session::has('success'))
    <script>
        swal("Success!", "{{ Session::get('success') }}", "success");
    </script>
@endif
@if($errors->any())
    <script>
        var msg = "{{ implode(' \n', $errors->all(':message')) }}";
        swal("Error!", msg , "error");
    </script>
@endif
<script>
    window.deleteConfirm = function(formId) {
        swal({
            title: 'Delete Confirmation',
            icon: 'warning',
            text: 'Do you want to delete this?',
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                $('#'+formId).submit();
            }
        });
    }
</script>
<script>
    $("#table-1").dataTable({
        
    });
</script>
<script>
    $(".btn-add").click(function(){
        let action = $(this).data('action');
        $('#title').text('Add Role')
        $('#form').attr('action', action);
        $("#form").attr("method", "post");
    });

    $(".btn-edit").click(function(){
        let action = $(this).data('action');
        let detail = $(this).data('detail');
        $('#title').text('Edit Role')
        $('#form').attr('action', action);
        $("#form").attr("method", "post");
        $("#method").attr("value", "put");
        $.get(detail, function (data) {
            $('#roleName').val(data.name);
            $('#privilege').val(data.privilege);
        });
    });
</script>