<div class="context-block">
<!--header start-->
<div class="box-header"><div class="box-tc"><div class="box-ml"><div class="box-mr"><div class="box-tl"><div class="box-tr">

<h2 class="context-title">{"INI Settings"|i18n('healthcheck')}</h2>
<!--<div class="header-mainline"></div>-->

</div></div></div></div></div></div><!-- header end -->

<!--content start-->
<div class="box-ml"><div class="box-mr"><div class="box-content">
<div class="context-attribute">
<table class="list" cellspacing="0"> 
<tr>
<th class="wide">{"Check"|i18n('healthcheck')}</th>
<th class="tight">{"File"|i18n('healthcheck')}</th>
<th class="tight">{"Block"|i18n('healthcheck')}</th>
<th class="tight">{"Setting"|i18n('healthcheck')}</th>
<th class="tight">{"Test"|i18n('healthcheck')}</th>
<th class="tight">{"Expected"|i18n('healthcheck')}</th>
<th class="tight">{"Actual"|i18n('healthcheck')}</th>
<th class="tight">{"Status"|i18n('healthcheck')}</th>
</tr>

{if ne( $results, false() )}
{sequence name=bgcolour loop=array('bglight', 'bgdark')}
{foreach $results as $result}
<tr class="{$bgcolour:item}">
<td>{$result.friendly_name}</td>
<td>{$result.file_name}</td>
<td>{$result.block_name}</td>
<td>{$result.setting_name}</td>

<td class="nowrap">
{switch match=$result.test_type}
{case match='eq'}
    {"equals"|i18n('healthcheck')}
{/case}
{case match='ne'}
    {"not equal to"|i18n('healthcheck')}
{/case}
{case match='gt'}
    {"greater than"|i18n('healthcheck')}
{/case}
{case match='lt'}
    {"less than"|i18n('healthcheck')}
{/case}
{/switch}
</td>

<td>{$result.expected_value}</td>
<td>{$result.actual_value}</td>
{if eq($result.result, 'pass')}
<td>{"Pass"|i18n('healthcheck')}</td>
{else}
<td>{"Fail"|i18n('healthcheck')}</td>
{/if}
</tr>
{sequence name=bgcolour}
{/foreach}
{else}
<tr>
  <td colspan="8">No tests were defined in healthcheck.ini.</td>
</tr>
{/if}
</table>

</div>
</div></div></div>
<!--content end-->

<!-- Start bottom bar -->
<div class="controlbar">
<div class="box-bc"><div class="box-ml"><div class="box-mr"><div class="box-tc"><div class="box-bl"><div class="box-br">

{def $siteaccesslist=ezini( 'SiteAccessSettings', 'AvailableSiteAccessList' )
     $current_siteaccess=ezpreference('admin_healthcheck_siteaccess')}
<form name="healthchecksiteaccess" action={'healthcheck/inisettings'|ezurl} method="post">
<div class="block">
<label for="siteaccess">Siteaccess:</label>
<select name="SiteAccess"{eq( $ui_context, 'edit' )|choose( '', ' disabled="disabled"' )}>
        <option value="global" {if eq( $current_siteaccess, 'global')} selected="selected"{/if}>Global</option>
{foreach $siteaccesslist as $siteaccess}
        <option value="{$siteaccess}" {if eq( $current_siteaccess, $siteaccess )} selected="selected"{/if}>{$siteaccess|wash}</option>
{/foreach}
</select>
<input class='button' type="submit" name="SetButton" value="Set" />
</div>
</form>

</div></div></div></div></div></div>
</div>
</div>
<!--end bottom bar -->
