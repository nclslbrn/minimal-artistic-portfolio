import { registerPlugin } from "@wordpress/plugins";
import { PluginSidebar, PluginSidebarMoreMenuItem } from "@wordpress/edit-post";
import { __ } from "@wordpress/i18n";
import { PanelBody, TextControl } from "@wordpress/components";

registerPlugin( 'myprefix-sidebar', {
    icon: 'calendar-alt',
    render: () => {
        return (
            <>
                <PluginSidebarMoreMenuItem
                    target="myprefix-sidebar"
                >
                    {__('Meta Options', 'textdomain')}
                </PluginSidebarMoreMenuItem>
                <PluginSidebar
                    title={__('Meta Options', 'textdomain')}
                >
                    Some Content
                </PluginSidebar>
            </>
        )
    }
})