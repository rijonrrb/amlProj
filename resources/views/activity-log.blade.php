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
    #Logs tr:nth-child(even){background-color: #b2b2b2;}
    </style>
    @livewireStyles
</head>
<body>
    <div class="container-fluid" style="margin-top: 45px;">
        <div>
            @include('Dashnavbar')
        </div>
        <div style="margin-top: 100px;">
            @livewire('activity-log')
        </div>
    </div>
    
    <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @livewireScripts
    <script>
 

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
        window.addEventListener('swal:deleteLogs', function(event){
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
                    window.livewire.emit('deleteCheckedLogs',event.detail.checkedIDs);
                }
            });
        });
    </script>
</body>
</html>