@push('scripts')
<script type="text/javascript">
    document.getElementsByTagName("body")[0].style.cursor = "url(' {{ asset('/css/png/001-mouse.png') }}'), auto";
    if (typeof(document.getElementsByTagName("label")[0]) != 'undefined' && document.getElementsByTagName("label")[0] != null)
    {
        for(var i = 0; i < document.getElementsByTagName("label").length; i += 1)
        {
            document.getElementsByTagName("label")[i].style.cursor = "url('{{asset('/css/png/001-mouse.png')}}'), auto";
        }
    }
    if (typeof(document.getElementsByTagName("button")[0]) != 'undefined' && document.getElementsByTagName("button")[0] != null)
    {
        for(var i = 0; i < document.getElementsByTagName("button").length; i += 1)
        {
            document.getElementsByTagName("button")[i].style.cursor = "url('{{asset('/css/png/004-touch.png')}}'), auto";
        }
    }
    if (typeof(document.getElementsByTagName("li")[0]) != 'undefined' && document.getElementsByTagName("li")[0] != null)
    {
        for(var i = 0; i < document.getElementsByTagName("li").length; i += 1)
        {
            document.getElementsByTagName("li")[i].style.cursor = "url('{{asset('/css/png/004-touch.png')}}'), auto";
        }
    }
    if (typeof(document.getElementsByTagName("a")[0]) != 'undefined' && document.getElementsByTagName("a")[0] != null)
    {
        for(var i = 0; i < document.getElementsByTagName("a").length; i += 1)
        {
            document.getElementsByTagName("a")[i].style.cursor = "url('{{asset('/css/png/004-touch.png')}}'), auto";
        }
    }
</script>
@endpush
