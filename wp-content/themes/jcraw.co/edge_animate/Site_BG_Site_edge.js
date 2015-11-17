/*jslint */
/*global AdobeEdge: false, window: false, document: false, console:false, alert: false */
(function (compId) {

    "use strict";
    var im='images/',
        aud='media/',
        vid='media/',
        js='js/',
        fonts = {
        },
        opts = {
            'gAudioPreloadPreference': 'auto',
            'gVideoPreloadPreference': 'auto'
        },
        resources = [
        ],
        scripts = [
            js+"jquery-1.7.1.min.js"
        ],
        symbols = {
            "stage": {
                version: "6.0.0",
                minimumCompatibleVersion: "5.0.0",
                build: "6.0.0.400",
                scaleToFit: "width",
                centerStage: "none",
                resizeInstances: false,
                content: {
                    dom: [
                        {
                            id: 'circle-01',
                            display: 'none',
                            type: 'image',
                            rect: ['0px', '-524px', '2035px', '2388px', 'auto', 'auto'],
                            overflow: 'hidden',
                            opacity: '1',
                            fill: ["rgba(0,0,0,0)",im+"circle-01.svg",'0px','0px']
                        },
                        {
                            id: 'square-01',
                            display: 'none',
                            type: 'image',
                            rect: ['0px', '428px', '2035px', '2388px', 'auto', 'auto'],
                            overflow: 'hidden',
                            opacity: '1',
                            fill: ["rgba(0,0,0,0)",im+"square-01.svg",'0px','0px']
                        },
                        {
                            id: 'triangle-01',
                            display: 'none',
                            type: 'image',
                            rect: ['0px', '-288px', '2035px', '2388px', 'auto', 'auto'],
                            overflow: 'hidden',
                            opacity: '1',
                            fill: ["rgba(0,0,0,0)",im+"triangle-01.svg",'0px','0px']
                        },
                        {
                            id: 'all2',
                            type: 'image',
                            rect: ['0px', '0px', '2035px', '2388px', 'auto', 'auto'],
                            opacity: '1',
                            fill: ["rgba(0,0,0,0)",im+"all.svg",'0px','0px']
                        }
                    ],
                    style: {
                        '${Stage}': {
                            isStage: true,
                            rect: ['null', 'null', '1600px', '2200px', 'auto', 'auto'],
                            overflow: 'hidden',
                            fill: ["rgba(245,87,87,1.00)"]
                        }
                    }
                },
                timeline: {
                    duration: 3500,
                    autoPlay: true,
                    data: [
                        [
                            "eid22",
                            "top",
                            30,
                            986,
                            "swing",
                            "${square-01}",
                            '0px',
                            '239px'
                        ],
                        [
                            "eid60",
                            "top",
                            1017,
                            57,
                            "swing",
                            "${square-01}",
                            '239px',
                            '234px'
                        ],
                        [
                            "eid62",
                            "top",
                            1073,
                            1043,
                            "easeOutQuad",
                            "${square-01}",
                            '234px',
                            '428px'
                        ],
                        [
                            "eid179",
                            "top",
                            2116,
                            1384,
                            "easeOutQuad",
                            "${square-01}",
                            '428px',
                            '-43px'
                        ],
                        [
                            "eid67",
                            "opacity",
                            1358,
                            0,
                            "easeOutQuad",
                            "${circle-01}",
                            '1',
                            '1'
                        ],
                        [
                            "eid30",
                            "top",
                            565,
                            847,
                            "swing",
                            "${circle-01}",
                            '0px',
                            '-524px'
                        ],
                        [
                            "eid183",
                            "top",
                            1412,
                            1410,
                            "swing",
                            "${circle-01}",
                            '-524px',
                            '-60px'
                        ],
                        [
                            "eid194",
                            "height",
                            0,
                            0,
                            "swing",
                            "${Stage}",
                            '2200px',
                            '2200px'
                        ],
                        [
                            "eid66",
                            "opacity",
                            2050,
                            0,
                            "easeOutQuad",
                            "${square-01}",
                            '1',
                            '1'
                        ],
                        [
                            "eid40",
                            "display",
                            30,
                            0,
                            "easeOutQuad",
                            "${circle-01}",
                            'none',
                            'block'
                        ],
                        [
                            "eid65",
                            "opacity",
                            2429,
                            0,
                            "easeOutQuad",
                            "${triangle-01}",
                            '1',
                            '1'
                        ],
                        [
                            "eid2",
                            "left",
                            30,
                            0,
                            "linear",
                            "${square-01}",
                            '0px',
                            '0px'
                        ],
                        [
                            "eid8",
                            "left",
                            1017,
                            0,
                            "linear",
                            "${square-01}",
                            '0px',
                            '0px'
                        ],
                        [
                            "eid64",
                            "left",
                            1073,
                            1043,
                            "swing",
                            "${square-01}",
                            '0px',
                            '-227px'
                        ],
                        [
                            "eid193",
                            "background-color",
                            0,
                            1017,
                            "swing",
                            "${Stage}",
                            'rgba(245,87,87,1.00)',
                            'rgba(119,22,74,1)'
                        ],
                        [
                            "eid187",
                            "background-color",
                            1017,
                            733,
                            "swing",
                            "${Stage}",
                            'rgba(119,22,74,1)',
                            'rgba(229,39,144,1.00)'
                        ],
                        [
                            "eid189",
                            "background-color",
                            1750,
                            600,
                            "swing",
                            "${Stage}",
                            'rgba(229,39,144,1)',
                            'rgba(23,133,65,1.00)'
                        ],
                        [
                            "eid191",
                            "background-color",
                            2350,
                            1150,
                            "swing",
                            "${Stage}",
                            'rgba(23,133,65,1)',
                            'rgba(86,185,71,1.00)'
                        ],
                        [
                            "eid182",
                            "left",
                            565,
                            0,
                            "swing",
                            "${circle-01}",
                            '0px',
                            '0px'
                        ],
                        [
                            "eid181",
                            "left",
                            1412,
                            1410,
                            "swing",
                            "${circle-01}",
                            '0px',
                            '-442px'
                        ],
                        [
                            "eid36",
                            "top",
                            1073,
                            1448,
                            "easeOutQuad",
                            "${triangle-01}",
                            '0px',
                            '-288px'
                        ],
                        [
                            "eid178",
                            "top",
                            2521,
                            979,
                            "easeOutQuad",
                            "${triangle-01}",
                            '-288px',
                            '-581px'
                        ],
                        [
                            "eid20",
                            "left",
                            30,
                            773,
                            "easeOutQuad",
                            "${triangle-01}",
                            '0px',
                            '-226px'
                        ],
                        [
                            "eid35",
                            "left",
                            1073,
                            1448,
                            "easeOutQuad",
                            "${triangle-01}",
                            '-226px',
                            '-227px'
                        ],
                        [
                            "eid38",
                            "display",
                            30,
                            0,
                            "easeOutQuad",
                            "${triangle-01}",
                            'none',
                            'block'
                        ],
                        [
                            "eid39",
                            "display",
                            30,
                            0,
                            "easeOutQuad",
                            "${square-01}",
                            'none',
                            'block'
                        ],
                        [
                            "eid42",
                            "display",
                            0,
                            0,
                            "easeOutQuad",
                            "${all2}",
                            'block',
                            'block'
                        ],
                        [
                            "eid43",
                            "display",
                            29,
                            0,
                            "easeOutQuad",
                            "${all2}",
                            'block',
                            'none'
                        ]
                    ]
                }
            },
            "text": {
                version: "6.0.0",
                minimumCompatibleVersion: "5.0.0",
                build: "6.0.0.400",
                scaleToFit: "none",
                centerStage: "none",
                resizeInstances: false,
                content: {
                    dom: [
                        {
                            font: ['Arial, Helvetica, sans-serif', [24, ''], 'rgba(0,0,0,1)', 'normal', 'none', '', 'break-word', 'nowrap'],
                            rect: ['386px', '53px', 'auto', 'auto', 'auto', 'auto'],
                            type: 'text',
                            id: 'Text',
                            text: '<p style=\"margin: 0px;\">​HI THERE BUDDY</p>',
                            autoOrient: 'true',
                            transform: [[], [], [], ['4.81919', '4.81919']]
                        }
                    ],
                    style: {
                        '${symbolSelector}': {
                            rect: [null, null, '973px', '135px']
                        }
                    }
                },
                timeline: {
                    duration: 0,
                    autoPlay: true,
                    data: [

                    ]
                }
            }
        };

    AdobeEdge.registerCompositionDefn(compId, symbols, fonts, scripts, resources, opts);

    if (!window.edge_authoring_mode) AdobeEdge.getComposition(compId).load("Site_BG_Site_edgeActions.js");
})("EDGE-95192478");
