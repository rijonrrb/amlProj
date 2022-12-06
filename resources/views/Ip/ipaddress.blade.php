<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>AMLBD</title>
    <link rel="icon" type="image/x-icon" href="{{asset('img/aml.png')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="{{asset('css/modal.css')}}">
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/i18n/defaults-*.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
    #Ip tr:nth-child(even){background-color: #b2b2b2;}
    </style>
    @livewireStyles
</head>
<body>
    <div class="container-fluid" style="margin-top: 45px;">
      <div>
        @include('navbar.Usernavbar')
    </div>
    <div style="margin-top: 100px;">
        @livewire('ipaddress')
    </div>
</div>
<script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@livewireScripts
<script>
 window.addEventListener('OpenAddIPsModal', function(){
    $('.addIPs').find('span').html('');
    $('.addIPs').find('form')[0].reset();
    $('.addIPs').modal('show');
});
 window.addEventListener('CloseAddIPsModal', function(){
     $('.addIPs').find('span').html('');
     $('.addIPs').find('form')[0].reset();
     $('.addIPs').modal('hide');
    Swal.fire({
                icon: 'success',
                title: 'Inserted..',
                text: 'Your Dataset has been successfully added.',
                showConfirmButton: false,
                timer: 800
            });
});
window.addEventListener('ClosefailedIPsModal', function(){
     $('.addIPs').find('span').html('');
     $('.addIPs').find('form')[0].reset();
     $('.addIPs').modal('hide');
    Swal.fire({
                icon: 'error',
                title: 'Oops..',
                text: 'This IP Address already inserted',
                showCloseButton:true,
                showConfirmButton: false,
            });
});
window.addEventListener('OpenAddIPModal', function(){
    $('.addIP').find('span').html('');
    $('.addIP').find('form')[0].reset();
    $('.addIP').modal('show');
});
 window.addEventListener('CloseAddIPModal', function(){
     $('.addIP').find('span').html('');
     $('.addIP').find('form')[0].reset();
     $('.addIP').modal('hide');
    Swal.fire({
                icon: 'success',
                title: 'Inserted..',
                text: 'Your Dataset has been successfully added.',
                showConfirmButton: false,
                timer: 800
            });
});
window.addEventListener('ClosefailedIPModal', function(){
     $('.addIP').find('span').html('');
     $('.addIP').find('form')[0].reset();
     $('.addIP').modal('hide');
    Swal.fire({
                icon: 'error',
                title: 'Oops..',
                text: 'This IP Address already inserted',
                showCloseButton:true,
                showConfirmButton: false,
            });
});
window.addEventListener('OpenEditModal', function(event){
               $('.updateRow').find('span').html('');
               $('.updateRow').modal('show');
           });
        window.addEventListener('CloseEditModal', function(event){
               $('.updateRow').find('span').html('');
               $('.updateRow').find('form')[0].reset();
               $('.updateRow').modal('hide');
               Swal.fire({
                    icon: 'success',
                    title: 'Updated..',
                    text: 'Your DataSet has been Updated.',
                    showConfirmButton: false,
                    timer: 800
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
});
 window.addEventListener('deleted', function(event){
    Swal.fire(
        'Deleted!',
        'Your DataSet has been deleted.',
        'success'
        )
});
 window.addEventListener('swal:deleteIps', function(event){
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
             window.livewire.emit('deleteCheckedIps',event.detail.checkedIDs);
         }
     });
 });
</script>

<script>
    function html_table_to_excel(type)
    {
        var data = document.getElementById('Ip');
        var file = XLSX.utils.table_to_book(data, {sheet: "IP Address List"});
        XLSX.write(file, { bookType: type, bookSST: true, type: 'base64' });
        XLSX.writeFile(file, 'IP-List.' + type);
    }
    const export_button = document.getElementById('export');
    export_button.addEventListener('click', () =>  {
        html_table_to_excel('xlsx');
    });
</script>
<script>
document.addEventListener('livewire:load', function () {
 $('#select_page').selectpicker();
})
document.addEventListener('DOMContentLoaded', () => {
    Livewire.hook('element.updating', (fromEl, toEl, component) => {
        console.log('being update'); $('#select_page').selectpicker('destroy'); })
        Livewire.hook('message.processed', (message, component) => { 
            $('#select_page').selectpicker();
    }) 
});
</script>
</body>
</html>