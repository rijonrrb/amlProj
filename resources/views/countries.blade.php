<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>AMLBD</title>
    <link rel="icon" type="image/x-icon" href="http://www.amlbd.com/wp-content/uploads/2014/05/new-way-to-manage1.png">
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    @livewireStyles
</head>
<body>

    <div class="container" style="margin-top: 45px">

                <h4 style="color:blue;text-align:center; margin-bottom: 45px;"><b>Igloo CHO</b></h4>
                @livewire('countries')

    </div>
    

    <script src="{{ asset('jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @livewireScripts
    <script>
           window.addEventListener('OpenAddCountryModal', function(){
                $('.addCountry').find('span').html('');
                $('.addCountry').find('form')[0].reset();
                $('.addCountry').modal('show');
           });

           window.addEventListener('CloseAddCountryModal', function(){
               $('.addCountry').find('span').html('');
               $('.addCountry').find('form')[0].reset();
               $('.addCountry').modal('hide');
               Swal.fire(
               'Done!',
               'New DataSet Has been Saved Successfully!',
               'success'
               );
           });

           window.addEventListener('OpenEditCountryModal', function(event){
               $('.editCountry').find('span').html('');
               $('.editCountry').modal('show');
           });

           window.addEventListener('CloseEditCountryModal', function(event){
               $('.editCountry').find('span').html('');
               $('.editCountry').find('form')[0].reset();
               $('.editCountry').modal('hide');
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

           window.addEventListener('swal:deleteCountries', function(event){

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
                       window.livewire.emit('deleteCheckedCountries',event.detail.checkedIDs);
                   }
               });
           });

    </script>
</body>
</html>