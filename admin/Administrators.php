<div  id="UsersTable">
</div>
<script>
    function LoadTable(page = 0){
        $.get( "ajax.Users.php?action=getUsersList",  function( data ) {
            //alert(data);
            $("#UsersTable").html(data);
        });
    }
    LoadTable();

  function DeleteUser(id){
        if(confirm("Do you really want to delete this user?")){
            $.get( "ajax.users.php?action=delete&id="+id,  function( data ) {
                if(data == 'delete 1') {
                    alert('User successfully deleted');
                    LoadTable();
                }else {
                    alert('Error');
                }
            });
        }
    }
</script>