    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../js/bootstrap.min.js"></script>
    <script>
$(document).ready(function () {
            
            //CK Editor
    ClassicEditor
        .create( document.querySelector( '#body' ) )
        .catch( error => {
            console.error( error );
        } );
    $('#selectAllBoxes').click(function(event){
        if(this.checked){
            $('.checkBoxes').each(function(){
                this.checked = true;
            });
        } else {
            $('.checkBoxes').each(function(){
                this.checked = false;
            });
        }
    });
    
});
</script>

</body>

</html>