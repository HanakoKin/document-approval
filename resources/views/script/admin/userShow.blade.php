<script>
    // Script JavaScript
    function showUserModal(user) {
        var title = "Data : " + user.name;

        console.log(user.name);

        $('#showTitle').text(title);
        $('#namaTitle').text(user.name);
        $('#unitTitle').text(user.unit);
        $('#nama').text(user.name);
        $('#username').text(user.username);
        $('#unit').text(user.unit);


        $('#showUser').modal('show');
    }
</script>
