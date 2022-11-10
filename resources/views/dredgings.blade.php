<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>AMLBD</title>
    <link rel="icon" type="image/x-icon" href="http://www.amlbd.com/wp-content/uploads/2014/05/new-way-to-manage1.png">
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="{{asset('css/modal.css')}}">
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
    #Dredgings tr:nth-child(even){background-color: #b2b2b2;}
    </style>
    @livewireStyles
</head>
<body>
    <div class="container-fluid" style="margin-top: 45px;">
        <div>
            @include('navbar')
        </div>
        <div style="margin-top: 100px;">
            @livewire('dredgings')
        </div>
    </div>
    
    <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @livewireScripts
    <script>
        window.addEventListener('OpenAddDredgingModal', function(){
            $('.addCountry').find('span').html('');
            $('.addCountry').find('form')[0].reset();
            $('.addCountry').modal('show');
        });
        window.addEventListener('CloseAddDredgingModal', function(){
            $('.addCountry').find('span').html('');
            $('.addCountry').find('form')[0].reset();
            $('.addCountry').modal('hide');
            Swal.fire({
                title: '<strong>Done!</strong>',
                icon: 'success',
                html:'Your Dataset has been successfully added',
                showCloseButton: true,
                showCancelButton: true,
                cancelButtonText:`Ok`,
                confirmButtonText:`Print`
            }).then((result) => {
                if (result.value) {
                    window.location.href = "{{route('invoice')}}"
                }
            });
        });
        window.addEventListener('OpenReturnCountryModal', function(event){
            $('.returnCountry').find('span').html('');
            $('.returnCountry').modal('show');
        });
        window.addEventListener('CloseReturnCountryModal', function(event){
            $('.returnCountry').find('span').html('');
            $('.returnCountry').find('form')[0].reset();
            $('.returnCountry').modal('hide');
            Swal.fire({
                title: '<strong>Done!</strong>',
                icon: 'success',
                html:'Your Dataset has been successfully updated',
                showCloseButton: true,
                showCancelButton: true,
                cancelButtonText:`Ok`,
                confirmButtonText:`Print`
            }).then((result) => {
                if (result.value) {
                    window.location.href = "{{route('invoice')}}"
                }
            });
        });
        window.addEventListener('OpenReuseModal', function(event){
            $('.reuse').find('span').html('');
            $('.reuse').modal('show');
        });
        window.addEventListener('CloseReuseModal', function(event){
            $('.reuse').find('span').html('');
            $('.reuse').find('form')[0].reset();
            $('.reuse').modal('hide');
            Swal.fire({
                title: '<strong>Done!</strong>',
                icon: 'success',
                html:'Your Dataset has been successfully updated',
                showCloseButton: true,
                showCancelButton: true,
                cancelButtonText:`Ok`,
                confirmButtonText:`Print`
            }).then((result) => {
                if (result.value) {
                    window.location.href = "{{route('invoice')}}"
                }
            });
        });
        window.addEventListener('SwalConfirm', function(event){
            swal.fire({
                title:event.detail.title,
                html:event.detail.html,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then(function(result){
                if(result.value){
                    window.livewire.emit('delete',event.detail.id);
                }
            })
        })
        window.addEventListener('deleted', function(event){
            Swal.fire(
                'Deleted!',
                'Your DataSet has been deleted.',
                'success'
                )
        });
        window.addEventListener('swal:deleteDredgings', function(event){
            swal.fire({
                title:event.detail.title,
                html:event.detail.html,
                icon: 'warning',
                showCloseButton:true,
                showCancelButton:true,
                cancelButtonText:'No',
                confirmButtonText:'Yes',
                cancelButtonColor:'#d33',
                confirmButtonColor:'#3085d6',
            }).then(function(result){
                if(result.value){
                    window.livewire.emit('deleteCheckedDredgings',event.detail.checkedIDs);
                }
            });
        });
    </script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <script>
        
        $(document).ready(function(){
    //Column Update
    $('.update').on('focus', function() {
        before = $(this).html();
    }).on('blur', function() { 
        if (before != $(this).html()) { $(this).trigger('change'); }
    });
    $('.update').on('change', function(e) {
        var id = $(this).data("id");
        var column_name = $(this).data("column");
        var value = $(this).text();
        $.ajax({
            url:"{{route('updateDredging')}}",
            method:"POST",
            data:{id:id, column_name:column_name, value:value},
            success:function(data)
            {
                Swal.fire({
                    icon: 'success',
                    title: 'Updated..',
                    text: 'Your DataSet has been Updated.',
                    showConfirmButton: false,
                    timer: 800
                })
                window.location.reload();
            }
        });
    });
});
</script>
<script>
    function html_table_to_excel(type)
    {
        var data = document.getElementById('Dredgings');
        var file = XLSX.utils.table_to_book(data, {sheet: "Dredging"});
        XLSX.write(file, { bookType: type, bookSST: true, type: 'base64' });
        XLSX.writeFile(file, 'Dredging.' + type);
    }
    const export_button = document.getElementById('export');
    export_button.addEventListener('click', () =>  {
        html_table_to_excel('xlsx');
    });
</script>
<script src="{{ asset('js/Opt.js') }}"></script>
<script src="{{ asset('js/Add.js') }}"></script>
</body>
</html>