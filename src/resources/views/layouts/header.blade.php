<div class=siteHeader>
  <div class="siteHeader-buttonarea">
    <section class="siteHeader-section">
      <div class="siteHeader-home"><a class="fix" href="/home">Imgupp</a></div>
    </section>
    <section class="siteHeader-section">
@if ($is_loggedin)
      <div class="siteHeader-button"><a class="fix" href="/logout"><span class="typcn typcn-user-outline"></span> Logout</a></div>
@else
      <div class="siteHeader-button"><a class="fix" href="/login"><span class="typcn typcn-user"></span> Login</a></div>
@endif
      <div class="siteHeader-button"><a class="fix" href="/post"><span class="typcn typcn-pen"></span> Post</a></div>
    </section>
  </div>
</div>
