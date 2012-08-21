function destroyDialog() {
    $(".dialog-inner").dialog("destroy");
}

$(".mylist").click(function(){
    openMyList();
});

function openMyList() {
    var html = $.get("mylist.php", function(html) {
        $(".dlg-mylist")
            .html(html)
            .dialog({
                modal: true,
                show: { effect: 'drop', direction: "up" },
                open: onOpenMyList
            });
    });
}

function openSignIn() {
    var html = $.get("signin.php", function(html) {
        $(".dlg-signin")
            .html(html)
            .dialog({
                modal: true,
                show: { effect: 'drop', direction: "up" },
                open: onOpenSignIn
            });
    });
}
function onOpenMyList() {
    $(".save-list").click(function(){
        openSignIn();
    });
}

function onOpenSignIn() {
    $(".btn-signin-submit").click(function(){
        openMyList();
    });
}