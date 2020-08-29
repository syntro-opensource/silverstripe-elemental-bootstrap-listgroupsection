
<div class="py-5 container text-center">
    <div class="row justify-content-center">
        <% if ShowTitle || Content %>
            <div class="col-12 col-md-10 col-lg-8 mb-4">
                <% if ShowTitle %>
                    <h2 class="mb-4">$Title</h2>
                <% end_if %>
                <% if $Content %>
                    <p>$Content</p>
                <% end_if %>
            </div>
        <% end_if %>
        <div class="w-100"></div>

        <div class="col-12">
            <ul class="list-group shadow">
                <% loop ListgroupItems %>
                    <li class="list-group-item text-left text-dark">
                        <div class="row align-items-center">
                            <% if Image %>
                                <div class="col-12 col-md-4 col-lg-3 mb-3 mb-md-0">
                                    <img src="$Image.Fit(600,600).URL" alt="$Title" class="img-fluid rounded">
                                </div>
                            <% end_if %>
                            <div class="col">
                                <% if ShowTitle %>
                                    <h3>$Title</h3>
                                <% end_if %>
                                $Content
                                <% if CTALink %>
                                    <% with CTALink %>
                                        <a {$IDAttr} class="mx-1 text-$Up.LinkColor" href="{$LinkURL}"{$TargetAttr}>
                                            {$Title}
                                        </a>
                                    <% end_with %>
                                <% end_if %>
                            </div>
                        </div>
                    </li>
                <% end_loop %>
            </ul>
        </div>
    </div>
</div>
