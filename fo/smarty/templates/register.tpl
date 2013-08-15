{strip}
<div id="divmain">
<div id="register">
<fieldset class="fieldsetregister">
<legend>Create your account</legend>
<span style="color:red" id="errormessage"></span><br />
<label for="pseudo">{$pseudo}:</label><input type="text" name="pseudo" id="pseudo" /><br />
{$mail}:<input type="text" name="email" id="email" /><br />
{$pass}:<input type="password" name="password" id="password" /><br />
{$confirmpass}:<input type="password" name="confirmpass" id="confirmpass" /><br />
faction:<select id="faction"><option value="">{$select}</option>
{foreach $aSelectFactionLibelle as $sSelectFactionLibelle}
<option value="{$sSelectFactionLibelle.idfaction}">{$sSelectFactionLibelle.libellefaction}</option>
{/foreach}
</select>
<br />
<div id="recaptcha_div"></div>
{$recaptcha}
<input type="submit" value="{$registerbutton}" id="registerbutton" /><br />
</fieldset>
</div>
</div>
{/strip}
