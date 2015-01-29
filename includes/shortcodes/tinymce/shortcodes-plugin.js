/**
 * TinyMCE plugin for shortcodes
 *
 * @package tsatu
 */

(function() {
    tinymce.create('tinymce.plugins.Tsatu', {
        /**
         * Initializes the plugin, this will be executed after the plugin has been created.
         * This call is done before the editor instance has finished it's initialization so use the onInit event
         * of the editor instance to intercept that event.
         *
         * @param {tinymce.Editor} ed Editor instance that the plugin is initialized in.
         * @param {string} url Absolute URL to where the plugin is located.
         */
        init : function(ed, url) {
            ed.addButton('tsatu_shortcodes', {
                title : 'Shortcodes',
                type: 'menubutton',
                image : url + '/shortcode-icon.png',
                menu: [
                    {
                        text: 'Structure',
                        menu: [
                            {
                                text: 'Grid',
                                onclick: function() {
                                    tinymce.activeEditor.windowManager.open({
                                        title: 'Custom Grid',
                                        url: url + '/grid.php',
                                        width: 760,
                                        height: 580
                                    });
                                }
                            },
                            {
                                text: 'Table',
                                value: 'Text from sub sub menu',
                                onclick: function(e) { e.stopPropagation(); ed.insertContent(this.value()); }
                            }
                        ]
                    },
                    {
                        text: 'Components',
                        menu: [
                            {
                                text: 'Button',
                                onclick: function() {
                                    ed.windowManager.open( {
                                        title: 'Insert button',
                                        body: [
                                            {
                                                type: 'textbox',
                                                name: 'title',
                                                label: 'Title',
                                            },
                                            {
                                                type: 'listbox',
                                                name: 'type',
                                                label: 'Type',
                                                values: [
                                                    {text: 'Default', value: 'default'},
                                                    {text: 'Primary', value: 'primary'},
                                                    {text: 'Success', value: 'success'},
                                                    {text: 'Info', value: 'info'},
                                                    {text: 'Warning', value: 'warning'},
                                                    {text: 'Danger', value: 'danger'},
                                                    {text: 'Link', value: 'link'}
                                                ]
                                            },
                                            {
                                                type: 'listbox',
                                                name: 'size',
                                                label: 'Size',
                                                values: [
                                                    {text: 'Default', value: 'default'},
                                                    {text: 'Large', value: 'lg'},
                                                    {text: 'Small', value: 'sm'},
                                                    {text: 'Extra small', value: 'xs'}
                                                ]
                                            }
                                            
                                        ],
                                        onsubmit: function(e) {
                                            ed.insertContent( '[button type="' + e.data.type + '" size="' + e.data.size + '"]' + e.data.title + '<br class="nc"/>[/button]');
                                        }
                                    });
                                }
                            },
                            {
                                text: 'Icon',
                                onclick: function() {
                                    tinymce.activeEditor.windowManager.open({
                                        title: 'Insert icon',
                                        url: url + '/icons.php',
                                        width: 760,
                                        height: 580
                                    });
                                }
                            },
                            {
                                text: 'Alert',
                                onclick: function() {
                                    ed.windowManager.open( {
                                        title: 'Insert alert',
                                        body: [
                                            {
                                                type: 'textbox',
                                                name: 'title',
                                                label: 'Title'
                                            },
                                            {
                                                type: 'listbox',
                                                name: 'type',
                                                label: 'Type',
                                                values: [
                                                    {text: 'Success', value: 'success'},
                                                    {text: 'Info', value: 'info'},
                                                    {text: 'Warning', value: 'warning'},
                                                    {text: 'Danger', value: 'danger'}
                                                ]
                                            }
                                        ],
                                        onsubmit: function(e) {
                                            ed.insertContent( '[alert type="' + e.data.type + '"]' + e.data.title + '[/alert]');
                                        }
                                    });
                                }
                            },
                            {
                                text: 'Label',
                                onclick: function() {
                                    ed.windowManager.open( {
                                        title: 'Insert label',
                                        body: [
                                            {
                                                type: 'textbox',
                                                name: 'title',
                                                label: 'Title'
                                            },
                                            {
                                                type: 'listbox',
                                                name: 'type',
                                                label: 'Type',
                                                values: [
                                                    {text: 'Default', value: 'default'},
                                                    {text: 'Primary', value: 'primary'},
                                                    {text: 'Success', value: 'success'},
                                                    {text: 'Info', value: 'info'},
                                                    {text: 'Warning', value: 'warning'},
                                                    {text: 'Danger', value: 'danger'}
                                                ]
                                            }
                                        ],
                                        onsubmit: function(e) {
                                            ed.insertContent( '[label type="' + e.data.type + '"]' + e.data.title + '[/label]');
                                        }
                                    });
                                }
                            },
                            {
                                text: 'Lead',
                                onclick: function() {
                                    ed.windowManager.open( {
                                        title: 'Insert lead',
                                        body: [
                                            {
                                                type: 'textbox',
                                                name: 'title',
                                                label: 'Title'
                                            }
                                        ],
                                        onsubmit: function(e) {
                                            ed.insertContent( '[lead]' + e.data.title + '[/lead]');
                                        }
                                    });
                                }
                            },
                            {
                                text: 'Progress Bar',
                                onclick: function() {
                                    ed.windowManager.open( {
                                        title: 'Insert progress bar',
                                        body: [
                                            {
                                                type: 'textbox',
                                                name: 'percent',
                                                label: 'Percentage'
                                            },
                                            {
                                                type: 'listbox',
                                                name: 'type',
                                                label: 'Type',
                                                values: [
                                                    {text: 'Default', value: 'default'},
                                                    {text: 'Success', value: 'success'},
                                                    {text: 'Info', value: 'info'},
                                                    {text: 'Warning', value: 'warning'},
                                                    {text: 'Danger', value: 'danger'}
                                                ]
                                            }
                                            
                                        ],
                                        onsubmit: function(e) {
                                            ed.insertContent( '[progressbar percent="' + e.data.percent + '" type="' + e.data.type + '"/]');
                                        }
                                    });
                                }
                            },
                            {
                                text: 'Well',
                                onclick: function() {
                                    ed.windowManager.open( {
                                        title: 'Insert well',
                                        body: [
                                            {
                                                type: 'textbox',
                                                name: 'title',
                                                label: 'Title',
                                            },
                                            {
                                                type: 'listbox',
                                                name: 'size',
                                                label: 'Size',
                                                values: [
                                                    {text: 'Default', value: 'default'},
                                                    {text: 'Large', value: 'lg'},
                                                    {text: 'Small', value: 'sm'},
                                                    {text: 'Extra small', value: 'xs'}
                                                ]
                                            }
                                            
                                        ],
                                        onsubmit: function(e) {
                                            ed.insertContent( '[well size="' + e.data.size + '"]' + e.data.title + '[/button]');
                                        }
                                    });
                                }
                            },
                            {
                                text: 'Panel',
                                onclick: function() {
                                    ed.windowManager.open( {
                                        title: 'Insert panel',
                                        body: [
                                            {
                                                type: 'textbox',
                                                name: 'title',
                                                label: 'Title'
                                            },
                                            {
                                                type: 'listbox',
                                                name: 'type',
                                                label: 'Type',
                                                values: [
                                                    {text: 'Default', value: 'default'},
                                                    {text: 'Primary', value: 'primary'},
                                                    {text: 'Success', value: 'success'},
                                                    {text: 'Info', value: 'info'},
                                                    {text: 'Warning', value: 'warning'},
                                                    {text: 'Danger', value: 'danger'}
                                                ]
                                            },
                                            {
                                                type: 'textbox',
                                                name: 'content',
                                                label: 'Content'
                                            }
                                        ],
                                        onsubmit: function(e) {
                                            ed.insertContent( '[panel title="' + e.data.title + '" type="' + e.data.type + '"]' + e.data.content + '[/panel]');
                                        }
                                    });
                                }
                            },
                            {
                                text: 'Call to Action',
                                onclick: function() {
                                    ed.windowManager.open( {
                                        title: 'Insert call to action',
                                        body: [
                                            {
                                                type: 'textbox',
                                                name: 'title',
                                                label: 'Title'
                                            },
                                            {
                                                type: 'textbox',
                                                name: 'button',
                                                label: 'Button'
                                            },
                                            {
                                                type: 'textbox',
                                                name: 'href',
                                                label: 'Link'
                                            },
                                            {
                                                type: 'textbox',
                                                name: 'content',
                                                label: 'Content'
                                            }
                                        ],
                                        onsubmit: function(e) {
                                            ed.insertContent('[cta title="' + e.data.title + '" button="' + e.data.button + '" href="' + e.data.href + '"]' + e.data.content + '[/cta]');
                                        }
                                    });
                                }
                            }
                            
                        ]
                    },
                    {
                        text: 'Active Components',
                        menu: [
                            {
                                text: 'Tabs',
                                onclick: function() {
                                    ed.windowManager.open( {
                                        title: 'Insert tabs',
                                        body: [
                                            {
                                                type: 'textbox',
                                                name: 'title',
                                                label: 'Title'
                                            }
                                        ],
                                        onsubmit: function(e) {
                                            ed.insertContent( '[tabs]' + e.data.content + '[/tabs]');
                                        }
                                    });
                                }
                            },
                            {
                                text: 'Collapse',
                                onclick: function() {
                                    ed.windowManager.open( {
                                        title: 'Insert collapse',
                                        body: [
                                            {
                                                type: 'textbox',
                                                name: 'title',
                                                label: 'Title'
                                            }
                                        ],
                                        onsubmit: function(e) {
                                            ed.insertContent( '[tabs]' + e.data.content + '[/tabs]');
                                        }
                                    });
                                }
                            },
                            {
                                text: 'Accordion',
                                onclick: function() {
                                    ed.windowManager.open( {
                                        title: 'Insert accordion',
                                        body: [
                                            {
                                                type: 'textbox',
                                                name: 'title',
                                                label: 'Title'
                                            }
                                        ],
                                        onsubmit: function(e) {
                                            ed.insertContent( '[tabs]' + e.data.content + '[/tabs]');
                                        }
                                    });
                                }
                            },
                            {
                                text: 'Tooltip',
                                onclick: function() {
                                    ed.windowManager.open( {
                                        title: 'Insert tooltip',
                                        body: [
                                            {
                                                type: 'textbox',
                                                name: 'content',
                                                label: 'Content'
                                            },
                                            {
                                                type: 'listbox',
                                                name: 'placement',
                                                label: 'Placement',
                                                values: [
                                                    {text: 'Top', value: 'top'},
                                                    {text: 'Right', value: 'right'},
                                                    {text: 'Bottom', value: 'bottom'},
                                                    {text: 'Left', value: 'left'}
                                                ]
                                            },
                                            {
                                                type: 'listbox',
                                                name: 'trigger',
                                                label: 'Trigger',
                                                values: [
                                                    {text: 'Hover', value: 'hover'},
                                                    {text: 'Click', value: 'click'},
                                                    {text: 'Focus', value: 'focus'}
                                                ]
                                            }
                                        ],
                                        onsubmit: function(e) {
                                            ed.insertContent( '[tooltip placement="' + e.data.placement + '" trigger="' + e.data.trigger + '"]' + e.data.content + '[/tooltip]');
                                        }
                                    });
                                }
                            },
                            {
                                text: 'Map',
                                onclick: function() {
                                    ed.windowManager.open( {
                                        title: 'Insert map',
                                        body: [
                                            {
                                                type: 'textbox',
                                                name: 'title',
                                                label: 'Title'
                                            },
                                            {
                                                type: 'textbox',
                                                name: 'info',
                                                label: 'Info windows'
                                            },
                                            {
                                                type: 'textbox',
                                                name: 'address',
                                                label: 'Address'
                                            },
                                            {
                                                type: 'textbox',
                                                name: 'lat',
                                                label: 'Latitude'
                                            },
                                            {
                                                type: 'textbox',
                                                name: 'lng',
                                                label: 'Longtitude'
                                            },
                                            {
                                                type: 'textbox',
                                                name: 'zoom',
                                                label: 'Zoom'
                                            }
                                        ],
                                        onsubmit: function(e) {
                                            ed.insertContent( '[map address="' + e.data.address + '"' );
                                            if ((e.data.lat !== '') && (e.data.lng !== '')) {
                                                ed.insertContent( ' lat="' + e.data.lat + '" lng="' + e.data.lng + '"');
                                            }
                                            if (e.data.title !== '') {
                                                ed.insertContent( ' title="' + e.data.title  + '"');
                                            }
                                            if (e.data.zoom !== '') {
                                                ed.insertContent( ' zoom="' + e.data.zoom  + '"');
                                            }
                                            if (e.data.info !== '') {
                                                ed.insertContent( ' marker=1 infowindow=1]' + e.data.info + '[/map]<br class="nc"/>' );
                                            } else {
                                                ed.insertContent( '/]<br class="nc"/>' );
                                            }
                                        }
                                    });
                                }
                            }
                        ]
                    }
                ]
            });
        },

        /**
         * Creates control instances based in the incomming name. This method is normally not
         * needed since the addButton method of the tinymce.Editor class is a more easy way of adding buttons
         * but you sometimes need to create more complex controls like listboxes, split buttons etc then this
         * method can be used to create those.
         *
         * @param {String} n Name of the control to create.
         * @param {tinymce.ControlManager} cm Control manager to use inorder to create new control.
         * @return {tinymce.ui.Control} New control instance or null if no control was created.
         */
        createControl : function(n, cm) {
            return null;
        },

        /**
         * Returns information about the plugin as a name/value array.
         * The current keys are longname, author, authorurl, infourl and version.
         *
         * @return {Object} Name/value array containing information about the plugin.
         */
        getInfo : function() {
            return {
                longname : 'Shortcodes Buttons',
                author : 'Andrii Ryzhkov',
                authorurl : 'https://github.com/andriiryzhkov/',
                infourl : 'https://github.com/andriiryzhkov/tsatu/',
                version : "0.1"
            };
        }
    });

    // Register plugin
    tinymce.PluginManager.add( 'tsatu', tinymce.plugins.Tsatu );
})();