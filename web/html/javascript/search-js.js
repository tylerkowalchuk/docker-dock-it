$(document).ready(function(){
    $('#search').on('keyup', function(e){
        //get value of input
        let searchTerm =  $('#search').val();
        //$(this).val();

        $.get(
            //url
            'customer-search-results.php',
            //data/params
            {
                //'search' is the input name whereas search term is the value
                // (needs to match $_GET['search'])
                search: searchTerm,
                start: 0
            },
            //what to do when the result is returned from the server
            function(data){
                //data is what is returned from the server
                $('#customerResults').html(data);

                paginationAjax();
            },
            //return typ
            'html'
        )
    });

   paginationAjax();
})

function paginationAjax(){
    $('.page-link').on('click', function(e){
        e.preventDefault();

        //get value of input
        let searchTerm =  $('#search').val();
        //$(this).val();

        $.get(
            //url
            'customer-search-results.php' + this.href.substr(this.href.indexOf('?')),
            //data/params
            {
                //'search' is the input name whereas search term is the value
                // (needs to match $_GET['search'])
                search: searchTerm,
            },
            //what to do when the result is returned from the server
            function(data){
                //data is what is returned from the server
                $('#customerResults').html(data);

                paginationAjax();
            },
            //return typ
            'html'
        )
    });
}