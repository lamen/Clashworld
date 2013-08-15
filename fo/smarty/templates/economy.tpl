{strip}

<div id="divmain">

        {include file='contentleft.tpl'}

        <div id="divmaincenter">

		<div id="economystats">
		Economy statistics :<br />
		{html_table table_attr="class=\"stats\"" loop=$aResourcesStats cols="$food,$wood,$iron,$stone,$gold,$libellecity" }
		</div>

        </div>

</div>

{include file='messenger.tpl'}

{/strip}
