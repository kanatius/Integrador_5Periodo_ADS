<?php
    $class = "";
    if($mensagem->status == "true"){
        $class = "alert-success";
    }else{
        $class = "alert-danger";
    }
?>
<div class="alert <?php echo $class ?> alert-dismissible fade show " role="alert" id="alert">
        <strong>{{$mensagem->mensagem}}</strong> 
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
</div>

<script>
    setTimeout(function () { 
        // Closing the alert 
        $('#alert').alert('close'); 
    }, 2000); 
</script>