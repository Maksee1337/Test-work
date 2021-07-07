<script>

    $(document).ready(function () {

        var id = -1;

        $("#Submit").click(function () {
            request = '?action=reg&username='+$("#username").val()+'&pass='+$("#password").val()+'&id='+id;
            //alert(req);
            $.get('ajax.users.php'+request , function (data){

                switch (data){
                    case 'ok':
                        alert('User registered successfully.');
                        document.location.href = 'admin.php?action=administrators';
                        break;
                    case 'edit_ok':
                        alert('User changed successfully.');
                        document.location.href = 'admin.php?action=administrators';
                        break;
                    default:
                        alert(data);
                }
            });
        });

        <?php if($_GET['action']==='editUser'){?>
        id = <?php echo $_GET['id'];?>;
        $.get("ajax.users.php?action=getUsername&id="+<?php echo $_GET['id'];?> , function (data){
            if(data !== 'error') {
                $("#username").val(data);
            }
        });
        <?php }?>

    });
</script>

<h2><?php echo ($_GET['action']==='editUser')?'Edit user':'Create new user';?></h2>
<div>
    Username: <input id="username"><p><p>
        Password: <input id="password"></p>
        <button id="Submit" onclick="register()"><?php echo ($_GET['action']==='editUser')?'Save':'Register';?></button>
</div>

<script>

</script>