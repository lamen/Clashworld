{strip}

<div id="divmain">

        {include file='contentleft.tpl'}

        <div id="divmaincenter">

		<div id="warstats">
		War statistics :<br />
		{html_table table_attr="class=\"stats\"" loop=$aWarStats cols="$libellecity,$libellegender,$number,$level,$attack,$specialattack,$defense,$specialdefense,$carry"}
		</div>

        </div>

</div>


{include file='messenger.tpl'}

{/strip}
