
<?php 
    $notif = session()->getFlashdata('notif');
    if($notif){
        if($notif['status']=='success'){
            $icon = 'fas fa-check-circle';
            $bg = 'green';
        }
        else if($notif['status']=='info'){
            $icon = 'fas fa-info-circle';
            $bg = 'blue';
        }else{
            $icon = 'fas fa-times-circle';
            $bg = 'red';
        }

        ?>
<script>
    const notyf = new Notyf({
        position: {
            x: 'right',
            y: 'top',
        },
        types: [
            {
                type: '<?= $notif['status']?>',
                background: '<?= $bg?>',
                icon: {
                    className: '<?= $icon?>',
                    tagName: 'span',
                    color: '#fff'
                },
                dismissible: false
            }
        ]
    })
    notyf.open({
    type: '<?= $notif['status']?>',
    message: '<?= $notif['message']?>'
});
</script>        
        <?php
    }
?>

