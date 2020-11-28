<% include Syntro\SilverStripeElementalBaseitems\ContentBlock %>

<div class="row justify-content-center text-center">

    <div class="{$ElementName}__list-groupholder col-12">
        <ul class="{$ElementName}__list-group list-group shadow">
            <% loop ListgroupItems %>
                <li class="{$ElementName}__list-group-item list-group-item text-left text-dark">
                    <div class="{$ElementName}__list-group-inner row align-items-center">
                        <% if Image %>
                            <div class="{$ElementName}__list-group-image col-12 col-md-4 col-lg-3 mb-3 mb-md-0">
                                <img src="$Image.Fit(600,600).URL" alt="$Title" class="img-fluid rounded">
                            </div>
                        <% end_if %>
                        <div class="{$ElementName}__list-group-content col">
                            <% if ShowTitle %>
                                <h3 class="{$ElementName}__list-group-title">$Title</h3>
                            <% end_if %>
                            $Content
                            <% if CTALink %>
                                <% with CTALink %>
                                    <a {$IDAttr} class="{$ElementName}__list-group-link mx-1 text-$Up.LinkColor" href="{$LinkURL}"{$TargetAttr}>
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
