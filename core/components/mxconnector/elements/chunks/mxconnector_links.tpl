<ul>
    {foreach $links as $link}
        <li><a href="{$link.slave_id | url}">{$link.slave_pagetitle}</a></li>
    {/foreach}
</ul>
