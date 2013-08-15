{strip}
<div id="admtreebuildpage">

	<span style="color:red" id="errormessage"></span><br />

	<h1>Adminstration page for builds trees<br /></h1>

	<div id="selectfaction">
	<ul>
		{foreach $aSelectFactionLibelle as $sSelectFactionLibelle}
		<li class="menu"><a href="" id="id_faction_{$sSelectFactionLibelle.idfaction}" class="menu">{$sSelectFactionLibelle.libellefaction}</a></li>
		{/foreach}
	</ul>
	
	</div>

        <div id="showtree">
		<br />2 - show tree<br />
        </div>


</div>
{/strip}
