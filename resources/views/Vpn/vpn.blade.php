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
    #Vpn tr:nth-child(even){background-color: #b2b2b2;}
    </style>
    @livewireStyles
</head>
<body>
    <div class="container-fluid" style="margin-top: 45px;">
      <div>
        @include('navbar.Usernavbar')
    </div>
    <div style="margin-top: 100px;">
        @livewire('vpn')
    </div>
</div>
<script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@livewireScripts
<script>
 window.addEventListener('OpenAddVpnModal', function(){
    $('.addVpn').find('span').html('');
    $('.addVpn').find('form')[0].reset();
    $('.addVpn').modal('show');
});
 window.addEventListener('CloseAddVpnModal', function(){
     $('.addVpn').find('span').html('');
     $('.addVpn').find('form')[0].reset();
     $('.addVpn').modal('hide');
    Swal.fire({
                icon: 'success',
                title: 'Inserted..',
                text: 'Your Dataset has been successfully added.',
                showConfirmButton: false,
                timer: 800
            });
});
window.addEventListener('ClosefailedVpnModal', function(){
     $('.addVpn').find('span').html('');
     $('.addVpn').find('form')[0].reset();
     $('.addVpn').modal('hide');
    Swal.fire({
                icon: 'error',
                title: 'Oops..',
                text: 'This User-Name is already inserted',
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
window.addEventListener('ClosefailedEditModal', function(){
     $('.updateRow').find('span').html('');
     $('.updateRow').find('form')[0].reset();
     $('.updateRow').modal('hide');
    Swal.fire({
                icon: 'error',
                title: 'Oops..',
                text: 'This User-Name is already inserted',
                showCloseButton:true,
                showConfirmButton: false,
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
 window.addEventListener('swal:deleteVpns', function(event){
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
             window.livewire.emit('deleteCheckedVpns',event.detail.checkedIDs);
         }
     });
 });

</script>

<script>
    function html_table_to_excel(type)
    {
        var data = document.getElementById('Vpn');
        var file = XLSX.utils.table_to_book(data, {sheet: "VPN list"});
        XLSX.write(file, { bookType: type, bookSST: true, type: 'base64' });
        XLSX.writeFile(file, 'VPN-list.' + type);
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
<script>
document.addEventListener('livewire:load', function () {
 $('#upVpn').selectpicker();
})
document.addEventListener('DOMContentLoaded', () => {
    Livewire.hook('element.updating', (fromEl, toEl, component) => {
        console.log('being update'); $('#upVpn').selectpicker('destroy'); })
        Livewire.hook('message.processed', (message, component) => {
            $('#upVpn').selectpicker();
    }) 
});
</script>
</body>
</html>