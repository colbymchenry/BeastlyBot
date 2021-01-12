<script type="text/javascript">
    if(window.location.href.includes('{{ Request::path() }}')) {
        document.body.innerHTML = '<input type="button" value="Back" onclick=\"window.history.back()\" /> This page is blocked. Please upgrade your browser and go back to try again.';
    };
</script>