{strip}
<br />

<div id="footer">
	<div class="container">
		<a href="http://validator.w3.org/check?uri={$uri}">w3c compliant</a>
	</div>
</div>

<script>
$LAB
{foreach from=$jsfile item=foo}
{if $foo|truncate:7:""=='http://'}.script("{$foo}").wait()
{else}.script("/fo/static/{$foo}").wait()
{/if}
{/foreach}
</script>

</body>
</html>
{/strip}
