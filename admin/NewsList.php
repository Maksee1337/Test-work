<div  id="NewsTable">
</div>
<script>
      function LoadTable(page = 0){
          $.get( "ajax.getNews.php?action=getNewsList",  function( data ) {
              //alert(data);
              $("#NewsTable").html(data);
          });
      }
      LoadTable();

      function DeleteNews(id){
          if(confirm("Do you really want to delete this news?")){
              $.get( "ajax.addnews.php?action=delete&id="+id,  function( data ) {

                  if(data == 'delete 1') {
                      alert('News successfully deleted');
                      LoadTable();
                  }else {
                        alert('Error');
                  }
              });
          }
      }
</script>