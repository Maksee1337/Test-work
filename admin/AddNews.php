<script>

    $(document).ready(function () {
        var options = {
            width: 600,
            height: 300,
            controls: "bold italic underline strikethrough subscript superscript | font size " +
                "style | color highlight removeformat | bullets numbering | outdent " +
                "indent | alignleft center alignright justify | undo redo | " +
                "rule link image unlink | cut copy paste pastetext | print source"
        };

        var editor = $("#editor").cleditor(options)[0];
        var id = -1;
        $("#btnClear").click(function (e) {
            e.preventDefault();
            editor.focus();
            editor.clear();
        });

        $("#btnAddImage").click(function () {
            editor.execCommand("insertimage", "http://images.free-extras.com/pics/s/smile-1620.JPG", null, null)
            editor.focus();
        });

        $("#btnGetHtml").click(function () {
            alert($("#editor").val());
        });

        $("#Submit").click(function () {
       //     alert($("#editor").val());
          //  formData = 'Full='+btoa($("#editor").val())+'&Title='+btoa($("#Title").val())+'&Short='+btoa($("#Short").val());
            formData = 'Full='+btoa(encodeURIComponent($("#editor").val()))
                      +'&Title='+btoa(encodeURIComponent($("#Title").val()))
                    +'&Short='+btoa(encodeURIComponent($("#Short").val()))
                    +'&id='+id;
            //alert(formData);
            $.post( "ajax.addnews.php", formData, function( data ) {
               // alert(data);
                    switch (data){
                        case 'ok':
                            alert('Запись успешно добавленна.');
                            document.location.href = 'admin.php';
                        break;
                        case 'edit_ok':
                            alert('Запись успешно изменена.');
                            document.location.href = 'admin.php';
                        break;
                        default:
                            alert('Ошибка. Проверьте данные.');
                    }
                 });
             });

            <?php if($_GET['action']==='edit'){?>
                id = <?php echo $_GET['id'];?>;
                $.get("ajax.getNews.php?action=getNews&id="+<?php echo $_GET['id'];?> , function (data){
                if(data !== 'error') {
                    arr = jQuery.parseJSON(data);
                    $("#Title").val(decodeURIComponent(atob(arr[0].Title)));
                    $("#Short").val(decodeURIComponent(atob(arr[0].ShortDescription)));
                    $("#editor").text(decodeURIComponent(atob(arr[0].FullDescription))).blur();
                  }
               });
            <?php }?>

        });
</script>


<form id="addNewsForm">
    <h2><?php echo ($_GET['action']==='edit')?'Edit News':'Add News';?></h2>
    <div style="width: 600px">
        <h4>Title</h4> <input style="width: 600px" id="Title" > <p>
        <h4>Short Description</h4> <input style="width: 600px" id="Short"> <p>
        <h4>Full Description</h4>
        <div>
            <textarea input id="editor" rows="0" cols="0"> </textarea>
        </div>

        <div class="normaldiv" style="float: right">
            <a href="#" class="siteButton" id="btnClear">Clear</a>
            <button class="siteButton" id="Submit" type="button"><?php echo ($_GET['action']==='edit')?'Save':'Submit';?></button>
        </div>
    </div>
</form>

