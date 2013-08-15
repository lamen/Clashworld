{strip}
<div id="divmain">
	<div id="login">
		{$mail}:<input type="text" name="email" id="email" /><br />
		{$pass}:<input type="password" name="password" id="password" /><br />
		<input type="submit" value="ok" id="SubButton" />
	</div>
</div>

    <div class="container">

      <form class="form-signin">
        <h2 class="form-signin-heading">Please sign in</h2>
	<span style="color:red" id="errormessage"></span><br />
        <input type="text" class="input-block-level" id="email" placeholder="{$mail}">
        <input type="password" class="input-block-level" id="password" placeholder="{$pass}">
        <label class="checkbox">
          <input type="checkbox" value="remember-me"> Remember me
        </label>
        <button class="btn btn-large btn-primary" type="submit" id="SubButton">Sign in</button>
      </form>

    </div>
{/strip}
