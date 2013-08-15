{strip}

<div id="divmain">

	{include file='contentleft.tpl'}

	<div id="divmaincenter">


		<div id="economystats">
		Economy statistics :<br />
		{html_table loop=$aResourcesStats cols="$food,$wood,$iron,$stone,$gold,$libellecity" }
		</div>

		<br />

		<div id="buildstats">
		Build statistics :<br />
		{html_table loop=$aBuildStats cols="$libellecity,$libellebuild,$number,$buildlevel,$food,$wood,$iron,$stone,$gold,$libelleresearch" }
		</div>
	
		<br />
	
		<div id="warstats">
		War statistics :<br />
		{html_table loop=$aWarStats cols="$libellecity,$libellegender,$number,$level,$attack,$specialattack,$defense,$specialdefense,$carry"}
		</div>

	</div>

</div>

{include file='messenger.tpl'}

{/strip}
