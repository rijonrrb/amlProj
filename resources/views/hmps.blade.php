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
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @livewireStyles
</head>
<body>

    <div class="container-fluid" style="margin-top: 45px;">

              <div>
                @include('navbar')
              </div>
              <div style="margin-top: 100px;">
                @livewire('hrs')
                </div>
                <div style="margin-top: 50px;">
                @livewire('miss')
                </div>
                <div style="margin-top: 50px;">
                @livewire('procurements')
                </div>

    </div>
    
    <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @livewireScripts
      <script>

      window.addEventListener('OpenAddHrModal', function(){
      $('.addCountry').find('span').html('');
      $('.addCountry').find('form')[0].reset();
      $('.addCountry').modal('show');
      });
      window.addEventListener('CloseAddHrModal', function(){
      $('.addCountry').find('span').html('');
      $('.addCountry').find('form')[0].reset();
      $('.addCountry').modal('hide');
      Swal.fire(
      'Done!',
      'New DataSet Has been Saved Successfully!',
      'success'
      );
      });

      window.addEventListener('SwalConfirmH', function(event){
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
      window.livewire.emit('delete',event.detail.id,"hr");
      }
      })
      })
      window.addEventListener('deletedH', function(event){
      Swal.fire(
      'Deleted!',
      'Your DataSet has been deleted.',
      'success'
      )
      });
      window.addEventListener('swal:deleteHrs', function(event){
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
      window.livewire.emit('deleteCheckedHrs',event.detail.checkedIDs);
      }
      });
      });

      $.ajaxSetup({
      headers: {
      'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
      }
      });

      $(document).ready(function(){

      //Column Update
      $(document).on('keydown', '.updateHr', function(e){
      if (event.ctrlKey && event.key === "s") {

      e.preventDefault();
      var id = $(this).data("id");
      var column_name = $(this).data("column");
      var value = $(this).text();

      $.ajax({
      url:"{{route('updateHr')}}",
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
      }
      })

      });


      function html_table_to_excel(type)
      {
      var data = document.getElementById('Hrs');

      var file = XLSX.utils.table_to_book(data, {sheet: "Hr & Admin"});

      XLSX.write(file, { bookType: type, bookSST: true, type: 'base64' });

      XLSX.writeFile(file, 'Hr & Admin.' + type);
      }

      const export_button = document.getElementById('export');

      export_button.addEventListener('click', () =>  {
      html_table_to_excel('xlsx');
      });



      document.getElementById("cdept").onclick = function() {
      document.getElementById("idept").style.display = "none";
      document.getElementById("sdept").disabled = false;
      document.getElementById("idept").disabled = true;
      document.getElementById("sdept").style.display = "block";

      document.getElementById("cdept").style.display = "none";
      }


      </script>

<script>

window.addEventListener('OpenAddMissModal', function(){
$('.addM').find('span').html('');
$('.addM').find('form')[0].reset();
$('.addM').modal('show');
});
window.addEventListener('CloseAddMissModal', function(){
$('.addM').find('span').html('');
$('.addM').find('form')[0].reset();
$('.addM').modal('hide');
Swal.fire(
'Done!',
'New DataSet Has been Saved Successfully!',
'success'
);
});
window.addEventListener('SwalConfirmM', function(event){
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
window.livewire.emit('delete',event.detail.id,"miss");
}
})
})
window.addEventListener('deletedM', function(event){
Swal.fire(
'Deleted!',
'Your DataSet has been deleted.',
'success'
)
});
window.addEventListener('swal:deleteMisss', function(event){
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
window.livewire.emit('deleteCheckedMisss',event.detail.checkedIDs);
}
});
});


$(document).ready(function(){

//Column Update
$(document).on('keydown', '.updateMis', function(e){
if (event.ctrlKey && event.key === "s") {

e.preventDefault();
var id = $(this).data("id");
var column_name = $(this).data("column");
var value = $(this).text();

$.ajax({
url:"{{route('updateMis')}}",
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
}
})

});




function table_Mis(type)
{
var data2 = document.getElementById('Miss');

var file2 = XLSX.utils.table_to_book(data2, {sheet: "Mis"});

XLSX.write(file2, { bookType: type, bookSST: true, type: 'base64' });

XLSX.writeFile(file2, 'Mis.' + type);
}

const btn_mis = document.getElementById('exportM');

btn_mis.addEventListener('click', () =>  {
table_Mis('xlsx');
});



document.getElementById("cdeptM").onclick = function() {
      document.getElementById("ideptM").style.display = "none";
      document.getElementById("sdeptM").disabled = false;
      document.getElementById("ideptM").disabled = true;
      document.getElementById("sdeptM").style.display = "block";

      document.getElementById("cdeptM").style.display = "none";
      }



</script>

<script>

window.addEventListener('OpenAddProcurementModal', function(){
$('.addP').find('span').html('');
$('.addP').find('form')[0].reset();
$('.addP').modal('show');
});
window.addEventListener('CloseAddProcurementModal', function(){
$('.addP').find('span').html('');
$('.addP').find('form')[0].reset();
$('.addP').modal('hide');
Swal.fire(
'Done!',
'New DataSet Has been Saved Successfully!',
'success'
);
});

window.addEventListener('SwalConfirmP', function(event){
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
window.livewire.emit('delete',event.detail.id,"proc");
}
})
})
window.addEventListener('deletedP', function(event){
Swal.fire(
'Deleted!',
'Your DataSet has been deleted.',
'success'
)
});
window.addEventListener('swal:deleteProcurements', function(event){
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
window.livewire.emit('deleteCheckedProcurements',event.detail.checkedIDs);
}
});
});


$(document).ready(function(){

//Column Update
$(document).on('keydown', '.updateProc', function(e){
if (event.ctrlKey && event.key === "s") {

e.preventDefault();
var id = $(this).data("id");
var column_name = $(this).data("column");
var value = $(this).text();

$.ajax({
url:"{{route('updateProc')}}",
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
}
})

});



function table_Procurement(type)
{
var data3 = document.getElementById('Procurements');

var file3 = XLSX.utils.table_to_book(data3, {sheet: "Procurement"});

XLSX.write(file3, { bookType: type, bookSST: true, type: 'base64' });

XLSX.writeFile(file3, 'Procurement.' + type);
}

const btn_p = document.getElementById('exportP');

btn_p.addEventListener('click', () =>  {
  table_Procurement('xlsx');
});


document.getElementById("cdeptP").onclick = function() {
      document.getElementById("ideptP").style.display = "none";
      document.getElementById("sdeptP").disabled = false;
      document.getElementById("ideptP").disabled = true;
      document.getElementById("sdeptP").style.display = "block";

      document.getElementById("cdeptP").style.display = "none";
      }



</script>
<script src="{{ asset('js/Opt.js') }}"></script>
<script src="{{ asset('js/Add.js') }}"></script>

</body>
</html>

