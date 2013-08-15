{strip}

<div id="divmain">

        {include file='contentleft.tpl'}

        <div id="divmaincenter">

<div id="buildstats">
Build statistics :<br />
{html_table table_attr="class=\"stats\"" loop=$aBuildStats cols="$libellecity,$libellebuild,$number,$buildlevel,$food,$wood,$iron,$stone,$gold,$libelleresearch" }
</div>
<br />
<div id="addbuild">
<span style="color:red" id="errormessage"></span><br />
Add Build :<br />
<select id="SelectBuild">
<option value="">{$select}</option>
{foreach $aSelectBuildLibelle as $sSelectBuildLibelle}
<option value="{$sSelectBuildLibelle.idbuild}">{$sSelectBuildLibelle.libelle}</option>
{/foreach}
</select>
<select id="SelectCity">
<option value="">{$select}</option>
{foreach $aSelectCityLibelle as $sSelectCityLibelle}
<option value="{$sSelectCityLibelle.idcity}">{$sSelectCityLibelle.libellecity}</option>
{/foreach}
</select>
{$number}:<input type="text" name="numberofbuild" id="numberofbuild" />
cost:<input type="text" disabled name="costofbuild" id="costofbuild" />
<input type="submit" value="ok" id="SubButtonAddBuild" /><br />
</div>
<br />
<div id="timeline">
{$timeline}:<br />
<table border="1">
<tr>
<th>{$libellecity}</th>
<th>{$inprogress}</th>
<th>{$number}</th>
<th>{$enddatetot}</th>
<th>{$remainingtimetot}</th>
<th>{$enddatenext}</th>
<th>{$remainingtimenext}</th>
<th>{$cancel}</th>
</tr>
{foreach $atimeline as $dtimeline}
{strip}
<tr>
<td>{$dtimeline.dlibellecity}</td>
<td>{$dtimeline.dlibellebuild}</td>
<td>{$dtimeline.dnumber}</td>
<td>{$dtimeline.denddatetot}</td>
<td>{$dtimeline.dremainingsecondenext}</td>
<td>{$dtimeline.denddatenext}</td>
<td>{$dtimeline.dremainingsecondetot}</td>
<td>X</td>
</tr>
{/strip}
{/foreach}

</table>
</div>
<br /><br /><br />

        </div>

</div>

{include file='messenger.tpl'}

{/strip}
