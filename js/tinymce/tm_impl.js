tinyMCE.init({
    theme : "advanced",
    mode: "exact",
    elements : "textcontent",
    theme_advanced_toolbar_location : "top",
    theme_advanced_buttons1 : "bold,italic,underline,strikethrough,separator,"
    + "justifyleft,justifycenter,justifyright,justifyfull,formatselect,"
    + "bullist,numlist,outdent,indent",
    theme_advanced_buttons2 : "link,unlink,anchor,image,separator,"
    +"undo,redo,cleanup,code,separator,sub,sup,charmap",
    theme_advanced_buttons3 : "",
    height:"600px",
    width:"100%",
    file_browser_callback : 'myFileBrowser',
    external_link_list_url :
    "include/_filebrowser.php?output=js&type=file",
    external_image_list_url :
    "include/_filebrowser.php?output=js&type=image",

  });

  function myFileBrowser (field_name, url, type, win) {
    alert("Field_Name: " + field_name + "\nURL: " + url + "\nType: " + type + "\nWin: " + win); // debug/testing

    /* If you work with sessions in PHP and your client doesn't accept cookies you might need to carry
       the session name and session ID in the request string (can look like this: "?PHPSESSID=88p0n70s9dsknra96qhuk6etm5").
       These lines of code extract the necessary parameters and add them back to the filebrowser URL again. */
    
    var url  = cmsURL  + "?type=" + type;  

    tinyMCE.activeEditor.windowManager.open({
        file : url,
        title : 'Dateibrowser',
        width : 600,  // Your dimensions may differ - toy around with them!
        height : 600,
        resizable : "yes",
        inline : "yes",  // This parameter only has an effect if you use the inlinepopups plugin!
        close_previous : "true"
    }, {
        window : win,
        input : field_name
    });
    return false;
  }