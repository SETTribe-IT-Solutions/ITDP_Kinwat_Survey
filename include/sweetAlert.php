<?php
session_start();
function setSession($status, $msg){
    $_SESSION['status'] = $status;
    $_SESSION['msg'] = $msg;
}
?>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })
</script>
<?php
function toastMsg($status, $msg){
?>
<script>
    Toast.fire({
        icon: '<?php echo $status ?>',
        text: '<?php echo $msg ?>'
    })
</script>
<?php
}

function sweetAlertMsg($status, $msg){
?>
<script>
    Swal.fire({
        icon: '<?php echo $status ?>',
        text: '<?php echo $msg ?>'
    })
</script>
<?php
}
?>
<script>
    function deletefun(location, id){
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location = location+"?delete="+id;
            }
        })
    }
    
    function loginfun(location){
        Swal.fire({
            title: 'Are you sure?',
            text: "You want to Log Out!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Log Out!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location = location;
            }
        })
    }
    
    function addMember(familyId, page){
        var status;
        Swal.fire({
            title: 'परिवारातील सदस्य नोंदणी करायची आहे का?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'होय',
            cancelButtonText: 'नाही'
        }).then((result) => {   
            if (result.isConfirmed) {
                window.location = page+'?familyId='+familyId+"&member=";
                // status = true;
            } else {
                window.location='family-report';
                // status = false;
            }
        });
        
        // return status;
    }
</script>