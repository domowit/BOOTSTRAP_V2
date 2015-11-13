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
                            rect: ['null', 'null', '1600px', '1800px', 'auto', 'auto'],
                            overflow: 'hidden',
                            fill: ["rgba(245,87,87,1.00)"]
                        }
                    }
                },
                timeline: {
                    duration: 3380.7757127171,
                    autoPlay: true,
                    data: [
                        [
                            "eid22",
                            "top",
                            32,
                            1583,
                            "swing",
                            "${square-01}",
                            '0px',
                            '239px'
                        ],
                        [
                            "eid60",
                            "top",
                            1615,
                            92,
                            "swing",
                            "${square-01}",
                            '239px',
                            '234px'
                        ],
                        [
                            "eid62",
                            "top",
                            1706,
                            1674,
                            "easeOutQuad",
                            "${square-01}",
                            '234px',
                            '428px'
                        ],
                        [
                            "eid40",
                            "display",
                            32,
                            0,
                            "easeOutQuad",
                            "${circle-01}",
                            'none',
                            'block'
                        ],
                        [
                            "eid38",
                            "display",
                            32,
                            0,
                            "easeOutQuad",
                            "${triangle-01}",
                            'none',
                            'block'
                        ],
                        [
                            "eid66",
                            "opacity",
                            3274,
                            0,
                            "easeOutQuad",
                            "${square-01}",
                            '1',
                            '1'
                        ],
                        [
                            "eid67",
                            "opacity",
                            2163,
                            0,
                            "easeOutQuad",
                            "${circle-01}",
                            '1',
                            '1'
                        ],
                        [
                            "eid30",
                            "top",
                            891,
                            1359,
                            "swing",
                            "${circle-01}",
                            '0px',
                            '-524px'
                        ],
                        [
                            "eid39",
                            "display",
                            32,
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
                            31,
                            0,
                            "easeOutQuad",
                            "${all2}",
                            'block',
                            'none'
                        ],
                        [
                            "eid29",
                            "left",
                            891,
                            1359,
                            "swing",
                            "${circle-01}",
                            '0px',
                            '0px'
                        ],
                        [
                            "eid36",
                            "top",
                            1706,
                            1674,
                            "easeOutQuad",
                            "${triangle-01}",
                            '0px',
                            '-288px'
                        ],
                        [
                            "eid20",
                            "left",
                            32,
                            1240,
                            "easeOutQuad",
                            "${triangle-01}",
                            '0px',
                            '-226px'
                        ],
                        [
                            "eid35",
                            "left",
                            1706,
                            1674,
                            "easeOutQuad",
                            "${triangle-01}",
                            '-226px',
                            '-227px'
                        ],
                        [
                            "eid2",
                            "left",
                            32,
                            0,
                            "linear",
                            "${square-01}",
                            '0px',
                            '0px'
                        ],
                        [
                            "eid8",
                            "left",
                            1615,
                            0,
                            "linear",
                            "${square-01}",
                            '0px',
                            '0px'
                        ],
                        [
                            "eid64",
                            "left",
                            1706,
                            1674,
                            "swing",
                            "${square-01}",
                            '0px',
                            '-227px'
                        ],
                        [
                            "eid65",
                            "opacity",
                            3274,
                            0,
                            "easeOutQuad",
                            "${triangle-01}",
                            '1',
                            '1'
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
                            type: 'text',
                            font: ['Arial, Helvetica, sans-serif', [24, ''], 'rgba(0,0,0,1)', 'normal', 'none', '', 'break-word', 'nowrap'],
                            transform: [[], [], [], ['4.81919', '4.81919']],
                            id: 'Text',
                            text: '<p style=\"margin: 0px;\">​HI THERE BUDDY</p>',
                            autoOrient: 'true',
                            rect: ['386px', '53px', 'auto', 'auto', 'auto', 'auto']
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
